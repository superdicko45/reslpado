<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Agrega imagenes al perfil del ususario.
     *
     */
    public function addusers(Request $request) {
        
        $allowedfileExtension=['pdf','jpg','png', 'gif'];
        $files = $request->file('images'); 
        $dataUseGale = [];
        $date = date('Y-m-d H:m:s');
        
        foreach($request->images as $key => $file) {
                
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
                
            if($check) {

                $url = $file->store('images/'.$request->usuario_id, 's3');

                $galeryId = DB::table('cat_galeria')
                    ->insertGetId([
                        'archivo_foto' => $url,
                        'activo' => 1
                    ]);

                $dataUseGale[$key] = [
                    'galeria_id' => $galeryId,
                    'usuario_id' => $request->usuario_id,
                    'created_at' => $date,
                    'activo' => 1
                ];

            }       
        }    

        if(count($dataUseGale) > 0)
            DB::table('usuario_galeria')->insert($dataUseGale);
        
        $galeria = DB::table('usuario_galeria as g')
            ->join('cat_galeria as c', 'g.galeria_id', 'c.galeria_id')
            ->select('g.galeria_usuario_id', 'c.archivo_foto')
            ->where('g.usuario_id', $request->usuario_id)
            ->where('g.activo', 1)
            ->orderBy('created_at', 'desc')
            ->limit(15)    
            ->get();

        return $galeria;    
    }
}
