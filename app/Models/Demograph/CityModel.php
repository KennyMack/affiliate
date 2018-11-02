<?php

namespace App\Models\Demograph;

use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    use Eloquence, Mappable;
    protected $maps = [
        'state_name' => 'state.name',
    ];
    protected $searchableColumns = [
        'ibge' => 20,
        'name' => 20,
        'id' => 20,
    ];

    protected $fillable = ['name', 'state_id', 'ibge'];
    protected $guarded = ['id'];
    protected $hidden = [ 'created_at', 'update_at'];
    protected $table = 'cities';


    public function state()
    {
        return $this->belongsTo('App\Models\Demograph\StateModel');
    }
}
