<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchController extends Controller
{
    /**
     * Regresa las promos-academias ordenadas por ciudad
     *
     * @return Json promos
     */
    public function search(Request $request) {

        //dd($request->all());
        $result = [];
        $data   = [];

        //valores de la peticion
        $q        = $request->input('q');
        $filtro   = $request->input('filtro');
        $ciudad   = $request->input('ciudad');
        $generos  = $request->input('genero');
        $costoMin = $request->input('costoMin');
        $costoMax = $request->input('costoMax');
        $tipoE    = $request->input('tipoE');
        $dateMin  = $request->input('dateMin');
        $dateMax  = $request->input('dateMax');
        $online   = $request->input('online');
        $week     = $request->input('week');
        $weekend  = $request->input('weekend');
        $tipo     = $request->input('tipo');

        $users  = $this->users();
        $shools = $this->academias();
        $events = $this->eventos();

        //si viene con algo que buscar
        if($q != null || $filtro == 1) {

            //si viene un input que buscar
            if($q != null){

                $users->whereRaw("u.username LIKE '%".$q."%' OR u.nombre LIKE '%".$q."%'");
                $shools->where('a.nombre', "LIKE", "%".$q."%");
                $events->where('e.titulo', "LIKE", "%".$q."%");
            }

            //si viene con filtro
            if($filtro == 1){


                //si hay que buscar ciudad
                if($ciudad != null) {
                    $shools->where('s.ciudad_id', $ciudad);
                    $events->where('e.ciudad_id', $ciudad);
                }

                //si hay que buscar generos
                if($generos != null) {
                    $shools->whereIn('g.genero_id', $generos);
                    $events->whereIn('g.genero_id', $generos);
                }

                //si hay un rango de costos
                if($costoMin != null and $costoMax != null) {
                    $raw = $costoMin.' between rango_min and rango_max OR '.$costoMax." between rango_min and rango_max";
                    $shools->whereRaw($raw);
                    $events->whereBetween('e.cover', [$costoMin, $costoMax]);
                }

                //si hay un tipo de evento
                if($tipoE != null && $tipoE != 0)  $events->where('e.tipo_evento_id', $tipoE);

                //si hay un rango de fechas
                if($dateMin != null AND $dateMax != null) {
                    $raw = $dateMin.' between date(fecha_inicio) and fecha_final OR '.$dateMax." between date(fecha_inicio) and fecha_final";
                    $events->whereRaw($raw);
                }else{
                    $events->whereRaw('CURDATE() between date(fecha_inicio) and fecha_final');
                }

                //Si hay academias online
                if($online == 1) $shools->where('s.online', 1);

                //si da clases entre semana
                if($week == 1) $shools->where('s.week', 1);

                //si da clases los fines de semana
                if($weekend == 1) $shools->where('s.weekend', 1);
            }
        }
        else return ['error' => true];


        //Si viene algun tipo de busqueda
        if($tipo != null) {
            //si solo busca usuarios
            if($tipo == '4') $data['users'] = $users->paginate()->items();

            //si solo busca academias
            if($tipo == '3') $data['schools'] = $shools->paginate()->items();

            //si solo busca eventos
            if($tipo == '2') $data['events'] = $events->paginate()->items();

            //trae todos
            if($tipo == '1') {

                $data['users'] = $users->paginate()->items();
                $data['schools'] = $shools->paginate()->items();
                $data['events'] = $events->paginate()->items();
            }
        }
        //buscara en los tres modelos
        else {
            $data['users'] = $users->paginate()->items();
            $data['schools'] = $shools->paginate()->items();
            $data['events'] = $events->paginate()->items();
        }

        if(empty($data)) return ['error' => true];

        return ['error' => false, 'data' => $data];
    }
    /**
     * Regresa las sugerencias respecto a la entrada
     *
     * @return Json suggestions
     */
    public function sugerencias($q) {

        $events = DB::table('eventos')
            ->where('titulo', 'LIKE', '%'.$q.'%')
            ->where('activo', 1)
            ->limit(10)
            ->groupBy('titulo')
            ->pluck('titulo');

        $schools = DB::table('academias')
            ->where('nombre', 'LIKE', '%'.$q.'%')
            ->where('activo', 1)
            ->limit(10)
            ->groupBy('nombre')
            ->pluck('nombre');

        return $events->merge($schools)->sort();
    }
    /**
     * Regresa los generos y ciudades
     *
     * @return Generos y Ciudades
     */
    public function filter() {

        $data['categorias'] = DB::table('cat_generos as g')
            ->select(
                'g.genero as item',
                'g.genero_id as item_id'
            )
            ->where('g.activo', 1)
            ->get();

        $data['ciudades'] = DB::table('cat_ciudades')
            ->select(
                'ciudad as item',
                'ciudad_id as item_id'
            )
            ->where('activo', 1)
            ->get(); 

        return $data;       
    }
    ///// Functions /////

    /**
     * Regresa las coincidencias de usuarios
     *
     * @return DB Query Builder
     */
    public function users() {

        $users = DB::table('usuarios as u')
            ->join('cat_tipo_usuario as c', 'u.tipo_id', 'c.tipo_usuario_id')
            ->select(
                'u.usuario_id',
                'u.nombre',
                'u.username',
                'u.foto_perfil',
                'c.tipo_usuario'
            )
            ->where('u.activo', 1);

        return $users;
    }
    /**
     * Regresa las coincidencias de academias
     *
     * @return DB Query Builder
     */
    public function academias() {

        $academias = DB::table('academias_sucursales as s')
            ->join('aca_sucursal_generos as g', 's.sucursal_id', 'g.sucursal_id')
            ->join('academias as a', 's.academia_id', 'a.academias_id')
            ->select(
                'a.academias_id',
                'a.perfil_imagen',
                'a.nombre',
                DB::raw("(SELECT COUNT(f.sucursal_id) FROM academias_sucursales as f WHERE s.academia_id = f.academia_id GROUP BY s.academia_id) as total")
            )
            //->where('a.nombre', 'LIKE', "%".$academia."%")
            ->where([
                'a.activo' => 1,
                's.activo' => 1
            ])
            ->groupBy('s.academia_id');

        return $academias;
    }
    /**
     * Regresa las coincidencias de eventos
     *
     * @return DB Query Builder
     */
    public function eventos() {

        $eventos = DB::table('eventos as e')
            ->join('evento_genero as g', 'e.evento_id', 'g.evento_id')
            ->join('cat_tipo_evento as c', 'e.tipo_evento_id', 'c.tipo_evento_id')
            ->join('cat_ciudades as cc', 'e.ciudad_id', 'cc.ciudad_id')
            ->select(
                'e.evento_id',
                'promocional',
                'titulo',
                'cc.ciudad',
                'colonia',
                'fecha_inicio',
                'fecha_final',
                'tipo_evento',
                'cover'
            )
            ->groupBy('e.evento_id')
            ->orderBy('fecha_final');

        return $eventos;
    } 
}
