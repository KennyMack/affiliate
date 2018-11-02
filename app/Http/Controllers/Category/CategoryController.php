<?php

namespace App\Http\Controllers\Category;

use App\Http\Requests\Category\CreateCategoryFormRequest;
use App\Http\Requests\Category\UpdateCategoryFormRequest;
use App\Models\Category\CategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    private function getCategories($id)
    {
        if ($id === -1)
            return CategoryModel::all()->sortBy('name', 0);

        return CategoryModel::where('id', '<>', $id)->get()->sortBy('name', 0);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('txtsearch');

        if (isset($search)) {

            $results = CategoryModel::search($search)->orderBy('name', 'desc');
        }
        else
            $results = CategoryModel::orderBy('name', 'desc');
        return view('Category.index',[
            'categories' => $results->paginate(10),
            'txtsearch' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Category.form', [
            'url' => 'admin/categories/save',
            'categories' => $this->getCategories(-1)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryFormRequest $request)
    {
        $cat = new CategoryModel();
        $cat->name = $request->input('name');
        $cat->isactive = $request->input('isactive');
        $cat->type = $request->input('type');
        $cat->category_id = $request->input('category_id');
        if ($cat->category_id == -1)
            $cat->category_id = null;

        $cat->save();

        \Session::flash('message_success', 'Salvo com sucesso ');

        return Redirect::to('admin/categories/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category\CategoryModel  $categoryModel
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryModel $categoryModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = CategoryModel::findOrFail($id);
        return view('Category.form', [
            'category' => $cat,
            'categories' => $this->getCategories($id),
            'url' => 'admin/categories/'.$id.'/update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCategoryFormRequest $request)
    {
        $cat = CategoryModel::findOrFail($id);

        $cat->name = $request->input('name');
        $cat->isactive = $request->input('isactive');
        $cat->category_id = $request->input('category_id');
        $cat->type = $request->input('type');
        $cat->id = $id;
        if ($cat->category_id == -1)
            $cat->category_id = null;

        $cat->save();

        \Session::flash('message_success', 'Atualizado com sucesso');

        return Redirect::to('admin/categories/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cat = CategoryModel::findOrFail($id);

            $cat->delete();

            \Session::flash('message_warning', 'Removido com sucesso');

        }
        catch (\Exception $e){
            $errorCode = $e->errorInfo[1];

            if($errorCode == 1451){
                \Session::flash('message_danger', 'Existem cadastros vinculados a este registro');
            }
        }

        return Redirect::to('admin/categories');
    }

    public function main($type)
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
                                        'ptype' => $type]);//CategoryModel::whereNull('category_id')->get();
    }

    public function child($id, $type)
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
        //return CategoryModel::where('category_id', $id)->get();
    }
}
