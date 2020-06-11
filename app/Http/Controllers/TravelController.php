<?php

namespace App\Http\Controllers;

use App\Achievement;
use App\Travel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TravelController extends Controller
{
    public function crearViaje(Request $request)
    {

        $travel = new Travel();
        $code = Str::random(6);
        $travel->departure = $request->salida;
        $travel->destination = $request->destino;
        $travel->coordinates_departure = $request->cooSalida;
        $travel->coordinates_destination = $request->cooDestino;
        $travel->travel_date = Carbon::now()->toDateString();
        $travel->travel_code = $code;
        $travel->passengers = $request->ocupantes;
        $travel->distance = $request->distancia;
        $travel->duration = $request->duracion;
        $travel->save();
        $user = Auth::user();
        $user->travels()->attach($travel->id);
        $id = DB::table("achievements")
            ->where("user_id", $user->getAuthIdentifier())->get("id");
        $achievements = Achievement::find($id[0]->id);
        $achievements->total_points = $achievements->total_points + (round(($request->ocupantes * $request->distancia) / ($request->duracion / 2)));
        $achievements->total_kms = $achievements->total_kms + $request->distancia;
        $achievements->save();
        session(['travel_id' => $travel->id]);
        return response()->json(["code", $code]);
    }

    public function getCode()
    {

        $travel_id = session('travel_id');
        $travel = Travel::find($travel_id);
        return [
            "travel_code" => $travel->travel_code,
            "duracion" => $travel->duration
        ];

    }

    public function comprobarCodigo(Request $request)
    {
        $codigo = $request->codigo;

        $travel = Travel::where('travel_code', "LIKE", $codigo)->get();

        if (sizeof($travel) > 0) {
            $countPassengers = DB::table('travel_user')->where('travel_id', $travel[0]->id)->count();

            if ($travel[0]->passengers > $countPassengers) {
                $user = Auth::user();
                $user->travels()->attach($travel[0]->id);
                session(['travel_id' => $travel[0]->id]);
                return response()->json(["success", 200]);

            } else {

                return response()->json(["limit", 1]);
            }


        } else {
            return response()->json(["error", 404]);
        }


    }

    public function has_playlist()
    {

        if (session()->has("travel_id")) {
            $travel_id = session('travel_id');
            $travel = Travel::find($travel_id);
            if ($travel->has_playlist) {
                return response()->json(["response" => "yes"]);
            } else {
                return response()->json(["response" => "no"]);
            }
        } else {
            return response()->json(["response", 500]);
        }
    }


    public function getPassengersData()
    {
        $travel_id = session('travel_id');
        $travel = Travel::find($travel_id);

        $pasajerosReady = DB::table('travel_user')->where([['travel_id', $travel_id], ["ready", 1]])->count();
        return [
            "pasajeros_listos" => $pasajerosReady,
            "pasajeros_total" => $travel->passengers

        ];
    }

    //tus viajes
    public function options()
    {
        $user = Auth::user();

        $departures = $user->travels()->get()->unique('departure')->pluck("departure");

        return response()->json(["departures" => $departures]);
    }

    public function optionsDestination(Request $request)
    {
        $user = Auth::user();
        $destinations = $user->travels()->where(["departure" => $request->salida])->get()->unique('destination')->pluck("destination");
        return response()->json(["destinations" => $destinations]);
    }

    public function getViajes(Request $request)
    {
        $fecha = $request->fecha;
        $salida = $request->salida;
        $destino = $request->destino;

        $where = [];

        if (strlen($fecha) > 0 && (strlen($salida) == 0 && strlen($destino) == 0)) {

            $where = [
                "travel_date" => $fecha,
            ];
        } else if (strlen($salida) > 0 && strlen($destino) > 0) {
            $where = [
                "departure" => $salida,
                "destination" => $destino
            ];

        } else {
            $where = [
                "travel_date" => $fecha,
                "departure" => $salida,
                "destination" => $destino
            ];

        }
        $user = Auth::user();
        $travel = $user->travels()->where($where)->paginate(5);
        return $travel;

        //return response()->json(["response",200]);
    }
    public function detalles(Request $request){

        $travel = Travel::find($request->id);
        return $travel;
    }


}
