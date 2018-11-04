@extends('layouts.app')

@section('control')
    <a class="pull-right" href="{{ url('admin/companies/create') }}">{{ __('generic.new')  }}</a>
@endsection

@section('header')
    <title-page-view-component
        title="{{ __('company.company_id') }}"
    ></title-page-view-component>
    <search-page-view-component
        url="{{ url('admin/companies/') }}"
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
                <th>{{ __('company.company_name') }}</th>
                <th>{{ __('company.company_cnpjcpf') }}</th>
                <th>{{ __('company.company_status') }}</th>
                <th>{{ __('demograph.city_id') }}</th>
                <th>{{ __('company.company_street') }}</th>
                <th>{{ __('company.company_district') }}</th>
                <th>{{ __('company.company_number') }}</th>
                <th>{{ __('company.company_postalnumber') }}</th>
                <th>{{ __('company.company_phone') }}</th>
                <th>{{ __('company.company_category_id') }}</th>
                <th>{{ __('company.company_expertise_id') }}</th>
                <th>{{ __('company.company_details') }}</th>
                <th>{{ __('company.company_period') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td>
                        <button-edit-component
                            url="{{ url('admin/companies/'.$company->id.'/edit') }}"
                        ></button-edit-component>
                    </td>
                    <td>
                        @csrf
                        <button-delete-component
                            url="{{ url('admin/companies/'.$company->id.'/destroy') }}"
                        ></button-delete-component>
                    </td>
                    <td>{{ ucwords($company->companyname) }}</td>
                    <td>{{ ucwords($company->cnpjcpf) }}</td>
                    <td><input type="checkbox"
                               name="status"
                               disabled="disabled"
                               {{ $company->status == 1 ? 'checked' :'' }}
                               value="{{ $company->status }}">
                    </td>
                    <td>{{ isset($company->city) ? $company->city->name : '' }}</td>
                    <td>{{ ucwords($company->street) }}</td>
                    <td>{{ ucwords($company->district) }}</td>
                    <td>{{ $company->number }}</td>
                    <td>{{ $company->postalnumber }}</td>
                    <td>{{ $company->phone }}</td>
                    <td>{{ isset($company->category) ? $company->category->name : '' }}</td>
                    <td>{{ isset($company->expertise) ? $company->expertise->name : ''}}</td>
                    <td>{{ $company->details }}</td>
                    <td>{{ $company->getTime() }}</td>
                </tr>

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="15">
                    {{ $companies->appends($_GET)->links() }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>


@endsection
