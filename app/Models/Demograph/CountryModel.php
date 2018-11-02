<?php

namespace App\Models\Demograph;

use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    use Eloquence;
    protected $searchableColumns = [
        'ibge' => 20,
        'initials' => 20,
        'name' => 20,
        'id' => 20,
    ];
    protected $fillable = ['initials','name', 'ibge'];
    protected $guarded = ['id'];
    protected $hidden = [ 'created_at', 'update_at'];
    protected $table = 'countries';
}
