@extends('layouts.app')

@section('control')
    <a class="pull-right" href="{{ url('admin/countries/create') }}">{{ __('generic.new')  }}</a>
@endsection

@section('header')
    <title-page-view-component
        title="{{ __('demograph.country_id') }}"
    ></title-page-view-component>
    <search-page-view-component
        url="{{ url('admin/countries/') }}"
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
                <th>{{ __('demograph.initials') }}</th>
                <th>{{ __('demograph.country_name') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($countries as $country)
                <tr>
                    <td>
                        <button-edit-component
                            url="{{ url('admin/countries/'.$country->id.'/edit') }}"
                        ></button-edit-component>
                    </td>
                    <td>
                        @csrf
                        <button-delete-component
                            url="{{ url('admin/countries/'.$country->id.'/destroy') }}"
                        ></button-delete-component>
                    </td>
                    <td>{{ $country->initials }}</td>
                    <td>{{ ucwords($country->name) }}</td>
                </tr>

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">
                    {{ $countries->links() }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>


@endsection
