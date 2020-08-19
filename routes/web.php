<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get("/persona", "PersonaController@index")->name("persona.index");
Route::get("/persona/crear", "PersonaController@create")->name("persona.create");
Route::post("/persona", "PersonaController@store")->name("persona.store");
Route::get("/persona/{persona}", "PersonaController@edit")->name("persona.edit");
Route::patch("/persona/{persona}", "PersonaController@update")->name("persona.update");
Route::delete("/persona/{persona}", "PersonaController@destroy")->name("persona.destroy");

Route::get("/sede/departamento", "SedeController@getDepartamento")->name("sede.getdepartamento");
Route::get("/sede/departamento/{id}/provincia", "SedeController@getProvincia")->name("sede.getprovincia");
Route::get("/sede/departamento/{id}/distrito", "SedeController@getDistrito")->name("sede.getdistrito");