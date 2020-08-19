@extends('layout')

@section('contenido')
    <div class="mt-4">
        <h2>Crear Persona</h2>
        <div class="row col-12">
            <a href="{{route("persona.index")}}" class="btn btn-primary"> Regresar</a>
        </div>        
        <div class="row mt-4">
            <div class="col-12">
                <form action="{{route("persona.update",$persona)}}" method="POST">
                    @csrf @method("patch")
                    <div class="form-group">
                        <label for="nombres">Nombre y Apellidos</label>
                        <input type="text" name="nombres" id="" class="form-control" value="{{old("nombres", $persona->nombres)}}">
                        @error('nombres')
                            <span class="text-danger">{{ $errors->first("nombres") }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tipo_documento">Tipo de documento - "DNI" o "carné de extranjería"</label>
                        <input type="text" name="tipo_documento" id="" class="form-control" value="{{old("tipo_documento", $persona->tipo_documento)}}">
                        @error('tipo_documento')
                            <span class="text-danger">{{ $errors->first("tipo_documento") }}</span>
                        @enderror
                    </div>                
                    <div class="form-group">
                        <label for="numero_documento">Número de documento</label>
                        <input type="text" name="numero_documento" id="" class="form-control" value="{{old("numero_documento", $persona->numero_documento)}}">
                        @error('numero_documento')
                            <span class="text-danger">{{ $errors->first("numero_documento") }}</span>
                        @enderror
                    </div>                    
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" name="correo" id="" class="form-control" value="{{old("correo", $persona->correo)}}">
                        @error('correo')
                            <span class="text-danger">{{ $errors->first("correo") }}</span>
                        @enderror
                    </div>           
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="" class="form-control" value="{{old("fecha_nacimiento", $persona->fecha_nacimiento)}}">
                        @error('fecha_nacimiento')
                            <span class="text-danger">{{ $errors->first("fecha_nacimiento") }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="" class="form-control" value="{{old("direccion", $persona->direccion)}}">
                        @error('direccion')
                            <span class="text-danger">{{ $errors->first("direccion") }}</span>
                        @enderror
                    </div>
                    <button class="btn btn-success btn-block">Enviar</button>
                </form>
            </div>
        </div>
    </div>
@endsection