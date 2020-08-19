@extends('layout')

@section('contenido')
    <div class="mt-4">
        <div class="row">
            <h2>Módulo Persona</h2>
        </div>
        <div class="row">
            <a href="{{route("persona.create")}}" class="btn btn-primary">Crear</a>
           <div class="col-12">
                @if (session("persona-sucess"))
                <div class="alert alert-success">{{session("persona-sucess")}}</div>
                @endif
           </div>
        </div>
        <table class="table table-responsive mt-4">
            <thead>
                <th>#</th>
                <th>Nombres y Apellidos</th>
                <th>Tipo documento</th>
                <th>Número documento</th>
                <th>Correo electrónico</th>
                <th>Fecha nacimiento</th>
                <th>Dirección</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($personas as $key => $persona)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$persona->nombres}}</td>
                    <td>{{$persona->tipo_documento}}</td>
                    <td>{{$persona->numero_documento}}</td>
                    <td>{{$persona->correo}}</td>
                    <td>{{ $persona->fecha_nacimiento ? date('d/m/Y', strtotime($persona->fecha_nacimiento)) : "" }}</td>
                    <td>{{$persona->direccion}}</td>
                    <td>
                        <a href="{{route("persona.edit",$persona)}}" class="btn btn-secondary">Editar</a>
                    </td>
                    <td>
                        <form action="{{route("persona.destroy",$persona)}}" method="post">
                            @csrf @method("delete")
                            <button class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection