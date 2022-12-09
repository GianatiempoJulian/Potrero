<?php

namespace App\Http\Controllers;

use App\models\Team;
use App\models\Player;
use App\models\User;
use App\Models\FMatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class TeamController extends Controller
{

  public function list()
  {

    if (auth()->user()->teams_own == 0) {
      return redirect('equipos/nuevo')->withErrors([
        'error_msg' => 'Debes tener al menos un equipo cargado.'
      ]);
    } else if (auth()->user()->teams_own == 1) {
      return redirect('equipos/nuevo')->withErrors([
        'error_msg' => 'Para ver esta página debes tener 2 equipos cargados.'
      ]);
    }
    $teams = Team::where('created_by', auth()->user()->id)->get();
    return view('team.list', compact('teams'));
  }

  public function create()
  {
    return view('team.create');
  }

  public function store()
  {

    $request = request()->all();


    if (auth()->user()->teams_own == 2) {
      return back()->withErrors([
        'error_msg' => 'Maximo de equipos creados (2).'
      ]);
    } else {
      $request = request()->validate([
        'team_name' => ['required', 'string'],
        'picture' => ['required', 'image', 'max:4096'],
      ], [
        'team_name.required' => 'El campo nombre de Equipo es obligatorio.',
        'picture.required' => 'El campo imagen es obligatorio',
        'picture.image' => 'El archivo imagen debe ser un formato válido',
        'picture.max' => 'El tamaño máximo de la imagen es de 4mb',
      ]);

      $team_picture = $request['picture']->store('public/team-images');
      $team_picture_url = Storage::url($team_picture);

      Team::create([
        'team_name' => $request['team_name'],
        'picture' => $team_picture_url,
        'matches' => 0,
        'matches_win' => 0,
        'matches_lost' => 0,
        'created_by' => auth()->user()->id,
      ]);

      $user = User::where('id', auth()->user()->id)->first();
      $user->teams_own =  $user->teams_own + 1;
      $user->update();

      return redirect('/equipos/nuevo');
    }
  }

  public function delete()
  {
    if (auth()->user()->teams_own == 0) {
      return redirect('equipos/nuevo')->withErrors([
        'error_msg' => 'Debes tener al menos un equipo para eliminar.'
      ]);
    }
    $teams = Team::where('created_by', auth()->user()->id)->get();
    return view('team.delete', compact('teams'));
  }

  public function remove()
  {

    $request = request()->all();


    $request = request()->validate([
      'team_id' => ['required'],
    ], [
      'team_id.required' => 'El campo nombre de Equipo es obligatorio.',
    ]);


    if (Team::where('created_by', auth()->user()->id)->where('team_id', $request['team_id'])->first() == NULL) {
      return back()->withErrors([
        'error_msg' => 'Este usuario no tiene un equipo con ese nombre.'
      ]);
    } else {


      $matches = FMatch::where('created_by', auth()->user()->id)->where('team1_id', $request['team_id'])->orWhere('team2_id', $request['team_id'])->get();
      foreach ($matches as $match) {
        if ($match->team1_id == $request['team_id']) {
          FMatch::where('created_by', auth()->user()->id)->where('team1_id', $request['team_id'])->delete();
        } else if ($match->team2_id == $request['team_id']) {
          FMatch::where('created_by', auth()->user()->id)->where('team2_id', $request['team_id'])->delete();
        }
      }

      $players = Player::where('created_by', auth()->user()->id)->where('team_id', $request['team_id'])->get();
      foreach ($players as $player) {
        $player->team_id = NULL;
        $player->team_name = "Jugador Libre";
        $player->update();
      }

      $team = Team::where('created_by', auth()->user()->id)->where('team_id', $request['team_id'])->first();
      $url = str_replace('storage', 'public', $team->picture);
      Storage::delete($url);

      Team::where('created_by', auth()->user()->id)->where('team_id', $request['team_id'])->delete();
      $user = User::where('id', auth()->user()->id)->first();
      $user->teams_own =  $user->teams_own - 1;
      $user->update();
      return redirect('/equipos/eliminar');
    }
  }


  public function edit()
  {
    if (auth()->user()->teams_own == 0) {
      return redirect('equipos/nuevo')->withErrors([
        'error_msg' => 'Debes tener al menos un equipo para editar.'
      ]);
    }
    $teams = Team::where('created_by', auth()->user()->id)->get();
    return view('team.edit', compact('teams'));
  }

  public function update(Request $request)
  {
    $request = request()->all();
    $team = Team::where('created_by', auth()->user()->id)->where('team_id', $request['team_id'])->first();
    $team->team_name = $request['team_name'];
    $team->update();
    return redirect('/equipos');
  }
}
