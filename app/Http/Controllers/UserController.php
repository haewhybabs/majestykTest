<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request){
        $users = User::orderBy('no_of_repository','desc')
        ->orderBy('followers','desc')->orderBy('popularity','desc')
        ->paginate(3);
        return response()->json([
            'items'=>$users,
            "success" => true,
        ], 200);
    }
    public function userById($id){
        $user = User::find($id);
        if($user){
            $user->popularity = $user->popularity +1 ;
            $user->update();
            return response()->json([
                'items'=>$user,
                "success" => true,
            ], 200);
        }
        return response()->json([
            "success" => false,
        ], 404);
    }
}
