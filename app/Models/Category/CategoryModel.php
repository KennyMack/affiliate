<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $fillable = ['name','isactive','type'];
    protected $hidden = ['id', 'category_id', 'created_at', 'update_at'];
    protected $table = 'categories';
}
