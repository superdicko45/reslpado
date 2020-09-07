<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AcademiasController extends Controller
{
    /**
     * Regresa las academias ordenadas por raking
     *
     * @return Json academias
     */
    public function rankeadas($city) {

        $academias = $this->getQuery($city);
        $academias = $academias
            ->orderBy('stars', 'desc')
            ->limit(10)
            ->get()
            ->unique();

        $academias = $this->appendTags($academias);

        return $academias->values();
    }

    /**
     * Show the profile for the given user.
     *
     * @return Json academias
     */
    public function paraHoy($city) {

        $today = Carbon::now();

        $academias = $this->getQuery($city);

        //Si es un dia entre semana
        if($today->isWeekday())
            $academias = $academias
                ->where('s.week', 1)
                ->orderBy('stars', 'desc')
                ->get()
                ->unique();

        //Si es un fin de semana
        else
            $academias = $academias
                ->where('s.weekend', 1)
                ->orderBy('stars', 'desc')
                ->get()
                ->unique();

        $academias = $this->appendTags($academias);

        return $academias->values();
    }

    /**
     * Regresa las academias con prioridad
     *
     * @return Json academias
     */
    public function recomendadas($city) {

        $academias = $this->getQuery($city);
        $academias = $academias
            ->orderBy('stars', 'desc')
            ->limit(10)
            ->get()
            ->unique();

        $academias = $this->appendTags($academias);

        return $academias->values();
    }
    /**
     * Regresa la info de la academia
     *
     * @return academia
     */
    public function show($id) {

        $data['academia'] = DB::table('academias')
            ->where([
                'academias_id' => $id,
                'activo' => 1
            ])
            ->first();

        $data['ranking'] = DB::table('academias_resenas')
            ->where([
                'academia_id' => $id,
                'activo' => 1
            ])
            ->select(
                DB::raw('AVG(calificacion) as stars'),
                DB::raw('COUNT(calificacion) as total' )
            )
            ->first();

        /* Si existen comentarios */
        if($data['ranking']->total > 0)
            $data['stars'] = $this->countStar($id, $data['ranking']->total);

        $data['redes'] = DB::table('academias_redes as r')
            ->join('cat_redes_sociales as c', 'r.red_social_id', 'c.red_social_id')
            ->select(
                'c.red_social as tipo',
                DB::raw('CONCAT(c.url, r.red_social) as fullUrl'),
                'r.red_social as url',
                'c.red_social as red_social'
            )
            ->where([
                'r.activo' => 1,
                'c.activo' => 1,
                'r.academia_id' => $id
            ])
            ->get();

        $data['promo'] = DB::table('academias_promos')
            ->whereRaw('CURDATE() <= date(caducidad)')
            ->where([
                'academia_id' => $id,
                'activo' => 1
            ])
            ->select(
                'promo_id',
                'promo'
            )
            ->first();

        $sucursales = DB::table('academias_sucursales as a')
            ->join('cat_ciudades as c', 'a.ciudad_id', 'c.ciudad_id')
            ->select(
                'c.ciudad',
                'a.*'
            )
            ->where('a.academia_id', $id)
            ->where('a.activo', 1)
            ->get();

        $data['sucursales'] = $this->addTagsBySucursal($sucursales);

        $data['galeria'] = $this->galeria($id);

        $data['comentarios'] = $this->resenas($id);

        return $data;
    }
    /**
     * Regresa el porcentaje de numero de estrellas
     *
     */
    public function countStar($id, $total) {

        $stars = DB::table('academias_resenas')
            ->select(
                'calificacion',
                DB::raw('COUNT(calificacion) as total')
            )
            ->where(['academia_id' => $id, 'activo' => 1])
            ->groupBy('calificacion')
            ->get()
            ->pluck('total','calificacion');

        return $stars;
    }
    /**
     * Regresa las resenas de la academia
     *
     * @return Json resenas
     */
    public function resenas($id) {

        $comentarios = DB::table('academias_resenas as r')
            ->join('usuarios as u', 'r.usuario_id', 'u.usuario_id')
            ->select(
                'r.resena',
                'r.created_at',
                'r.calificacion',
                'u.username',
                'u.foto_perfil'
            )
            ->where([
                'r.academia_id' => $id,
                'r.activo' => 1
            ])
            ->orderBy('created_at', 'desc')
            ->paginate();

        return $comentarios;
    }
    /**
     * Regresa la galeria de la academia
     *
     * @return Json galeria
     */
    public function galeria($id) {

        $galeria = DB::table('academias_galeria as g')
            ->join('academias as a', 'g.academia_id', 'a.academias_id')
            ->join('cat_galeria as c', 'g.galeria_id', 'c.galeria_id')
            ->select(
                'a.academias_id',
                'a.nombre',
                'c.archivo_foto'
            )
            ->where('g.academia_id', $id)
            ->where('g.activo', 1)
            ->paginate();

        return $galeria;
    }
    ////// Functions //////
    /**
     * Show the profile for the given user.
     * @param int id_city
     * @return DB query builder
     */
    public function getQuery(int $city) {

        $academias = DB::table('academias_sucursales as s')
            ->join('academias as a', 's.academia_id', 'a.academias_id')
            ->leftJoin('academias_resenas as r', 'a.academias_id', 'r.academia_id')
            ->select(
                'a.academias_id',
                'a.perfil_imagen',
                'a.nombre',
                DB::raw('AVG(r.calificacion) as stars'),
                DB::raw('COUNT(r.calificacion) as total' )
            )
            ->where([
                's.ciudad_id' => $city,
                'a.activo' => 1,
                's.activo' => 1
            ])
            ->groupBy('s.sucursal_id', 'a.academias_id');

        return $academias;
    }
    /**
     * Regresa los tags de las academias
     *
     * @return collect academias
     */
    public function appendTags($academias) {

        foreach ($academias as $key => $value) {

              $value->tags = DB::table('academias_sucursales as s')
                  ->join('aca_sucursal_generos as sg', 's.sucursal_id', 'sg.sucursal_id')
                  ->join('cat_generos as c', 'sg.genero_id', 'c.genero_id')
                  ->select('c.genero_id', 'c.genero')
                  ->where([
                      's.academia_id' => $value->academias_id,
                      's.activo' => 1,
                      'sg.activo' => 1
                  ])
                  ->groupBy('c.genero_id')
                  ->get();
        }

        return $academias;
    }
    /**
     * Regresa los tags de las sucursales
     *
     * @return collect sucursales
     */
    public function addTagsBySucursal($sucursales) {

        foreach ($sucursales as $key => $value) {

              $value->tags = DB::table('aca_sucursal_generos as sg')
                  ->join('cat_generos as c', 'sg.genero_id', 'c.genero_id')
                  ->select('c.genero_id', 'c.genero')
                  ->where([
                      'sg.sucursal_id' => $value->sucursal_id,
                      'sg.activo' => 1
                  ])
                  ->get();
        }

        return $sucursales;
    }
    /**
     * Guarda una nueva resena
     *
     * @return Bool
     */
    public function addResena(Request $request) {

        $id = DB::table('academias_resenas')
            ->insertGetId([
                'academia_id'  => $request->academia_id,
                'usuario_id'   => $request->usuario_id,
                'resena'       => $request->resena,
                'calificacion' => $request->calificacion,
                'created_at'   => date('Y-m-d H:m:s')
            ]);
            
        $data['ranking'] = DB::table('academias_resenas')
            ->where([
                'academia_id' => $request->academia_id,
                'activo' => 1
            ])
            ->select(
                DB::raw('AVG(calificacion) as stars'),
                DB::raw('COUNT(calificacion) as total' )
            )
            ->first();

        /* Si existen comentarios */
        if($data['ranking']->total > 0)
            $data['stars'] = $this->countStar($request->academia_id, $data['ranking']->total);

        $data['comentarios'] = $this->resenas($request->academia_id);    
            
        return $data;
    }
}
