<?php

namespace App\Models\Demograph;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $fillable = ['initials','name', 'state_id', 'ibge'];
    protected $hidden = ['id', 'created_at', 'update_at'];
    protected $table = 'cities';
}
