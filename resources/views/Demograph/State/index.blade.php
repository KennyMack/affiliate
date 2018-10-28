@extends('layouts.app')

@section('control')
    <a class="pull-right" href="{{ url('admin/states/create') }}">{{ __('generic.new')  }}</a>
@endsection

@section('header')
    <h4>{{ __('demograph.state_id') }}</h4>
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
                    <td><a class="btn btn-basic btn-icon" href="states/{{ $state->id }}/edit">
                            <i style="color:#333" class="fas fa-pencil-alt"></i>
                        </a>
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
                <td colspan="4">
                    {{ $states->links() }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>


@endsection
