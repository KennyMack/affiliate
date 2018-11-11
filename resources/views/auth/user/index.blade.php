@extends('layouts.app')

@section('control')
    <a class="pull-right" href="{{ url('admin/users/create') }}">{{ __('generic.new')  }}</a>
@endsection

@section('header')
    <title-page-view-component
        title="{{ __('auth.user_id') }}"
    ></title-page-view-component>
    <search-page-view-component
        url="{{ url('admin/users/') }}"
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
                <th>{{ __('auth.name') }}</th>
                <th>{{ __('auth.email_address') }}</th>
                <th>{{ __('auth.type') }}</th>
                <th>{{ __('auth.isactive') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <button-edit-component
                            url="{{ url('admin/users/'.$user->id.'/edit') }}"
                        ></button-edit-component>
                    </td>
                    <td>
                        @csrf
                        <button-delete-component
                            url="{{ url('admin/users/'.$user->id.'/destroy') }}"
                        ></button-delete-component>
                    </td>
                    <td>{{ ucwords($user->name) }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getDescType() }}</td>
                    <td><input type="checkbox"
                               name="isactive"
                               disabled="disabled"
                               {{ $user->isactive == 1 ? 'checked' :'' }}
                               value="{{ $user->isactive }}">
                    </td>
                </tr>

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6">
                    {{ $users->appends($_GET)->links() }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>


@endsection
