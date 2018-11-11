<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Sofa\Eloquence\Eloquence;

class User extends Authenticatable
{
    use Notifiable, Eloquence;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type', // 0 - cliente 1 - Atendente 2 - Suporte 3 - Admin
        'isactive'
    ];

    protected $searchableColumns = [
        'name' => 20,
        'email' => 20
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isEmployee()
    {
        return $this->type > 0;
    }

    public function getDescType()
    {
        switch ($this->type ){
            case 0:
                return 'Cliente';
            case 1:
                return 'Atendente';
            case 2:
                return 'Suporte';
            case 3:
                return 'Administrador';
        }
    }
}
