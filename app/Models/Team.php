<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $primaryKey = 'team_id';
    protected $fillable = [
        'team_name',
        'picture',
        'matches',
        'matches_win',
        'matches_lost',
        'created_by'
    ];

}
