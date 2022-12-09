<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        
        DB::table('teams')->insert([
            'matches'=>0,
            'matches_win'=>0,
            'matches_lost'=>0
        ]);
        DB::table('teams')->insert([
            'matches'=>0,
            'matches_win'=>0,
            'matches_lost'=>0
        ]);
    }
}
