<?php

namespace App\Models\Demograph;

use Illuminate\Database\Eloquent\Model;

class StateModel extends Model
{
    protected $fillable = ['initials','name', 'country_id', 'ibge'];
    protected $hidden = ['id', 'created_at', 'update_at'];
    protected $table = 'states';
}
