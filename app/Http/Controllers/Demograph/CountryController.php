<?php

namespace App\Http\Controllers\Demograph;

use App\Models\Demograph\CountryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $countries = CountryModel::orderBy('created_at', 'desc')->paginate(10);
        return view('Demograph.Country.index',['countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  \App\Models\Demograph\CountryModel  $countryModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CountryModel $countryModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demograph\CountryModel  $countryModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CountryModel $countryModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demograph\CountryModel  $countryModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountryModel $countryModel)
    {
        //
    }
}
