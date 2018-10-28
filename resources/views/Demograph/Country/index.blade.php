@extends('layouts.app')

@section('control')
    <a class="pull-right" href="{{ url('admin/countries/create') }}">{{ __('generic.new')  }}</a>
@endsection

@section('header')
    <h4>{{ __('demograph.country_id') }}</h4>
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
                    <td><a class="btn btn-basic btn-icon" href="countries/{{ $country->id }}/edit">
                            <i style="color:#333" class="fas fa-pencil-alt"></i>
                        </a>
                    </td>
                    <td>
                        <!--<form style="display: inline;"
                              method="POST"
                              action="{{ url('admin/countries/'.$country->id.'/remove') }}">
                            <input name="_method" type="hidden" value="DELETE">

                            <button class="btn btn-danger btn-xs"
                                    type="submit"
                                    name="remove_levels"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>-->
                        @csrf
                        <button-delete-component
                            url="{{ url('admin/countries/'.$country->id.'/destroy') }}"
                        ></button-delete-component>
                        <!--<button class="btn btn-danger btn-icon"
                                type="submit"
                                name="remove_levels"><i class="fas fa-trash-alt"></i></button>-->
                        <!--<form style="display: inline;"
                              method="POST"
                              action="{{ url('admin/countries/'.$country->id.'/remove') }}">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-xs"
                                    type="submit"
                                    name="remove_levels"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>-->

                    </td>
                    <td>{{ $country->initials }}</td>
                    <td>{{ ucwords($country->name) }}</td>
                </tr>

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    {{ $countries->links() }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>


@endsection
