@extends('layouts.app')

@section('control')
    <a class="pull-right" href="{{ url('admin/cities/create') }}">{{ __('generic.new')  }}</a>
@endsection

@section('header')
    <title-page-view-component
        title="{{ __('demograph.city_id') }}"
    ></title-page-view-component>
    <search-page-view-component
        url="{{ url('admin/cities/') }}"
        valsearch="{{ isset($txtsearch) ? $txtsearch : '' }}"
    ></search-page-view-component>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th colspan="2"
                    width="5%">&nbsp;</th>
                <th>{{ __('demograph.country_name') }}</th>
                <th>{{ __('demograph.ibge') }}</th>
                <th>{{ __('demograph.state_id') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cities as $city)
                <tr>
                    <td>
                        <button-edit-component
                            url="{{ url('admin/cities/'.$city->id.'/edit') }}"
                        ></button-edit-component>
                    </td>
                    <td>
                        @csrf
                        <button-delete-component
                            url="{{ url('admin/cities/'.$city->id.'/destroy') }}"
                        ></button-delete-component>
                    </td>
                    <td>{{ ucwords($city->name) }}</td>
                    <td>{{ $city->ibge }}</td>
                    <td>{{ ucwords($city->state->DescriptionInitials()) }}</td>
                </tr>

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5">
                    {{ $cities->links() }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>


@endsection
