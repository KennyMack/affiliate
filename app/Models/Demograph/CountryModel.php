<?php

namespace App\Models\Demograph;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $fillable = ['initials','name', 'ibge'];
    protected $hidden = ['id', 'created_at', 'update_at'];
    protected $table = 'countries';
}
