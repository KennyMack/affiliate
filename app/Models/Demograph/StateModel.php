<?php

namespace App\Models\Demograph;

use Illuminate\Database\Eloquent\Model;

class StateModel extends Model
{
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
