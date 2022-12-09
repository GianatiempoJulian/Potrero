<?php

namespace App\Http\Controllers;

use App\Models\FMatch;
use App\Models\Team;
use App\Models\Player;


use Illuminate\Http\Request;

class MatchController extends Controller
{

    public function list()
    {

        $matches = FMatch::where('created_by', auth()->user()->id)->get();
        if (count($matches) == 0) {
            return back()->withErrors([
                'error_msg' => 'No hay partidos cargados.'
            ]);
        }

        $team1_name = Team::where('team_id', $matches[0]['team1_id'])->first()->team_name;
        $team2_name = Team::where('team_id', $matches[0]['team2_id'])->first()->team_name;
        return view('match.list', compact('matches', 'team1_name', 'team2_name'));
    }

    public function delete()
    {

        $matches = FMatch::where('created_by', auth()->user()->id)->get();
        if (count($matches) == 0) {
            return back()->withErrors([
                'error_msg' => 'No hay partidos cargados.'
            ]);
        }

        $team1_name = Team::where('team_id', $matches[0]['team1_id'])->first()->team_name;
        $team2_name = Team::where('team_id', $matches[0]['team2_id'])->first()->team_name;
        return view('match.delete', compact('matches', 'team1_name', 'team2_name'));
    }

    public function remove()
    {

        $request = request()->all();

        FMatch::where('created_by', auth()->user()->id)->where('match_id', $request['match_id'])->delete();
        $is_teams_null = FMatch::where('created_by', auth()->user()->id)->get();

        if (count($is_teams_null) == NULL) {
            return redirect('/partidos/nuevo')->withErrors([
                'error_msg' => 'Debe haber un minimo partido un cargador para poder eliminar.'
            ]);
        } else {
            return redirect('partidos/eliminar');
        }
    }

    public function last_match()
    {

        $team1 = Team::where('created_by', auth()->user()->id)->first();
        $team2 = Team::where('created_by', auth()->user()->id)->skip(1)->first();

        if ($team1 == NULL) {
            return redirect('equipos/nuevo')->withErrors([
                'error_msg' => 'Debes cargar primero un equipo.'
            ]);
        }

        if ($team1 != NULL && $team2 == NULL) {
            return redirect('equipos/nuevo')->withErrors([
                'error_msg' => 'Debes tener 2 equipos.'
            ]);
        }

        $team1_players = Player::where('team_id', $team1->team_id)->where('plays_today', 1)->get();
        $team2_players = Player::where('team_id', $team2->team_id)->where('plays_today', 1)->get();


        if (count($team1_players) == 0 || count($team2_players) == 0) {
            return back()->withErrors([
                'error_msg' => 'Debes cargar minimo un jugador en cada equipo.'
            ]);
        }

        $goal_avg_t1 = null;
        $goal_avg_t2 = null;

        foreach ($team1_players as $player) {
            if ($player->matches_with_this_team > 0) {
                $goal_avg_t1 = ($goal_avg_t1 + $player->goals_with_this_team) / $player->matches_with_this_team;
            }
        }

        foreach ($team2_players as $player) {
            if ($player->matches_with_this_team > 0) {
                $goal_avg_t2 = ($goal_avg_t2 + $player->goals_with_this_team) / $player->matches_with_this_team;
            }
        }

        $goal_avg_t1 = number_format($goal_avg_t1, 2);
        $goal_avg_t2 = number_format($goal_avg_t2, 2);

        /* Last - match */
        $max_number = FMatch::where('created_by', auth()->user()->id)->max('match_id');
        $last = FMatch::where('match_id', $max_number)->first();

        if ($last == NULL) {
            return redirect('partidos/nuevo')->withErrors([
                'error_msg' => 'Debes cargar un partido primero.'
            ]);
        }

        return view('match.last_match', compact('team1_players', 'team2_players', 'team1', 'team2', 'goal_avg_t1', 'goal_avg_t2', 'last'));
    }

    public function create()
  {

    /* Equipos */
    $teams = Team::where('created_by', auth()->user()->id)->get();

    if (count($teams) < 2) {
      return redirect('/equipos/nuevo')->withErrors([
        'error_msg' => 'Debes tener 2 equipos para cargar un partido.'
      ]);
    }

    $team1 = Team::where('created_by', auth()->user()->id)->first()->team_id;
    $team2 = Team::where('created_by', auth()->user()->id)->skip(1)->first()->team_id;

    $team1_players = Player::where('team_id', $team1)->where('plays_today', 1)->get();
    $team2_players = Player::where('team_id', $team2)->where('plays_today', 1)->get();

    if (count($team1_players) == 0 || count($team2_players) == 0) {
      return back()->withErrors([
        'error_msg' => 'Debes cargar minimo un jugador en cada equipo.'
      ]);
    }

    /* Jugadores */
    $players = Player::where('created_by', auth()->user()->id)->where('plays_today', 1)->get();

    /* Last - match */
    $max_number = FMatch::max('match_id');
    $last = FMatch::where('match_id', $max_number)->get();

    return view('match.create', compact('players', 'last', 'teams'));
  }



  public function store()
  {

    $request = request()->all();
    $max_scorer_id = null;


    $request = request()->validate([
      'team_win' => ['required'],
      'team_goals.*' => ['required', 'numeric', 'min:0'],
      'player_id' => ['required'],
      'today_goals' => ['required'],
      'team_id' => ['required']

    ], [
      'team_win.required' => 'El campo equipo ganador es obligatorio.',
      'team_goals.*.required' => 'Goles de equipo son obligatorios.',
      'team_goals.*.min' => 'Goles de ambos equipo son obligatorios.',
    ]);

    /* EQUIPOS */
    

    $teams = Team::all();

    for ($y = 0; $y < count($teams); $y++) {
      $teams[$y]->matches =  $teams[$y]->matches + 1;
      if ($teams[$y]->team_id == $request['team_win']) {
        $teams[$y]->matches_win = $teams[$y]->matches_win + 1;
      } else {
        $teams[$y]->matches_lost = $teams[$y]->matches_lost + 1;
      }
      $teams[$y]->update();
    }



    /* JUGADORES */

    for ($x = 0; $x < count($request['player_id']); $x++) {

      $player = Player::where('player_id', $request['player_id'][$x])->first();
      $player->matches = $player->matches + 1;
      $player->goals = $player->goals + $request['today_goals'][$x];

      if ($request['today_goals'][$x] == null) {
        $request['today_goals'][$x] = 0;
      }

      $player->today_goals = $request['today_goals'][$x];
      $player->matches_with_this_team = $player->matches_with_this_team + 1;
      $player->goals_with_this_team = $player->goals_with_this_team + $request['today_goals'][$x];

      if ($player->team_id == $request['team_win']) {
        $player->matches_win = $player->matches_win + 1;
      }

      if ($request['today_goals'][$x] == max($request['today_goals'])) {
        $max_scorer_id =  $request['player_id'][$x];
      }

      $player->update();
    }

    /* Partido */

    FMatch::create([
      'team1_id' => $request['team_id'][0],
      'team2_id' => $request['team_id'][1],
      'team1_goals' => $request['team_goals'][0],
      'team2_goals' => $request['team_goals'][1],
      'max_scorer_name' =>  Player::where('player_id', $max_scorer_id)->first()->last_name,
      'max_scorer_amount' =>  max($request['today_goals']),
      'created_by' => auth()->user()->id
    ]);

    return redirect('/partidos/ultimo');
  }

  public function historialToPDF(){


   
    $matches = FMatch::where('created_by', auth()->user()->id)->get();
        if (count($matches) == 0) {
            return back()->withErrors([
                'error_msg' => 'No hay partidos cargados.'
            ]);
        }

        $team1_name = Team::where('team_id', $matches[0]['team1_id'])->first()->team_name;
        $team2_name = Team::where('team_id', $matches[0]['team2_id'])->first()->team_name;
        return view('match.list', compact('matches', 'team1_name', 'team2_name'));
  
  }
}
