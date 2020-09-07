<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PromosController extends Controller
{
    /**
     * Regresa las promos-academias ordenadas por ciudad
     *
     * @return Json promos
     */
    public function vigentes($city) {

        $promos = DB::table('academias_sucursales as s')
            ->join('academias as a', 's.academia_id', 'a.academias_id')
            ->join('academias_promos as p', 'a.academias_id', 'p.academia_id')
            ->where([
                's.ciudad_id' => $city,
                'p.activo' => 1,
                'a.activo' => 1
            ])
            ->select(
                'p.promo_id',
                'p.promo',
                'a.nombre',
                'p.imagen',
                'p.caducidad'
            )
            ->groupBy('p.promo_id')
            ->paginate();

        return $promos;
    }
}
