<?php

namespace App\Http\Controllers\Company;

use App\Http\Requests\Companies\CreateCompanyFormRequest;
use App\Http\Requests\Companies\UpdateCompanyFormRequest;
use App\Models\Category\CategoryModel;
use App\Models\Company\CompanyModel;
use App\Utils\ImageContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{
    public function saveImage(Request $request, CompanyModel $company) {
        if ($request->input('imgdata') != null) {

            if ($company->logopath == '') {
                $expfolder = explode('\\', $company->logopath);
                $filefolder = implode('\\', array_slice($expfolder, 0, count($expfolder) - 1));

                File::delete($company->logopath);
                File::deleteDirectory($filefolder);
            }

            $time = time().rand (1, 999);
            $imgname = uniqid();

            $imgpath = public_path('images/company/logo/') . $time;
            $imgurl = asset('images/company/logo/' . $time);


            if (!is_dir($imgpath)) {
                // dir doesn't exist, make it
                mkdir($imgpath, 0777, true);
            }

            $imgOrigPath = ImageContent::saveImageFromBase64($imgpath . '/', $request->input('imgdata'), $imgname);

            $extension = explode('.', $imgOrigPath)[1];

            $imgOrigUrl = $imgurl . '/' . $imgname . '.' . $extension;


            $company->logourl = $imgOrigUrl;
            $company->logopath = $imgOrigPath;
        }
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

            $results = CompanyModel::search($search)->orderBy('name', 'asc');
        }
        else
            $results = CompanyModel::orderBy('name', 'asc');
        return view('Company.index',[
            'companies' => $results->paginate(10),
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
        return view('Company.form', [
            'url' => 'admin/companies/save'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCompanyFormRequest $request)
    {
        $comp = new CompanyModel();
        $comp->companyname = $request->input('companyname');
        $comp->cnpjcpf = $request->input('cnpjcpf');
        $comp->status = $request->input('status');
        $comp->city_id = $request->input('city_id');
        $comp->street = $request->input('street');
        $comp->district = $request->input('district');
        $comp->number = $request->input('number');
        $comp->postalnumber = $request->input('postalnumber');
        /*$comp->logopath = $request->input('logopath');
        $comp->logourl = $request->input('logourl');*/
        $comp->phone = $request->input('phone');
        $comp->category_id = $request->input('category_id');
        $comp->expertise_id = $request->input('expertise_id');
        $comp->details = $request->input('details');
        $comp->starttime = $request->input('starttime');
        $comp->endtime = $request->input('endtime');

        $this->saveImage($request, $comp);

        $comp->save();

        \Session::flash('message_success', 'Salvo com sucesso ');

        return Redirect::to('admin/companies/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company\CompanyModel  $companyModel
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyModel $companyModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company\CompanyModel  $companyModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comp = CategoryModel::findOrFail($id);
        return view('Company.form', [
            'company' => $comp,
            'url' => 'admin/companies/'.$id.'/update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company\CompanyModel  $companyModel
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCompanyFormRequest $request)
    {
        $comp = CompanyModel::findOrFail($id);
        $comp->companyname = $request->input('companyname');
        $comp->cnpjcpf = $request->input('cnpjcpf');
        $comp->status = $request->input('status');
        $comp->city_id = $request->input('city_id');
        $comp->street = $request->input('street');
        $comp->district = $request->input('district');
        $comp->number = $request->input('number');
        $comp->postalnumber = $request->input('postalnumber');
        /*$comp->logopath = $request->input('logopath');
        $comp->logourl = $request->input('logourl');*/
        $comp->phone = $request->input('phone');
        $comp->category_id = $request->input('category_id');
        $comp->expertise_id = $request->input('expertise_id');
        $comp->details = $request->input('details');
        $comp->starttime = $request->input('starttime');
        $comp->endtime = $request->input('endtime');

        $this->saveImage($request, $comp);

        $comp->save();

        \Session::flash('message_success', 'Salvo com sucesso ');

        return Redirect::to('admin/companies/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company\CompanyModel  $companyModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cat = CompanyModel::findOrFail($id);

            $cat->delete();

            \Session::flash('message_warning', 'Removido com sucesso');

        }
        catch (\Exception $e){
            $errorCode = $e->errorInfo[1];

            if($errorCode == 1451){
                \Session::flash('message_danger', 'Existem cadastros vinculados a este registro');
            }
        }

        return Redirect::to('admin/companies');
    }
}
