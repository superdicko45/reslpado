<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SecurityController extends Controller
{

    /**
     * Actualiza el email del usuario
     *
     */
    public function updEmail(Request $request){

        $date = date('Y-m-d H:m:s');
        $user = DB::table('usuarios')
            ->where([
                'usuario_id' => $request->usuario_id,
                'activo' => 1
            ])
            ->update([
                'email' => $request->email,
                'updated_at' => $date
            ]);

        return ['error' => false];
    }
    /**
     * Envia los ajustes actuales del usuario
     *
     */
    public function settings(Request $request){

        $user = DB::table('usuarios')
            ->where([
                'usuario_id' => $request->usuario_id,
                'activo' => 1
            ])
            ->select('muestra_eventos')
            ->first();

        return json_encode($user);
    }
    /**
     * Guarda los ajustes actuales del usuario
     *
     */
    public function updSettings(Request $request){

        $user = DB::table('usuarios')
            ->where([
                'usuario_id' => $request->usuario_id,
                'activo' => 1
            ])
            ->update(['muestra_eventos' => $request->muestra_eventos]);

        return ['error' => false];
    }
}
