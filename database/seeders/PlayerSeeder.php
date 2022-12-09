<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('players')->insert([
            'team_id'=> 1,
            'picture'=>'julian_pic.png',
            'first_name'=>'Julian',
            'last_name'=>'Gianatiempo',
            'matches'=>0,
            'matches_win'=>0,
            'goals'=>0,
            'average'=>0.0,
            'today_goals'=>0,
            'matches_with_this_team'=>0,
            'goals_with_this_team'=>0,
            'plays_today'=> 1
        ]);
        DB::table('players')->insert([
            'team_id'=> 1,
            'picture'=>'franco_pic.png',
            'first_name'=>'Franco',
            'last_name'=>'Gomez',
            'matches'=>0,
            'matches_win'=>0,
            'goals'=>0,
            'average'=>0.0,
            'today_goals'=>0,
            'matches_with_this_team'=>0,
            'goals_with_this_team'=>0,
            'plays_today'=> 1
        ]);
        DB::table('players')->insert([
            'team_id'=> 1,
            'picture'=>'biza_pic.png',
            'first_name'=>'Biza',
            'last_name'=>' ',
            'matches'=>0,
            'matches_win'=>0,
            'goals'=>0,
            'average'=>0.0,
            'today_goals'=>0,
            'matches_with_this_team'=>0,
            'goals_with_this_team'=>0,
            'plays_today'=> 1
        ]);
        DB::table('players')->insert([
            'team_id'=> 1,
            'picture'=>'manes_pic.png',
            'first_name'=>'Manes',
            'last_name'=>' ',
            'matches'=>0,
            'matches_win'=>0,
            'goals'=>0,
            'average'=>0.0,
            'today_goals'=>0,
            'matches_with_this_team'=>0,
            'goals_with_this_team'=>0,
            'plays_today'=> 1
        ]);
        DB::table('players')->insert([
            'team_id'=> 1,
            'picture'=>'joel_pic.png',
            'first_name'=>'Joel',
            'last_name'=>'',
            'matches'=>0,
            'matches_win'=>0,
            'goals'=>0,
            'average'=>0.0,
            'today_goals'=>0,
            'matches_with_this_team'=>0,
            'goals_with_this_team'=>0,
            'plays_today'=> 1
        ]);
        DB::table('players')->insert([
            'team_id'=> 2,
            'picture'=>'facundo_pic.png',
            'first_name'=>'Facundo',
            'last_name'=>'Quevedo',
            'matches'=>0,
            'matches_win'=>0,
            'goals'=>0,
            'average'=>0.0,
            'today_goals'=>0,
            'matches_with_this_team'=>0,
            'goals_with_this_team'=>0,
            'plays_today'=> 1
        ]);
        DB::table('players')->insert([
            'team_id'=> 2,
            'picture'=>'santiago_pic.png',
            'first_name'=>'Santiago',
            'last_name'=>'Clearly',
            'matches'=>0,
            'matches_win'=>0,
            'goals'=>0,
            'average'=>0.0,
            'today_goals'=>0,
            'matches_with_this_team'=>0,
            'goals_with_this_team'=>0,
            'plays_today'=> 1
        ]);
        DB::table('players')->insert([
            'team_id'=> 2,
            'picture'=>'federico_pic.png',
            'first_name'=>'Federico',
            'last_name'=>'Rojas',
            'matches'=>0,
            'matches_win'=>0,
            'goals'=>0,
            'average'=>0.0,
            'today_goals'=>0,
            'matches_with_this_team'=>0,
            'goals_with_this_team'=>0,
            'plays_today'=> 1
        ]);
        DB::table('players')->insert([
            'team_id'=> 2,
            'picture'=>'landi_pic.png',
            'first_name'=>'Landi',
            'last_name'=>'',
            'matches'=>0,
            'matches_win'=>0,
            'goals'=>0,
            'average'=>0.0,
            'today_goals'=>0,
            'matches_with_this_team'=>0,
            'goals_with_this_team'=>0,
            'plays_today'=> 1
        ]);
        DB::table('players')->insert([
            'team_id'=> 2,
            'picture'=>'lautaro_pic.png',
            'first_name'=>'Lautaro',
            'last_name'=>'',
            'matches'=>0,
            'matches_win'=>0,
            'goals'=>0,
            'average'=>0.0,
            'today_goals'=>0,
            'matches_with_this_team'=>0,
            'goals_with_this_team'=>0,
            'plays_today'=> 1
        ]);
       
        
    }
}
