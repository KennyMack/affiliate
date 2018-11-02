@extends('layouts.app')

@section('control')
    <a class="pull-right" href="{{ url('admin/categories/create') }}">{{ __('generic.new')  }}</a>
@endsection

@section('header')
    <title-page-view-component
        title="{{ __('category.category_id') }}"
    ></title-page-view-component>
    <search-page-view-component
        url="{{ url('admin/categories/') }}"
        valsearch="{{ isset($txtsearch) ? $txtsearch : '' }}"
    ></search-page-view-component>
        <!--<div class="col col-md-3  col-sm-12 col-12" >
            <h4 class="align-bottom" style="line-height: 50px">{{ __('category.category_id') }}</h4>
        </div>
        <div class="col col-md-9 col-sm-12 col-12" >

            <form class="form-inline justify-content-end" style="width: 71%; margin-left: 30%">
                    <div class="form-group col-10" style="margin-right: 0; padding-right: 0;">
                        <input type="text"
                               style="width: 100%"
                               placeholder="Buscar..." aria-label="Search"
                               class="form-control "
                               name="txtsearch"
                               id="txtsearch">
                    </div>
                    <div class="col-2" >
                        <button  type="submit" class="btn btn-primary mb-2" style="margin-top: 7px"><i class="fas fa-search"></i></button>
                    </div>
            </form>
        </div>-->
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th colspan="2"
                    width="5%">&nbsp;</th>
                <th>{{ __('category.category_name') }}</th>
                <th>{{ __('category.category_type') }}</th>
                <th>{{ __('category.category_isactive') }}</th>
                <th>{{ __('category.category_id_upper') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td><a class="btn btn-basic btn-icon" href="categories/{{ $category->id }}/edit">
                            <i style="color:#333" class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                    <td>
                        @csrf
                        <button-delete-component
                            url="{{ url('admin/categories/'.$category->id.'/destroy') }}"
                        ></button-delete-component>
                    </td>
                    <td>{{ ucwords($category->name) }}</td>
                    <td>{{ $category->getTypeDescription() }}</td>
                    <td><input type="checkbox"
                               name="isactive"
                               disabled="disabled"
                               {{ $category->isactive == 1 ? 'checked' :'' }}
                               value="{{ $category->isactive }}">
                    </td>
                    <td>{{ isset($category->category) ? $category->category->name : ''
                     }}</td>
                </tr>

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6">
                    {{ $categories->links() }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>


@endsection
