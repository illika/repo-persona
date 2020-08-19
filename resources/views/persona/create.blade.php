@extends('layout')

@section('contenido')
    <div class="mt-4">
        @if (session("msg"))
            <div class="alert alert-danger">{{session("msg")}}</div>
            @endif
        <h2>Crear Persona</h2>
        <div class="row col-12">
            <a href="{{route("persona.index")}}" class="btn btn-primary"> Regresar</a>
        </div>        
        <div class="row mt-4">
            <div class="col-12">
                <form action="{{route("persona.store")}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombres">Nombre y Apellidos</label>
                        <input type="text" name="nombres" id="nombres" class="form-control" value="{{old("nombres")}}">
                        @error('nombres')
                            <span class="text-danger">{{ $errors->first("nombres") }}</span>
                        @enderror
                        <span class="text-danger" id="msg-nombres">Ingrese Texto y máximo 100 caracteres</span>
                    </div>
                    <div class="form-group">
                        <label for="tipo_documento">Tipo de documento - "DNI" o "carné de extranjería"</label>
                        <input type="text" name="tipo_documento" id="tipo_documento" class="form-control" value="{{old("tipo_documento")}}">
                        @error('tipo_documento')
                            <span class="text-danger">{{ $errors->first("tipo_documento") }}</span>
                        @enderror
                        <span class="text-danger" id="msg-tipo">Ingrese "DNI" o "carné de extranjería"</span>
                    </div>                
                    <div class="form-group">
                        <label for="numero_documento">Número de documento</label>
                        <input type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{old("numero_documento")}}">
                        @error('numero_documento')
                            <span class="text-danger">{{ $errors->first("numero_documento") }}</span>
                        @enderror
                        <span class="text-danger" id="msg-numero">Se permite texto y números, máximo 15 caracteres</span>
                    </div>                    
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control" value="{{old("correo")}}">
                        @error('correo')
                            <span class="text-danger">{{ $errors->first("correo") }}</span>
                        @enderror
                        <span class="text-danger" id="msg-correo">Ingrese correo, máximo 50 caracteres</span>
                    </div>           
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha nacimiento</label>
                        <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{old("fecha_nacimiento")}}">
                        @error('fecha_nacimiento')
                            <span class="text-danger">{{ $errors->first("fecha_nacimiento") }}</span>
                        @enderror
                        <span class="text-danger" id="msg-fecha">Fecha incorrecta, formato dd/mm/aaaa</span>
                    </div>
                    <div class="form-group">
                        <label for="departamento">Departamento</label>
                        <select name="departamento" id="departamento" class="form-control">
                        </select>
                        <label for="provincia">Provincia</label>
                        <select name="provincia" id="provincia" class="form-control">
                        </select>
                        <label for="distrito">Distrito</label>
                        <select name="distrito" id="distrito" class="form-control">
                        </select>
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{old("direccion")}}">
                        @error('direccion')
                            <span class="text-danger">{{ $errors->first("direccion") }}</span>
                        @enderror
                        <span class="text-danger" id="msg-direccion">Se permite letras y números, máximo 150 caracteres </span>
                    </div>
                    <button class="btn btn-secondary" id="btnLimpiar">Limpiar</button>
                    <button class="btn btn-success">Enviar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $( function() {
            $("#fecha_nacimiento").datepicker({
                dateFormat: 'dd/mm/yy'
            });

            function getDepartamento() {
                var optDepartamento = "";
                $.ajax({
                    type:"Get",
                    url: "{{route('sede.getdepartamento')}}",
                    success: function(data) {
                        var departamentos = JSON.parse(data);
                        optDepartamento += "<option value='-'>Seleccione departamento</option>";
                        for(let departamento of departamentos) {
                            optDepartamento += `<option value='${departamento["id"]}'>${departamento["nombre"]}</option>`;
                        }
                        $("#departamento").append(optDepartamento);
                    }
                });
            };
            getDepartamento();

            $("#departamento").on("change", function() {
                var id = $(this).val();
                $("#provincia").empty();
                getProvincia(id)
            });

            function getProvincia(id) {
                var optProvincia = "";

                url = "{{route('sede.getprovincia',':id')}}"
                url = url.replace(':id', id);

                $.ajax({
                    type:"Get",
                    url: url,
                    success: function(data) {
                        var provincias = JSON.parse(data);
                        if (provincias.length > 0) {
                            optProvincia += "<option value='-'>Seleccione provincia</option>";
                            for(let provincia of provincias) {
                                optProvincia += `<option value='${provincia["id"]}'>${provincia["nombre"]}</option>`;
                            }
                            $("#provincia").append(optProvincia);
                        } else {
                            $("#provincia").empty();
                        }
                    }
                });
            };

            $("#provincia").on("change", function() {
                var id = $(this).val();
                $("#distrito").empty();
                getDistrito(id)
            });

            function getDistrito(id) {
                var optDistrito = "";

                url = "{{route('sede.getdistrito',':id')}}"
                url = url.replace(':id', id);

                $.ajax({
                    type:"Get",
                    url: url,
                    success: function(data) {
                        var distritos = JSON.parse(data);
                        if (distritos.length > 0) {
                            optDistrito += "<option value='-'>Seleccione distrito</option>";
                            for(let distrito of distritos) {
                                optDistrito += `<option value='${distrito["id"]}'>${distrito["nombre"]}</option>`;
                            }
                            $("#distrito").append(optDistrito);
                        } else {
                            $("#distrito").empty();
                        }
                    }
                });
            };

            function msg() {
                $("#msg-nombres").hide();
                $("#msg-tipo").hide();
                $("#msg-numero").hide();
                $("#msg-fecha").hide();
                $("#msg-correo").hide();
                $("#msg-direccion").hide();
            };

            msg();

            $("#btnLimpiar").on("click", function(e) {
                e.preventDefault();

                $("#nombres").val("");
                $("#tipo_documento").val("");
                $("#numero_documento").val("");
                $("#fecha_nacimiento").val("");
                $("#correo").val("");
                $("#direccion").val("");

                $(".text-danger").hide();
            });

            $("#nombres").on("focusout", function() {
                let nombres = $(this).val();

                var regex = new RegExp("^[a-zA-Z ]+$");

                if (nombres.length <= 100 && regex.test(nombres)) {
                    $("#msg-nombres").hide();
                } else {
                    $("#msg-nombres").show();
                }
            });

            $("#tipo_documento").on("focusout", function() {
                let tipo = $(this).val();

                if (tipo !== "DNI" && tipo !== "carné de extranjería") {
                    $("#msg-tipo").show();
                } else {
                    $("#msg-tipo").hide();
                }
            });

            $("#numero_documento").on("focusout", function() {
                let num_doc = $(this).val();

                var regex = new RegExp("^[a-zA-Z0-9]+$");

                if (num_doc.length <= 15 && regex.test(num_doc)) {
                    $("#msg-numero").hide();
                } else {
                    $("#msg-numero").show();
                }
            })

            $("#correo").on("focusout", function() {
                let correo = $(this).val();

                var regex = new RegExp("");
                
                if (correo.length <= 50 && /\S+@\S+\.\S+/.test(correo)) {
                    $("#msg-correo").hide();
                } else {
                    $("#msg-correo").show();
                }

            })

            $("#fecha_nacimiento").on("focusout", function() {
                let fecha = $(this).val();
                if (fecha.length > 0) {
                    if (isNaN(fecha)) {
                        $("#msg-fecha").hide();
                    }else {
                        $("#msg-fecha").show();
                    }
                } else {
                    $("#msg-fecha").hide();
                }

            })

            $("#direccion").on("focusout", function() {
                let direccion = $(this).val();

                var regex = new RegExp("^[a-zA-Z0-9 ]+$");

                if (direccion.length <= 150 && regex.test(direccion)) {
                    $("#msg-direccion").hide();
                } else {
                    $("#msg-direccion").show();
                }
            })

        } );
    </script>
@endsection