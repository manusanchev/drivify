<?php

namespace App\Http\Controllers;

use App\Playlist;
use App\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function addSongs(Request $request)
    {
        $travel_id = session('travel_id');

        $arr = json_decode($request["songs"], true);
        $user = Auth::user();
        foreach ($arr as $item) {
            $playlist = new Playlist();
            $playlist->song = $item["id"];
            $playlist->travel_id = $travel_id;
            $playlist->save();

        }
        if ($request->type == "conductor") {

            $travel = Travel::find($travel_id);
            $travel->has_playlist = 1;
            $travel->save();

            $playlist = Playlist::all()->where('travel_id', '=', $travel_id);
            return $playlist;
        } else {
            $user->travels()->updateExistingPivot($travel_id, ['ready' => 1]);
            return response()->json(["success", 200]);
        }


    }
}
