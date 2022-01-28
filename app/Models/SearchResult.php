<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchResult extends Model
{
    use HasFactory;
    protected $table = 'search_results';
    
    public function searchLog()
    {
        return $this->belongsTo(SearchLogging::class);
    }
}
