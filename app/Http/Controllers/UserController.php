<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\SearchType;
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

    public function search(Request $request){
        $search = $request->query('query');
        $users = User::query()
        ->where('name','LIKE',"%{$search}%")
        ->orWhere('username','LIKE',"%{$search}%")
        ->orWhere('email','LIKE',"%{$search}%")
        ->orWhere('location','LIKE',"%{$search}%")
        ->get();
        $type = SearchType::where('name','user')->first();
        $typeId = $type->id;
        $this->log($search,$users,$typeId);
        return response()->json([
            'items'=>$users,
            "success" => true,
        ], 200);
    }
    public function mostPopular(){
        $users = User::orderBy('popularity','desc')
        ->orderBy('followers','desc')
        ->orderBy('created_at','desc')
        ->limit(3)->get();
        return response()->json([
            'items'=>$users,
            "success" => true,
        ], 200);
    }
}
