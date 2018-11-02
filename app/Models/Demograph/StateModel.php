<?php

namespace App\Models\Demograph;

use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;

class StateModel extends Model
{
    use Eloquence;
    protected $searchableColumns = [
        'ibge' => 20,
        'initials' => 20,
        'name' => 20,
        'id' => 20,
    ];
    protected $fillable = ['initials','name', 'country_id', 'ibge'];
    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $table = 'states';

    public function country()
    {
        return $this->belongsTo('App\Models\Demograph\CountryModel');
    }

    public function DescriptionInitials()
    {
        return $this->name.' ('.$this->initials.')';
    }
}
