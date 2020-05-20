<?php

namespace App\Http\Controllers;

use App\Spotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public function getHomeData()
    {
        $user = Auth::user();
        return [
            'username' => $user->username,
            'image' => $user->image,
            'kms' => $user->achievement->total_kms,
            'points' => $user->achievement->total_points

        ];
    }

    public function getPerfil()
    {
        $user = Auth::user();
        return [
            'name' => $user->name,
            'username' => $user->username,
            'spotify' => $user->spotify->access_token,
        ];
    }

    public function editarPerfil(Request $request)
    {
        $user = Auth::user();
        //comprobar que tipo de dato es
        if ($request->has('name')) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if (!$validator->fails()) {
                $user->name = $request->name;
                $user->save();
                return response()->json(["success", 200]);
            } else {
                return response()->json(["error", 404]);
            }
        } else if ($request->has('username')) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|max:255',
            ]);
            if (!$validator->fails()) {
                $user->username = $request->username;
                $user->save();
                return response()->json(["success", 200]);
            } else {
                return response()->json(["error", 404]);
            }
        }

    }

    public function uploadImage(Request $request)
    {
        $user = Auth::user();


        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];


        $extension = strtolower($request->image->getClientOriginalExtension());

        if (in_array($extension, $imageExtensions)) {
            $imageName = $user->username . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = $imageName;
            $user->save();
            return response()->json(['success' => 200]);
        } else {
            return response()->json(['error' => 500]);
        }

    }

    public function eliminarPerfil()
    {
        $user = Auth::user();
        $user->delete();
        Auth::logout();
        Session::flush();
        return redirect('/register');

    }
    public function VincularSpotify(Request $request){

            $token = $request->access_token;

            $spotify = Spotify::updateOrCreate(
                ['user_id' =>  Auth::id()],
                ['access_token' => $token]
            );
             return response()->json(['success' => 200]);


    }
}
