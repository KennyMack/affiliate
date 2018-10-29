<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $fillable = [
        'name',
        'isactive',
        'category_id',
        'type' // type: 0 - CONVIDA 1 - PLANO DE AFILIADOS 2 - AMBOS
    ];
    protected $guarded = ['id'];
    protected $hidden = [ 'created_at', 'update_at'];
    protected $table = 'categories';

    public function getTypeDescription()
    {
        switch ($this->type) {
            case 0:
                return 'Convida';
            case 1:
                return 'Clube de Vantagens';
        }
        return 'Convida/Clube de Vantagens';
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category\CategoryModel');
    }
}
