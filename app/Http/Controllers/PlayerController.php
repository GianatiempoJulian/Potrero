<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PlayerController extends Controller
{
    public function list()
    {
        $players = Player::where('created_by', auth()->user()->id)->get();

        $teams = Team::where('created_by', auth()->user()->id)->get();

        if (count($teams) == 0) {
            return redirect('/equipos/nuevo')->withErrors([
                'error_msg' => 'Debes tener minimo un equipo.'
            ]);
        }
        if (count($players) == NULL) {
            return redirect('/jugadores/nuevo')->withErrors([
                'error_msg' => 'La lista de jugadores esta vacia. Cargue minimo uno.'
            ]);
        } else {
            $teams = Team::where('created_by', auth()->user()->id)->get();
            return view('player.list', compact('players','teams'));
        }
    }

    public function create()
    {
        $teams = Team::where('created_by', auth()->user()->id)->get();
        if (count($teams) == 0) {
            return redirect('/equipos/nuevo')->withErrors([
                'error_msg' => 'Debes tener min. un equipo para cargar jugadores.'
            ]);
        }
        return view('player.create', compact('teams'));
    }

    public function store()
    {

        $request = request()->all();


        $request = request()->validate([
            'team_id' => ['required', 'integer'],
            'picture' => ['required', 'image', 'max:4096'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
        ], [
            'picture.required' => 'El campo imagen es obligatorio',
            'picture.image' => 'El archivo imagen debe ser un formato válido',
            'picture.max' => 'El tamaño máximo de la imagen es de 4mb',
            'team_id.required' => 'El campo ID de Equipo es obligatorio.',
            'first_name.required' => 'El campo nombre es obligatorio.',
            'last_name.required' => 'El campo apellido es obligatorio.',
        ]);

        $player_picture = $request['picture']->store('public/player-images');
        $player_picture_url = Storage::url($player_picture);

        Player::create([
            'team_id' => $request['team_id'],
            'picture' => $player_picture_url,
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'matches' => 0,
            'matches_win' => 0,
            'goals' => 0,
            'average' => 0,
            'today_goals' => 0,
            'matches_with_this_team' => 0,
            'goals_with_this_team' => 0,
            'plays_today' => 1, //0
            'created_by' => auth()->user()->id
        ]);

        return redirect('/jugadores');
    }




    public function delete()
    {

        $players = Player::where('created_by', auth()->user()->id)->get();

        if (count($players) == NULL) {
            return redirect('jugadores/nuevo')->withErrors([
                'error_msg' => 'Debes tener al menos un jugador para eliminar.'
            ]);
        } else {
            return view('player.delete', compact('players'));
        }
    }

    public function remove()
    {


        $request = request()->all();


        $request = request()->validate([
            'player_id' => ['required'],
        ], [
            'player_id.required' => 'Hubo un error al solicitar ID del jugador. Intente nuevamente.',
        ]);

        $player = Player::where('created_by', auth()->user()->id)->where('player_id', $request['player_id'])->first();
        $url = str_replace('storage','public',$player->picture);
        Storage::delete($url);
        
        Player::where('created_by', auth()->user()->id)->where('player_id', $request['player_id'])->delete();
        return redirect('/jugadores');
    }

    public function edit($id)
    {
        $player = Player::where('created_by', auth()->user()->id)->where('player_id',$id)->first();
        $teams = Team::where('created_by', auth()->user()->id)->get();
        return view('player.edit',compact('player','teams'));
    }

    public function update(Request $request)
    {
        $request = request()->all();

        $player = Player::where('created_by', auth()->user()->id)->where('player_id', $request['player_id'])->first();

        $player->team_id = $request['team_id'];
        $player->first_name = $request['first_name'];
        $player->last_name = $request['last_name'];
        $player->matches = $request['matches'] == NULL ? $player->matches : $request['matches'];
        $player->matches_win = $request['matches_win'] == NULL ? $player->matches_win : $request['matches_win'];
        $player->goals = $request['goals'] == NULL ? $player->goals : $request['goals'];
        $player->plays_today = $request['plays_today'];
        $player->update();
        return redirect('/jugadores');
    }

    public function change_team()
    {
        $request = request()->all();


        $request = request()->validate([
            'player_id' => ['required'],
        ], [
            'player_id.required' => 'Hubo un error al solicitar ID del jugador. Intente nuevamente.',
        ]);


        $player = Player::where('created_by', auth()->user()->id)->where('player_id', $request['player_id'])->first();
        $teams = Team::where('created_by', auth()->user()->id)->get();

        for ($x = 0; $x < count($teams); $x++) {
            if ($teams[$x]['team_id'] == $player->team_id) {
                $player->team_id = $teams[$x + 1]['team_id'];
                $player->team_name = $teams[$x + 1]['team_name'];
            }
        }

        return redirect('/jugadores');
    }
}
