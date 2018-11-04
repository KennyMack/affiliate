@extends('layouts.app')
@section('header')
    <h4 class="col-md-12 text-align-center">{{ __('category.category_id') }}</h4>
    <br>
    <br>
@endsection
@section('control')
    <a class="pull-right" href="{{ url('admin/categories') }}">{{ __('generic.back')  }}</a>
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

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('category.category_name') }}</label>

                            <div class="col-md-5">
                                <input id="name"
                                       type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name"
                                       value="{{ isset($category->name) ? $category->name : old('name') }}"
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
                            <label for="type"
                                   class="col-md-4 col-form-label text-md-right">{{ __('category.category_type') }}</label>

                            <div class="col-md-5">
                                <select-component
                                    selectfirst="false"
                                    items='[{ "id":0, "name": "Convida" },{ "id":1, "name": "Clube de Vantagens" },{ "id":2, "name": "Convida/Clube de Vantagens" }]'
                                    value="{{ isset($category->type) ? $category->type : old('type') }}"
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
                            <label for="category_id"
                                   class="col-md-4 col-form-label text-md-right">{{ __('category.category_id_upper') }}</label>

                            <div class="col-md-5">
                                <select-component
                                    selectfirst="false"
                                    items='{{ $categories }}'
                                    value="{{ isset($category->category_id) ? $category->category_id : old('category_id') }}"
                                    name="category_id"
                                    cannull="0"
                                    keyval="id"
                                    descval="name"
                                    haserror="{{$errors->has('category_id')}}"
                                >
                                </select-component>
                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
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
                                    label="{{ __('category.category_isactive') }}"
                                    checkvalue="{{ isset($category->isactive) ? $category->isactive : old('isactive') }}"
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

                        <pre>
                            {{ $errors }}
                        </pre>
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

