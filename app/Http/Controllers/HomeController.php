<?php

namespace App\Http\Controllers;

use App\Models\Category\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main = DB::select('select categories.id, categories.name, categories.isactive, 
                                         categories.type, categories.created_at, updated_at,
                                         ifnull(tbdetail.contagem, 0) contagem
                                    from categories
                               left join (select COUNT(1) contagem, categories.category_id
                                            from categories
                                           where categories.isactive = 1
                                          group by categories.category_id) tbdetail
                                      on (tbdetail.category_id = categories.id)
                                   where categories.category_id is null
                                     and categories.isactive = 1');

        //$main = CategoryModel::whereNull('category_id')->get();

        return view('home', [
            'main' => $main
        ]);
    }
}
