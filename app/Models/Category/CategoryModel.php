<?php

namespace App\Models\Category;

use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use Eloquence, Mappable;
    protected $maps = [
        // implicit relation mapping:
        'category_name' => 'category.name',
    ];
    protected $searchableColumns = [
        //'catname' => 20,
        //'getTypeDescription' => 20,
        'name' => 20,
        //'desctype' => 20,
        'id' => 20,
    ];

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

    public function childs()
    {
        return CategoryModel::where('category_id', $this->id)->get();
    }

    public function hasChild()
    {
        return CategoryModel::where('category_id', $this->id)->count() > 0;
    }
}
