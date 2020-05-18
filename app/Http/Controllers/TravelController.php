<?php

namespace App\Http\Controllers;

use App\Travel;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;


class TravelController extends Controller
{
    public function crearViaje(Request $request){
        $travel = new Travel();

        $travel->departure = $request->salida;
        $travel->destination = $request->destino;
        $travel->coordinates_departure = $request->cooSalida;
        $travel->coordinates_destination = $request->cooDestino;
        $travel->travel_date = Carbon::now()->toDateString();
        $travel->travel_code = Str::random(6);
        $travel->passengers = 1;
        $travel->distance = $request->distancia;
        $travel->duration = $request->duracion;
        $travel->save();
        $user = Auth::user();
        $user->travels()->attach($travel->id);
        return response()->json(["success", 200]);
    }

    public function comprobarCodigo(Request $request){
        $codigo= $request->codigo;
        $travel = Travel::all()->where('travel_code',"LIKE",$codigo);
        if(strlen($travel[0]) > 0){
            return response()->json(["success",200]);
        }else{
            return response()->json(["error",404]);
        }

    }
}
