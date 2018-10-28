@extends('layouts.app')
@section('header')
    <h4 class="col-md-12 text-align-center">{{ __('demograph.state_id') }}</h4>
    <br>
    <br>
@endsection
@section('control')
    <a class="pull-right" href="{{ url('admin/states') }}">{{ __('generic.back')  }}</a>
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
                            <label for="initials" class="col-md-4 col-form-label text-md-right">{{ __('demograph.initials') }}</label>

                            <div class="col-md-5">
                                <input id="initials"
                                       type="text"
                                       maxlength="3"
                                       class="form-control{{ $errors->has('initials') ? ' is-invalid' : '' }}"
                                       name="initials"
                                       value="{{ isset($state->initials) ? $state->initials : old('initials') }}"
                                       required
                                       autofocus>

                                @if ($errors->has('initials'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('initials') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('demograph.state_name') }}</label>

                            <div class="col-md-5">
                                <input id="name"
                                       type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name"
                                       value="{{ isset($state->name) ? $state->name : old('name') }}"
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
                                       value="{{ isset($state->ibge) ? $state->ibge : old('ibge') }}"
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
                                   class="col-md-4 col-form-label text-md-right">{{ __('demograph.country_id') }}</label>

                            <div class="col-md-5">
                                <select-component
                                    selectfirst="false"
                                    items="{{$countries}}"
                                    value="{{ isset($state->country_id) ? $state->country_id : old('country_id') }}"
                                    name="country_id"
                                    cannull="2"
                                    keyval="id"
                                    descval="name"
                                    haserror="{{$errors->has('country_id')}}"
                                >
                                </select-component>
                                @if ($errors->has('country_id'))
                                    <span class="help-block">
                                        <strong>Selecione um País.</strong>
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

