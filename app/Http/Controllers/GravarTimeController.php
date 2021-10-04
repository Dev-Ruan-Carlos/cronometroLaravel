<?php

namespace App\Http\Controllers;

use App\Models\cronometro;
use Illuminate\Http\Request;

class GravarTimeController extends Controller
{

    public function gravar (Request $request) {
        $timeStemp = new cronometro();
        $timeStemp->centesimos = $request->get('centesimos');
        $timeStemp->segundos = $request->get('segundos');
        $timeStemp->minutos = $request->get('minutos');
        $timeStemp->horas = $request->get('horas');
        $timeStemp->save();
        dd($timeStemp);
        return view('welcome');
    }
    public function index(){
        return view('welcome');
    }

}
