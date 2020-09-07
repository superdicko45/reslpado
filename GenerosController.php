<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GenerosController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Json generos
     */
    public function getGeneros() {

        $generos = DB::table('cat_generos')
            ->select('genero_id','genero', 'imagen')
            // nombre del campo, operador, variable
            ->where('activo', 1)
            ->get();

        return $generos;
    }
}
