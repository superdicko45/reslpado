<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    /**
     * Regresa los eventos mas recientes
     *
     * @return Json eventos
     */
    public function recientes() {

        $eventos = $this->getQuery();
        $eventos = $eventos->where('e.activo', 1)
            ->orderBy('e.created_at', 'desc')
            ->limit(10)
            ->get();

        $eventos = $this->appendTags($eventos);

        return $eventos;
    }
    /**
     * Regresa los eventos recomendados
     *
     * @return Json eventos
     */
    public function recomendados($city) {

        $hoy = date('Y-m-d');
        $eventos = $this->getQuery();
        $eventos = $eventos
            ->where([
                'e.ciudad_id' => $city,
                'e.activo' => 1
            ])
            ->where('e.fecha_inicio', '>' ,$hoy)
            ->limit(10)
            ->get();

        $eventos = $this->appendTags($eventos);

        return $eventos;
    }
    /**
     * Regresa los eventos para el dia de hoy
     *
     * @return Json eventos
     */
    public function paraHoy($city) {

        $eventos = $this->getQuery();
        $eventos = $eventos
            ->whereRaw('CURDATE() between date(fecha_inicio) and fecha_final')
            ->limit(10)
            ->get();

        $eventos = $this->appendTags($eventos);

        return $eventos;
    }
    /**
     * Regresa los eventos mas cercanos
     *
     * @return Json zonas
     */
    public function cercanos($city) {

        $hoy = date('Y-m-d');

        $zonas = DB::table('eventos as e')
            ->join('cat_ciudades as cc', 'e.ciudad_id', 'cc.ciudad_id')
            ->where('e.activo', 1)
            ->where('e.ciudad_id', $city)
            ->where('e.fecha_inicio', '>' ,$hoy)
            ->select(
                'e.ciudad_id',
                'cc.ciudad',
                'e.colonia',
                DB::raw('COUNT(e.colonia) as total')
            )
            ->groupBy('e.colonia')
            ->limit(10)
            ->get();

        return $zonas;
    }
    /**
     * Regresa la info del evento
     *
     * @return evento
     */
    public function show($id) {

        $data['evento'] = DB::table('eventos as e')
            ->join('cat_tipo_evento as c', 'e.tipo_evento_id', 'c.tipo_evento_id')
            ->join('cat_ciudades as cc', 'e.ciudad_id', 'cc.ciudad_id')
            ->select('e.*', 'tipo_evento', 'cc.ciudad')
            ->where('evento_id', $id)
            ->first();

        $data['redes'] = DB::table('evento_redes as e')
            ->join('cat_redes_sociales as c', 'e.red_social_id', 'c.red_social_id')
            ->select(
                'c.red_social',
                DB::raw('CONCAT(c.url, e.red_social) as url')
            )
            ->where([
                'e.activo'    => 1,
                'c.activo'    => 1,
                'e.evento_id' => $id
            ])
            ->get();

        $data['invitados'] = DB::table('usuario_eventos as i')
            ->join('usuarios as u', 'i.usuario_id', 'u.usuario_id')
            ->join('cat_tipo_usuario as c', 'u.tipo_id', 'c.tipo_usuario_id')
            ->select(
                'i.usuario_id',
                'u.nombre',
                'u.foto_perfil',
                'c.tipo_usuario'
            )
            ->where([
                'i.evento_id' => $id,
                'i.activo' => 1,
                'i.invitado' => 1
            ])
            ->get();

        $data['generos'] = DB::table('cat_generos as g')
            ->join('evento_genero as e', 'g.genero_id', 'e.genero_id')
            ->select(
                'g.genero',
                'g.genero_id',
                'g.imagen'
            )
            ->where('e.evento_id', $id)
            ->where('e.activo', 1)
            ->get();

        $data['organizadores'] = DB::table('evento_organizadores as o')
            ->join('usuarios as u', 'o.usuario_id', 'u.usuario_id')
            ->join('cat_tipo_usuario as c', 'u.tipo_id', 'c.tipo_usuario_id')
            ->select(
                'o.usuario_id',
                'u.nombre',
                'u.foto_perfil',
                'c.tipo_usuario'
            )
            ->where('o.evento_id', $id)
            ->where('o.activo', 1)
            ->get();

        $data['galeria_evento'] = DB::table('evento_galerias as g')
            ->join('eventos as e', 'g.evento_id', 'e.evento_id')
            ->join('cat_galeria as c', 'g.galeria_id', 'c.galeria_id')
            ->select(
                'e.evento_id',
                'e.titulo',
                'c.archivo_foto'
            )
            ->where('g.evento_id', $id)
            ->where('g.activo', 1)
            ->get();

        return $data;
    }
    /////////// Funciones ///////////
    /**
     * Regresa la info del evento
     *
     * @return DB query
     */
    public function getQuery() {

        $query = DB::table('eventos as e')
            ->join('cat_tipo_evento as c', 'e.tipo_evento_id', 'c.tipo_evento_id')
            ->join('cat_ciudades as cc', 'e.ciudad_id', 'cc.ciudad_id')
            ->select(
                'evento_id',
                'promocional',
                'titulo',
                'cc.ciudad',
                'colonia',
                'fecha_inicio',
                'fecha_final',
                'tipo_evento',
                'cover'
            );

        return $query;
    }

    /**
     * Regresa los tags de lso eventos
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
}
