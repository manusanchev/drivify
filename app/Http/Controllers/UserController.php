<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function getHomeData(){
        $user = Auth::user();
        return [
            'username' => $user->username,
            'image' => $user->image,
            'kms' => $user->achievement->total_kms,
            'points' =>$user->achievement->total_points

        ];
    }

    public function getPerfil(){
        $user = Auth::user();
        return[
            'name' => $user->name,
            'username' => $user->username,
            'spotify'=>$user->spotify,
        ];
    }

    public function editarPerfil(Request $request){
        $user = Auth::user();
        //comprobar que tipo de dato es
        if($request->has('name')){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);
            if(!$validator->fails()){
                $user->name = $request->name;
                return response()->json(["response",200]);
            }else{
                return response()->json(["error",404]);
            }
        }

        if($request->has('username')){
            $validator = Validator::make($request->all(), [
                'username' => 'required|unique:posts|max:255',
            ]);
            if(!$validator->fails()){
                $user->username = $request->username;
                return response()->json(["response",200]);
            }else{
                return response()->json(["error",404]);
            }
        }

        if($request->has('password')){
            $validator = Validator::make($request->all(), [
                'password' => 'required|max:255',
            ]);
            if(!$validator->fails()){
                $user->password = bcrypt($request->password);
                return response()->json(["response",200]);
            }else{
                return response()->json(["error",404]);
            }
        }

//        if($request->has('image')){
//            $validator = Validator::make($request->all(), [
//                'name' => 'required|unique:posts|max:255',
//            ]);
//            if(!$validator->fails()){
//                $user->name = $request->name;
//                return response()->json(["response",200]);
//            }else{
//                return response()->json(["error",404]);
//            }
//        }


    }
    public function eliminarPerfil(){
        $user = Auth::user();
        $user->delete();

    }
}
