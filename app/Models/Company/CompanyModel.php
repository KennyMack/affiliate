<?php

namespace App\Models\Company;

use App\Utils\DateTimeEx;
use App\Utils\ImageContent;
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

    public function getType()
    {
        $companyType = $this->category()->type;

        return ($companyType == null) ? 2 : $companyType;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category\CategoryModel', 'category_id');
    }

    public function expertise()
    {
        return $this->belongsTo('App\Models\Category\CategoryModel', 'expertise_id');
    }

    public function getTime(){

        if ($this->starttime != null &&
            $this->endtime != null){


            return DateTimeEx::minToHoraMin($this->starttime) . ' às ' .
                DateTimeEx::minToHoraMin($this->endtime);
        }

        return '';
    }

    public function getImageValue()
    {
        return ($this->logopath != '') ? ImageContent::getImageBase64($this->logopath) : null;
    }

}
