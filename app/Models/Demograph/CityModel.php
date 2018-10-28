<?php

namespace App\Models\Demograph;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $fillable = ['name', 'state_id', 'ibge'];
    protected $guarded = ['id'];
    protected $hidden = [ 'created_at', 'update_at'];
    protected $table = 'cities';


    public function state()
    {
        return $this->belongsTo('App\Models\Demograph\StateModel');
    }
}
