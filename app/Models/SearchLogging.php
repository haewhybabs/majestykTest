<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchLogging extends Model
{
    use HasFactory;
    protected $table = 'search_loggings';
    public function result(){
        return $this->hasMany(SearchResult::class,'log_id', 'id');
    }
}
