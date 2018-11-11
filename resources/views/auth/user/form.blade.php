@extends('layouts.app')
@section('header')
    <h4 class="col-md-12 text-align-center">{{ __('auth.user_id') }}</h4>
    <br>
    <br>
@endsection
@section('control')
    <a class="pull-right" href="{{ url('admin/users') }}">{{ __('generic.back')  }}</a>
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

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('auth.name') }}</label>

                            <div class="col-md-5">
                                <input id="name"
                                       type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name"
                                       value="{{ isset($user->name) ? $user->name : old('name') }}"
                                       required
                                       autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if(!Request::is('*/edit'))
                        <div class="form-group row">

                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth.email_address') }}</label>

                            <div class="col-md-5">
                                <input id="email"
                                       type="text"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email"
                                       value="{{ isset($user->email) ? $user->email : old('email') }}"
                                       required
                                       autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="type"
                                   class="col-md-4 col-form-label text-md-right">{{ __('auth.type') }}</label>

                            <div class="col-md-5">
                                <select-component
                                    selectfirst="false"
                                    items='[{ "id":1, "name": "Atendente" },{ "id":2, "name": "Suporte" },{ "id":3, "name": "Administrador" }]'
                                    value="{{ isset($user->type) ? $user->type : old('type') }}"
                                    name="type"
                                    cannull="2"
                                    keyval="id"
                                    descval="name"
                                    haserror="{{$errors->has('type')}}"
                                >
                                </select-component>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>Selecione um tipo.</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                &nbsp;
                            </div>


                            <div class="col-md-5">
                                <input type="hidden"
                                       name="isactive"
                                       value="0"/>
                                <check-box-component
                                    label="{{ __('auth.isactive') }}"
                                    checkvalue="{{ isset($user->isactive) ? $user->isactive : old('isactive') }}"
                                    name="isactive"
                                    haserror="{{$errors->has('isactive')}}">
                                </check-box-component>
                                @if ($errors->has('isactive'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('isactive') }}</strong>
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

