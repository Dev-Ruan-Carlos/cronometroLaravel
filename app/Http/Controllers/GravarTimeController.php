<?php

namespace App\Http\Controllers;

use App\Models\Cronometro;
use Illuminate\Http\Request;

class GravarTimeController extends Controller
{

    public function gravar (Request $request) {
        $cronometro = new Cronometro();
        $cronometro->tempo = $request->get('tempo');
        $cronometro->session = session()->getId();
        $cronometro->save();
    }

    public function index(){
        return view('welcome');
    }

}
