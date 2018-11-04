@extends('layouts.app')

@section('control')
    <a class="pull-right" href="{{ url('admin/states/create') }}">{{ __('generic.new')  }}</a>
@endsection

@section('header')
    <title-page-view-component
        title="{{ __('demograph.state_id') }}"
    ></title-page-view-component>
    <search-page-view-component
        url="{{ url('admin/states/') }}"
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
                <th>{{ __('demograph.ibge') }}</th>
                <th>{{ __('demograph.country_id') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($states as $state)
                <tr>
                    <td>
                        <button-edit-component
                            url="{{ url('admin/states/'.$state->id.'/edit') }}"
                        ></button-edit-component>
                    </td>
                    <td>
                        @csrf
                        <button-delete-component
                            url="{{ url('admin/states/'.$state->id.'/destroy') }}"
                        ></button-delete-component>
                    </td>
                    <td>{{ $state->initials }}</td>
                    <td>{{ ucwords($state->name) }}</td>
                    <td>{{ $state->ibge }}</td>
                    <td>{{ ucwords($state->country->name) }}</td>
                </tr>

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6">
                    {{ $states->appends($_GET)->links() }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>


@endsection
