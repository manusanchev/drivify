<?php

namespace App\Http\Controllers;

use App\Travel;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getDataUsers(){
        $users = User::paginate(4);
        return $users;
    }
    public function getDataViajes(){
        $travels = Travel::paginate(4);
        return $travels;
    }

    public function editDataUser(Request $request){
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->role = $request->role;
        if($user->save())
        return response()->json(["response", 200]);
    }
    public function deleteDataUser(Request $request){
        $user = User::find($request->id);

        if($user->delete())
        return response()->json(["response", 200]);
    }
    
}
