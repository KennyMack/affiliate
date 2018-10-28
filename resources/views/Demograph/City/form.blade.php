@extends('layouts.app')
@section('header')
    <h4 class="col-md-12 text-align-center">{{ __('demograph.city_id') }}</h4>
    <br>
    <br>
@endsection
@section('control')
    <a class="pull-right" href="{{ url('admin/cities') }}">{{ __('generic.back')  }}</a>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form role="form"
                      method="POST"
                      novalidate
                      action="{{ url($url) }}">
                @if(Request::is('*/edit'))
                    <input name="_method" type="hidden" value="PUT" />
                @endif
                @csrf
                    <div class="container-center">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('demograph.city_name') }}</label>

                            <div class="col-md-5">
                                <input id="name"
                                       type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name"
                                       value="{{ isset($city->name) ? $city->name : old('name') }}"
                                       required
                                       autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ibge" class="col-md-4 col-form-label text-md-right">{{ __('demograph.ibge') }}</label>

                            <div class="col-md-5">
                                <input id="ibge"
                                       type="text"
                                       class="form-control{{ $errors->has('ibge') ? ' is-invalid' : '' }}"
                                       name="ibge"
                                       value="{{ isset($city->ibge) ? $city->ibge : old('ibge') }}"
                                       required
                                       autofocus>

                                @if ($errors->has('ibge'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ibge') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country_id"
                                   class="col-md-4 col-form-label text-md-right">{{ __('demograph.state_id') }}</label>

                            <div class="col-md-5">
                                <select-component
                                    selectfirst="false"
                                    items="{{ $states }}"
                                    value="{{ isset($city->state_id) ? $city->state_id : old('state_id') }}"
                                    name="state_id"
                                    cannull="2"
                                    keyval="id"
                                    descval="name"
                                    haserror="{{$errors->has('state_id')}}"
                                >
                                </select-component>
                                @if ($errors->has('state_id'))
                                    <span class="help-block">
                                        <strong>Selecione um Estado.</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <br>
                        <br>
                        <div class="col-md-1 container-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-save"></i> {{ __('generic.save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

