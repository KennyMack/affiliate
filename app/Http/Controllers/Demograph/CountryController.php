<?php

namespace App\Http\Controllers\Demograph;

use App\Http\Requests\Demograph\CreateCountryFormRequest;
use App\Http\Requests\Demograph\UpdateCountryFormRequest;
use App\Models\Demograph\CountryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $countries = CountryModel::orderBy('name', 'desc')->paginate(10);
        return view('Demograph.Country.index',['countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Demograph.Country.form', [
            'url' => 'admin/countries/save'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCountryFormRequest $request)
    {
        $country = new CountryModel();

        $country = $country->create([
            'name' => $request->input('name'),
            'ibge' => $request->input('ibge'),
            'initials' => $request->input('initials')
        ]);


        \Session::flash('message_success', 'Salvo com sucesso ');

        return Redirect::to('admin/countries/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demograph\CountryModel  $countryModel
     * @return \Illuminate\Http\Response
     */
    public function show(CountryModel $countryModel)
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
        $country = CountryModel::findOrFail($id);
        return view('Demograph.Country.form', [
            'country' => $country,
            'url' => 'admin/countries/'.$id.'/update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCountryFormRequest $request)
    {
        $country = CountryModel::findOrFail($id);

        $country->name = $request->input('name');
        $country->initials = $request->input('initials');
        $country->ibge = $request->input('ibge');
        $country->id = $id;

        $country->save();

        \Session::flash('message_success', 'Atualizado com sucesso');

        return Redirect::to('admin/countries/');
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
            $cat = CountryModel::findOrFail($id);

            $cat->delete();

            \Session::flash('message_warning', 'Removido com sucesso');

        }
        catch (\Exception $e){
            $errorCode = $e->errorInfo[1];

            if($errorCode == 1451){
                \Session::flash('message_danger', 'Existem estados vinculados a este país');
            }
        }

        return Redirect::to('admin/countries');
    }
}
