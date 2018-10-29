@extends('layouts.app')

@section('control')
    <a class="pull-right" href="{{ url('admin/categories/create') }}">{{ __('generic.new')  }}</a>
@endsection

@section('header')
    <h4>{{ __('category.category_id') }}</h4>
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
