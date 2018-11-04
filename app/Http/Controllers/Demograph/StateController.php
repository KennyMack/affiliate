<?php

namespace App\Http\Controllers\Demograph;

use App\Http\Requests\Demograph\CreateStateFormRequest;
use App\Http\Requests\Demograph\UpdateStateFormRequest;
use App\Models\Demograph\CountryModel;
use App\Models\Demograph\StateModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class StateController extends Controller
{
    private function getCountries()
    {
        return CountryModel::all()->sortBy('name', 0);
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

            $results = StateModel::search($search)->orderBy('name', 'asc')->paginate(5000);
        }
        else
            $results = StateModel::orderBy('name', 'asc')->paginate(10);

        // $states = StateModel::orderBy('name', 'desc')->paginate(10);
        return view('Demograph.State.index',[
            'states' => $results,
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
        return view('Demograph.State.form', [
            'url' => 'admin/states/save',
            'countries' => $this->getCountries()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStateFormRequest $request)
    {
        $state = new StateModel();

        $state = $state->create([
            'name' => $request->input('name'),
            'ibge' => $request->input('ibge'),
            'country_id' => $request->input('country_id'),
            'initials' => $request->input('initials')
        ]);


        \Session::flash('message_success', 'Salvo com sucesso ');

        return Redirect::to('admin/states/create');
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
        $state = StateModel::findOrFail($id);
        return view('Demograph.State.form', [
            'state' => $state,
            'countries' => $this->getCountries(),
            'url' => 'admin/states/'.$id.'/update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateStateFormRequest $request)
    {
        $state = StateModel::findOrFail($id);

        $state->name = $request->input('name');
        $state->initials = $request->input('initials');
        $state->ibge = $request->input('ibge');
        $state->country_id = $request->input('country_id');
        $state->id = $id;

        $state->save();

        \Session::flash('message_success', 'Atualizado com sucesso');

        return Redirect::to('admin/states/');
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
            $cat = StateModel::findOrFail($id);

            $cat->delete();

            \Session::flash('message_warning', 'Removido com sucesso');

        }
        catch (\Exception $e){
            $errorCode = $e->errorInfo[1];

            if($errorCode == 1451){
                \Session::flash('message_danger', 'Existem cidades vinculadas a este estado');
            }
        }

        return Redirect::to('admin/states');
    }
}
