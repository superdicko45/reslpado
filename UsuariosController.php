<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Muestra la info del usuario
     *
     * @return Json
     */
    public function show($id) {

        $user = $this->getInfoUser($id);

        if($user == null)
            return ['user' => null];

        $user->seguidores = 782;
        $user->seguidos = 82;

        $data['user'] = $user;

        $data['redes'] = $this->getRedes($id);

        $data['generos'] = $this->getGeneros($id);

        $data['galeria'] = $this->galeria($id);

        $eventos = $this->getEventsByUser($id);

        $data['eventos'] = $this->appendTags($eventos);

        return $data;
    }
    /**
     * Muestra la info del usuario para poder editarlo
     *
     * @return Json blogs
     */
    public function edit(Request $request) {

        $id = $request->usuario_id;
        $user = $this->getInfoUser($id);

        if($user == null)
            return ['user' => null];

        $data['user'] = $user;
        $data['generos'] = $this->getGeneros($id)->pluck('genero_id');

        $data['tipos'] = DB::table('cat_tipo_usuario')
            ->select(
                'tipo_usuario_id as item_id',
                'tipo_usuario as item'
            )
            ->where('activo', 1)
            ->get();

        $data['categorias'] = DB::table('cat_generos as g')
            ->select(
                'g.genero as item',
                'g.genero_id as item_id'
            )
            ->where('g.activo', 1)
            ->get();

        return $data;
    }
    /**
     * Almacena la ingo general del usuario
     *
     */
    public function store(Request $request){

        $user = DB::table('usuarios')
            ->where('uid', $request->uid)
            ->where('activo', 1)
            ->first();

        //Si el usuario ya existe
        if($user != null) {

            return [
                'userId' => $user->usuario_id,
                'nombre' => $user->nombre,
                'email'  => $user->email,
                'perfil' => $user->foto_perfil
            ];
        }

        $date = date('Y-m-d H:m:s');
        $nombre = $request->nombre;

        // Si el nombre no existe tomara el email
        if($nombre == null || $nombre == '') {

            $tempo = explode("@", $request->email);
            $nombre = $tempo[0];
        }

        $idUser = DB::table('usuarios')->insertGetId([
            'uid'        => $request->uid,
            'nombre'     => $nombre,
            'email'      => $request->email,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        return [
            'userId' => $idUser,
            'nombre' => $nombre,
            'email'  => $request->email,
            'perfil' => $user->foto_perfil
        ];
    }
    /**
     * Almacena la info general del usuario
     *
     */
    public function update(Request $request){

        $date = date('Y-m-d H:m:s');

        //actualiza el modelo de usuarios
        DB::table('usuarios')
            ->where('usuario_id', $request->usuario_id)
            ->update([
                'nombre'      => $request->nombre,
                'username'    => $request->username,
                'tipo_id'     => $request->tipo_id,
                'descripcion' => $request->descripcion,
                'updated_at'  => $date
            ]);

        //// manejo de generos ///

        //Ingresa los nuevos generos
        if($request->has('newGeneros')){

            $data = [];

            foreach ($request->newGeneros as $key => $value) {

                $data[$key] = [
                    'genero_id'  => $value,
                    'usuario_id' => $request->usuario_id
                ];
            }

            DB::table('usuario_generos')->insert($data);
        }

        //Inactiva los viejos
        if($request->has('oldGeneros'))
            DB::table('usuario_generos')
                ->where('usuario_id', $request->usuario_id)
                ->whereIn('genero_id', $request->oldGeneros)
                ->update(['activo' => 0]);

        return ['error' => false, 'msg' => 'Se guardo con exito'];
    }
    /**
     * Regresa la info general del usuario
     *
     */
    public function getInfoUser($id){

        $user = DB::table('usuarios as u')
            ->leftJoin('cat_tipo_usuario as c', 'u.tipo_id', 'c.tipo_usuario_id')
            ->where('u.usuario_id', $id)
            ->where('u.activo', 1)
            ->select(
                'u.usuario_id',
                'u.username',
                'u.nombre',
                'u.foto_perfil',
                'u.descripcion',
                'c.tipo_usuario',
                'c.tipo_usuario_id'
            )
            ->first();

        return $user;
    }
    /**
     * Busca el nickname que sea disponible
     *
     */
    public function searchNickname(Request $request){

        $cont = DB::table('usuarios')
            ->where('usuario_id', '!=', $request->usuario_id)
            ->where('username', $request->username)
            ->count();

        if($cont > 0)
            return ['error' => true];

        return ['error' => false];
    }
    /**
     * Regresa los generos del usuario
     *
     */
    public function getGeneros($id){

        $generos = DB::table('cat_generos as g')
            ->join('usuario_generos as e', 'g.genero_id', 'e.genero_id')
            ->select(
                'g.genero',
                'g.genero_id',
                'g.imagen'
            )
            ->where('e.usuario_id', $id)
            ->where('e.activo', 1)
            ->get();

        return $generos;
    }
    /**
     * Regresa los eventos del usuario
     *
     */
    public function events($id){

        $hoy = date('Y-m-d');

        $eventos = DB::table('usuario_eventos as ue')
            ->join('eventos as e', 'ue.evento_id', 'e.evento_id')
            ->join('cat_ciudades as m', 'e.ciudad_id', 'm.ciudad_id')
            ->join('cat_tipo_evento as c', 'e.tipo_evento_id', 'c.tipo_evento_id')
            ->where([
                'ue.usuario_id' => $id,
                'e.activo' => 1,
                'ue.activo' => 1
            ])
            ->where('e.fecha_inicio', '>', $hoy)
            ->select(
                'e.evento_id',
                'promocional',
                'titulo',
                'm.ciudad',
                'colonia',
                'fecha_inicio',
                'fecha_final',
                'tipo_evento',
                'cover'
            )
            ->orderBy('fecha_inicio')
            ->paginate();

        return $eventos;
    }
    /**
     * Regresa los eventos del usuario pero restringidos por configuracion
     * 
     */
    public function getEventsByUser($id){

        $hoy = date('Y-m-d');

        $eventos = DB::table('usuarios as u')
            ->join('usuario_eventos as ue', 'u.usuario_id', 'ue.usuario_id')
            ->join('eventos as e', 'ue.evento_id', 'e.evento_id')
            ->join('cat_ciudades as m', 'e.ciudad_id', 'm.ciudad_id')
            ->join('cat_tipo_evento as c', 'e.tipo_evento_id', 'c.tipo_evento_id')
            ->where([
                'ue.usuario_id' => $id,
                'e.activo' => 1,
                'ue.activo' => 1,
                'u.muestra_eventos' => 1
            ])
            ->where('e.fecha_inicio', '>', $hoy)
            ->select(
                'e.evento_id',
                'promocional',
                'titulo',
                'm.ciudad',
                'colonia',
                'fecha_inicio',
                'fecha_final',
                'tipo_evento',
                'cover'
            )
            ->orderBy('fecha_inicio')
            ->paginate();

        return $eventos;
    }
    /**
     * Regresa los tags de los eventos
     *
     * @return collect eventos
     */
    public function appendTags($eventos) {

        foreach ($eventos as $key => $value) {

            $value->tags = DB::table('evento_genero as e')
                ->join('cat_generos as c', 'e.genero_id', 'c.genero_id')
                ->select('c.genero_id', 'c.genero')
                ->where('e.activo', 1)
                ->where('e.evento_id', $value->evento_id)
                ->get();  
        }

        return $eventos;
    }
    /**
     * Elimina un evento para el usuario
     *
     */
    public function delEvent(Request $request){

        DB::table('usuario_eventos')
            ->where([
                'usuario_id' => $request->usuario_id,
                'evento_id' => $request->evento_id
            ])
            ->update(['activo' => 0]);

        return ['error' => false];
    }
    /**
     * regresa un query de las redes del usuario
     * 
     */
    public function getRedes(int $id){
        
        $query = DB::table('cat_redes_sociales as c')
            ->join('usuario_redes as u', 'c.red_social_id' ,'u.red_id')
            ->select(
                'c.red_social',
                'u.usuario_redes_id as itemId',
                'u.red_id as socialId',
                'u.red_social as url',
                'c.url as fullUrl' 
            )
            ->where([
                'u.activo'    => 1,
                'u.usuario_id' => $id,
                'c.activo'    => 1
            ])
            ->get();

        return $query;
    }
    /**
     * regresa las redes del usuario
     * @return Json redes
     */
    public function redes(Request $request) {

        $params['redes'] = $this->getRedes($request->usuario_id);

        $params['catRedes'] = DB::table('cat_redes_sociales')
            ->where('activo', 1)
            ->select(
                'red_social_id as item_id',
                'red_social as item' 
            )
            ->get();

        return $params;
    }
    /**
     * Actualiza las redes del usuario
     * @return Json
     */
    public function updRedes(Request $request) {

        if($request->has('delRedes'))
            DB::table('usuario_redes')
                ->whereIn('usuario_redes_id', $request->delRedes)
                ->update(['activo' => 0]);

        if($request->has('newRedes')) {
            
            $data = [];

            foreach ($request->newRedes as $key => $value) {
                
                $data[$key] = [
                    'usuario_id' => $request->usuario_id,
                    'red_id'     => $value['socialId'],
                    'red_social' => $value['url']
                ];    
            }

            DB::table('usuario_redes')->insert($data);
        }

        if($request->has('updRedes')) {
            
            foreach ($request->updRedes as $key => $value) {
                
                DB::table('usuario_redes')
                    ->where('usuario_redes_id', $value['itemId'])
                    ->update([
                        'usuario_id' => $request->usuario_id,
                        'red_id'     => $value['socialId'],
                        'red_social' => $value['url']
                    ]);    
            }            
        }

        return ['error' => false];
    }
    /**
     * Regresa la galeria del usuario
     *
     */
    public function galeria($id){

        $galeria = DB::table('usuario_galeria as g')
            ->join('cat_galeria as c', 'g.galeria_id', 'c.galeria_id')
            ->select(
                'c.archivo_foto'
            )
            ->where('g.usuario_id', $id)
            ->where('g.activo', 1)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return $galeria;
    }
}
