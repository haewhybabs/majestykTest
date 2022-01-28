<?php

namespace App\Http\Controllers;
use App\Models\Repository;
use App\Models\User;
use App\Models\SearchType;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function getRepos($user_id){
        $repos = User::find($user_id)->repository;
        return response()->json([
            'items'=>$repos,
            "success" => true,
        ], 200);
    }

    public function search(Request $request){
        $search = $request->query('query');
        $userId = $request->query('user_id');
        $repos = Repository::query()
        ->where('user_id',$userId)
        ->where('repo_name','LIKE',"%{$search}%")
        ->get();
        $type = SearchType::where('name','repository')->first();
        $typeId = $type->id;
        //Log search
        $this->log($search,$repos,$typeId,$userId);
        return response()->json([
            'items'=>$repos,
            "success" => true,
        ], 200);
    }
}
