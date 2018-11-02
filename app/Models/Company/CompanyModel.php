<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    protected $fillable = [
        'companyname',
        'cnpjcpf',
        'status', // 0- inativo 1- ativo
        'city_id',
        'street',
        'district',
        'number',
        'postalnumber',
        'logopath',
        'logourl',
        'phone',
        // area de ocupação
        'category_id',
        // especialidade
        'expertise_id',
        'details',
        'starttime',
        'endtime'
    ];
    protected $guarded = ['id'];
    protected $hidden = [ 'created_at', 'update_at'];
    protected $table = 'companies';

    public function city()
    {
        return $this->belongsTo('App\Models\Demograph\CityModel');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category\CategoryModel');
    }

    public function getTime(){

        if ($this->starttime != null &&
            $this->endtime != null){
            return $this->starttime . 'às' . $this->endtime;
        }

        return '';
    }

}
