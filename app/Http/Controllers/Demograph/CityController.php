<?php

namespace App\Http\Controllers\Demograph;

use App\Http\Requests\Demograph\CreateCityFormRequest;
use App\Http\Requests\Demograph\UpdateCityFormRequest;
use App\Models\Demograph\CityModel;
use App\Models\Demograph\StateModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CityController extends Controller
{
    private function getStates()
    {
        return StateModel::all()->sortBy('name', 0);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cities = CityModel::orderBy('name', 'asc')->paginate(10);
        return view('Demograph.City.index',[
            'cities' => $cities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Demograph.City.form', [
            'url' => 'admin/cities/save',
            'states' => $this->getStates()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCityFormRequest $request)
    {
        $city = new CityModel();

        $city = $city->create([
            'name' => $request->input('name'),
            'ibge' => $request->input('ibge'),
            'state_id' => $request->input('state_id')
        ]);


        \Session::flash('message_success', 'Salvo com sucesso ');

        return Redirect::to('admin/cities/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demograph\CountryModel  $countryModel
     * @return \Illuminate\Http\Response
     */
    public function show(StateModel $countryModel)
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
        $city = CityModel::findOrFail($id);
        return view('Demograph.City.form', [
            'city' => $city,
            'states' => $this->getStates(),
            'url' => 'admin/cities/'.$id.'/update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCityFormRequest $request)
    {
        $city = CityModel::findOrFail($id);

        $city->name = $request->input('name');
        $city->ibge = $request->input('ibge');
        $city->state_id = $request->input('state_id');
        $city->id = $id;

        $city->save();

        \Session::flash('message_success', 'Atualizado com sucesso');

        return Redirect::to('admin/cities/');
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
            $cat = CityModel::findOrFail($id);

            $cat->delete();

            \Session::flash('message_warning', 'Removido com sucesso');

        }
        catch (\Exception $e){
            $errorCode = $e->errorInfo[1];

            if($errorCode == 1451){
                \Session::flash('message_danger', 'Existem endereços vinculados a esta cidade');
            }
        }

        return Redirect::to('admin/cities');
    }
}
