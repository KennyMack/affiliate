@extends('layouts.app')

@section('control')
    <a class="pull-right" href="{{ url('admin/cities/create') }}">{{ __('generic.new')  }}</a>
@endsection

@section('header')
    <h4>{{ __('demograph.city_id') }}</h4>
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
                    <td><a class="btn btn-basic btn-icon" href="states/{{ $city->id }}/edit">
                            <i style="color:#333" class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                    <td>
                        @csrf
                        <button-delete-component
                            url="{{ url('admin/states/'.$city->id.'/destroy') }}"
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
