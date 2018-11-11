<?php

namespace App\Models\Category;

use App\Models\Demograph\CityModel;
use Illuminate\Support\Facades\DB;
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
        'name' => 20,
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

    public function mainCategory($type)
    {
        return DB::select('select categories.id, categories.name, categories.isactive, 
                                         categories.type, categories.created_at, updated_at,
                                         ifnull(tbdetail.contagem, 0) contagem
                                    from categories
                               left join (select COUNT(1) contagem, categories.category_id
                                            from categories
                                           where categories.isactive = 1
                                          group by categories.category_id) tbdetail
                                      on (tbdetail.category_id = categories.id)
                                   where categories.category_id is null
                                     and categories.isactive = 1
                                     and categories.type in (:ptype, 2)', [
            'ptype' => $type]);
    }

    public function childCategory($id, $type)
    {
        return DB::select('select categories.id, categories.name, categories.isactive, 
                                         categories.type, categories.created_at, updated_at,
                                         ifnull(tbdetail.contagem, 0) contagem
                                    from categories
                               left join (select COUNT(1) contagem, categories.category_id
                                            from categories
                                           where categories.isactive = 1
                                          group by categories.category_id) tbdetail
                                      on (tbdetail.category_id = categories.id)
                                   where categories.category_id  = :pid
                                     and categories.isactive = 1
                                     and categories.type in (:ptype, 2)', [
            'pid' => $id, 'ptype' => $type]);
    }



}
