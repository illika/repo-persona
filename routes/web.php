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