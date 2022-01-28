<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\SearchResult;
use App\Models\SearchLogging;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function log($content,$results,$typeId,$userId=null){
        $searchLog = new SearchLogging;
        $searchLog->search_content = $content;
        $searchLog->type_id = $typeId;
        $searchLog->save();
        if(count($results)>0){
            foreach($results as $result){
                $name = $result->repo_name?$result->repo_name:$result->name;
                $saveResult = new SearchResult;
                $saveResult->result_name =$name;
                $saveResult->log_id =$searchLog->id;
                $saveResult->user_id =$userId?$userId:$result->id;
                $saveResult->save();
            }
        }
    }
}
