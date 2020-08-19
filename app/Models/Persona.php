<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ["nombres", "tipo_documento","numero_documento","correo","fecha_nacimiento","direccion"];

    public $timestamps = false;
}
