<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::all();
        return view("persona.index", compact("personas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("persona.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $persona= $request->validate([
            "nombres" => "required|regex:/^[a-zA-Z\s]*$/|max:100",
            "tipo_documento" => ["required", Rule::in(["DNI","carné de extranjería"])],
            "numero_documento" => "required|alpha_num|min:8|max:15",
            "correo" => "required|email|max:50",
            "fecha_nacimiento" => "nullable|date",
            "direccion" => ["required","max:150","regex:/^[0-9a-zA-Z\s]*$/"]
        ]);
        
        Persona::create($persona);

        return redirect()->route("persona.index")->with("persona-sucess","Se guardo correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        return view("persona.edit", compact("persona"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        $updPersona = $request->validate([
            "nombres" => "required|regex:/^[a-zA-Z\s]*$/|max:100",
            "tipo_documento" => ["required", Rule::in(["DNI","carné de extranjería"])],
            "numero_documento" => "required|alpha_num|min:8|max:15",
            "correo" => "required|email|max:50",
            "fecha_nacimiento" => "nullable|date",
            "direccion" => ["required","max:150","regex:/^[0-9a-zA-Z\s]*$/"]
        ]);
        
        $persona->update($updPersona);
        return redirect()->route("persona.index")->with("persona-sucess","Se actualizó correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->route("persona.index")->with("persona-sucess","Se eliminó correctamente");
    }
}
