@extends('layouts.app')
@section('header')
    <h4 class="col-md-12 text-align-center">{{ __('company.company_id') }}</h4>
    <br>
    <br>
@endsection
@section('control')
    <a class="pull-right" href="{{ url('admin/companies') }}">{{ __('generic.back')  }}</a>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form role="form"
                      method="POST"
                      novalidate
                      action="{{ url($url) }}">
                @if(Request::is('*/edit'))
                    <input name="_method" type="hidden" value="PUT" />
                @endif
                @csrf
                    <company-form-component
                        labels='{
                            "companyname": "{{ __('company.company_name')  }}",
                            "cnpjcpf": "{{ __('company.company_cnpjcpf')  }}",
                            "status": "{{ __('company.company_status')  }}",
                            "state_id": "{{ __('demograph.state_id')  }}",
                            "city_id": "{{ __('demograph.city_id')  }}",
                            "street": "{{ __('company.company_street')  }}",
                            "district": "{{ __('company.company_district')  }}",
                            "number": "{{ __('company.company_number')  }}",
                            "postalnumber": "{{ __('company.company_postalnumber')  }}",
                            "phone": "{{ __('company.company_phone')  }}",
                            "category_id": "{{ __('company.company_category_id')  }}",
                            "expertise_id": "{{ __('company.company_expertise_id')  }}",
                            "details": "{{ __('company.company_details')  }}",
                            "starttime": "{{ __('company.company_starttime')  }}",
                            "endtime": "{{ __('company.company_endtime')  }}",
                            "company_period": "{{ __('company.company_period')  }}",
                            "category_type": "{{ __('category.category_type') }}"
                        }'
                        imagesearch="{{ asset('/assets/img/change-image.png') }}"
                        imagetemp="{{ old('imgdata') }}"
                        image="{{ $company->getImageValue() }}"
                        company="{{ $company }}"
                        idstate="{{ isset($company->city) ? $company->city->state_id : -1 }}"
                        categorytype="{{ isset($company->category) ? $company->category->type : -1 }}"
                        states="{{ $states }}"
                        errors="{{ $errors }}"
                        old="{{ json_encode(Session::getOldInput()) }}">
                    </company-form-component>

                    <br>
                    <br>
                    <div class="col-md-1 container-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-save"></i> {{ __('generic.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
