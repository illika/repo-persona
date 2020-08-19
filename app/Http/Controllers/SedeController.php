<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    public function getDepartamento() {
        $departamento = Sede::whereNull("provincia")->whereNull("distrito")->get();
        return response(json_encode($departamento));
    }

    public function getProvincia($id) {
        $provincia = Sede::where("provincia","=",$id)->get();
        return response(json_encode($provincia));
    }

    public function getDistrito($id) {
        $distrito = Sede::where("distrito","=",$id)->get();
        return response(json_encode($distrito));
    }
}
