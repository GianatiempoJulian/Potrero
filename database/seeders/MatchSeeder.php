<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('matches')->insert([
            'team1_id'=> 1,
            'team2_id'=> 2,
            'team1_goals'=>0,
            'team2_goals'=>0,
            'max_scorer_name'=>' ',
            'max_scorer_amount'=> 0,
            'created_by'=>1
        ]);
    }
}
