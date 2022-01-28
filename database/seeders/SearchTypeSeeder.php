<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SearchType;
class SearchTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['user','repository'];
        foreach($types as $type=>$value){
            $saveType = new SearchType;
            $saveType->name = $value;
            $saveType->save();
        }
    }
}
