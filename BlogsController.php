<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Json blogs
     */
    public function getBlogs() {

        $blogs = DB::table('blogs as b')
            //nombre de la table, fk campo, campo de esta table
            ->join('usuarios as u', 'b.usuario_id', 'u.usuario_id')
            ->select(
                'b.blog_id',
                'b.titulo',
                'b.imagen',
                'b.created_at',
                'u.username',
                'u.foto_perfil'
            )
            ->where('b.activo', 1)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $blogs = $this->appendTotal($blogs);    

        return $blogs;
    }
    /**
     * Regresa un blog
     *
     * @return blog
     */
    public function show($id) {

        $blog['blog'] = DB::table('blogs as b')
            ->join('usuarios as u', 'b.usuario_id', 'u.usuario_id')
            ->select(
                'b.blog_id',
                'b.titulo',
                'b.imagen',
                'b.created_at',
                'u.username',
                'u.foto_perfil'
            )
            ->where('b.activo', 1)
            ->where('blog_id', $id)
            ->first();

        $blog['blog']->contenidos = DB::table('blog_contenidos')
            ->select('titulo', 'descripcion', 'imagen')
            ->where('blog_id', $id)
            ->where('activo', 1)
            ->get();

        return $blog;
    }
    /**
     * Regresa los comentarios del blog
     *
     * @return Json comentarios
     */
    public function comentarios($id) {

        $comentarios = DB::table('blog_comentarios as c')
            ->join('usuarios as u', 'c.usuario_id', 'u.usuario_id')
            ->select(
                'c.comentario',
                'c.created_at',
                'u.username',
                'u.foto_perfil'
            )
            ->where([
                'c.blog_id' => $id,
                'c.activo' => 1
            ])
            ->paginate();

        return $comentarios;
    }
    /**
     * Guarda un nuevo comentario
     *
     * @return Bool
     */
    public function addComentario(Request $request) {

        $blog = DB::table('blog_comentarios')
            ->insertGetId([
                'blog_id'    => $request->blog_id,
                'usuario_id' => $request->usuario_id,
                'comentario' => $request->comentario
            ]);
            
        $comentario = DB::table('blog_comentarios as c')
            ->join('usuarios as u', 'c.usuario_id', 'u.usuario_id')
            ->select(
                'c.comentario',
                'c.created_at',
                'u.username',
                'u.foto_perfil'
            )
            ->where('c.comentarios_id', $blog)
            ->first();

        return response()->json($comentario);
    }
    /**
     * Agrega el total de comentarios a cada blog
     *
     * @return collect blogs
     */
    public function appendTotal($blogs) {

        foreach ($blogs as $key => $value) {

              $value->total = DB::table('blog_comentarios')
                  ->selectRaw('COUNT(*) as total')
                  ->where('activo', 1)
                  ->where('blog_id', $value->blog_id)
                  ->pluck('total')
                  ->first();
        }

        return $blogs;
    }
}
