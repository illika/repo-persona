<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $fillable = ["nombre", "provincia", "distrito"];

    public $timestamps = false;
}
