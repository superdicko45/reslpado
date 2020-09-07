<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/generos', 'GenerosController@getGeneros');

Route::get('/promos/vigentes/{city}', 'PromosController@vigentes');

Route::get('/search', 'SearchController@search');
Route::get('/filter', 'SearchController@filter');
Route::get('/sugerencias/{q}', 'SearchController@sugerencias');

Route::get('/blogs', 'BlogsController@getBlogs');
Route::get('/blogs/{id}', 'BlogsController@show');
Route::get('/blogs/comentarios/{id}', 'BlogsController@comentarios');
Route::post('/blogs/addComentario', 'BlogsController@addComentario');

Route::get('/academias/rankeadas/{city}', 'AcademiasController@rankeadas');
Route::get('/academias/recomendadas/{city}', 'AcademiasController@recomendadas');
Route::get('/academias/paraHoy/{city}', 'AcademiasController@paraHoy');
Route::get('/academias/show/{id}', 'AcademiasController@show');
Route::get('/academias/galeria/{id}', 'AcademiasController@galeria');
Route::get('/academias/resenas/{id}', 'AcademiasController@resenas');
Route::post('/academias/addResena', 'AcademiasController@addResena');

Route::get('/eventos/recientes', 'EventosController@recientes');
Route::get('/eventos/cercanos/{city}', 'EventosController@cercanos');
Route::get('/eventos/paraHoy/{city}', 'EventosController@paraHoy');
Route::get('/eventos/recomendados/{city}', 'EventosController@recomendados');
Route::get('/eventos/show/{id}', 'EventosController@show');

Route::get('/usuarios/show/{id}', 'UsuariosController@show');
Route::get('/usuarios/events/{id}', 'UsuariosController@events');
Route::get('/usuarios/galeria/{id}', 'UsuariosController@galeria');
Route::post('/usuarios/store', 'UsuariosController@store');
Route::post('/usuarios/edit', 'UsuariosController@edit');
Route::post('/usuarios/update', 'UsuariosController@update');
Route::post('/usuarios/delEvent', 'UsuariosController@delEvent');
Route::post('/usuarios/addEvent', 'UsuariosController@addEvent');
Route::post('/usuarios/redes', 'UsuariosController@redes');
Route::post('/usuarios/updRedes', 'UsuariosController@updRedes');
Route::post('/usuarios/searchName', 'UsuariosController@searchNickname');

Route::post('/usuarios/addImages', 'MediaController@addUsers');

Route::post('/security/updEmail', 'SecurityController@updEmail');
Route::post('/security/settings', 'SecurityController@settings');
Route::post('/security/updSettings', 'SecurityController@updSettings');
