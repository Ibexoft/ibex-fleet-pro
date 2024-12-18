@extends('layouts.app')

@section('admincontent')
    <section class="content-header mb-0 pb-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Owner Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item active">Date: <span>{{$customer->created_at}}</span></li> --}}
                    </ol>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6 col-md-6">
                            <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm">
                                <i class="fas fa-arrow-left mr-1"></i>
                            </button>
                        </div>
                        <div class="col-6 col-md-6 text-right">
                            @if (Auth::user()->hasPermissionTo('edit-owner'))
                                <a href="{{ route('owner.edit', $customer->customer_id) }}"
                                    class="btn btn-outline-primary btn-sm sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content-header">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body custom-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Entity Type:</div>
                                        <div class="data-value">{{ $customer->entity_type }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">
                                            @if ($customer->entity_type == 'Company')
                                                Company Name:
                                            @elseif($customer->entity_type == 'Individual')
                                                First Name:
                                            @else
                                                Trust Name:
                                            @endif
                                        </div>
                                        <div class="data-value">{{ $customer->c_first_name }}</div>
                                    </div>
                                </div>
                                @if ($customer->c_last_name)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Last Name:</div>
                                            <div class="data-value">{{ $customer->c_last_name }}</div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Email:</div>
                                        <div class="data-value">{{ $customer->email }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Telephone:</div>
                                        <div class="data-value">{{ $customer->contact }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Street:</div>
                                        <div class="data-value">{{ $customer->street_address }}</div>
                                    </div>
                                </div>
                                @if ($customer->suburb)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Suburb:</div>
                                            <div class="data-value
                                            ">
                                                {{ $customer->suburb }}</div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">State:</div>
                                        <div class="data-value">{{ $customer->state }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Postal Code:</div>
                                        <div class="data-value">{{ $customer->postal_code }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Country:</div>
                                        <div class="data-value">{{ $country->country_name }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Bond Eligibility:</div>
                                        <div class="data-value">{{ $customer->eligibility }}</div>
                                    </div>
                                </div>
                                @if ($customer->crn)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">CRN:</div>
                                            <div class="data-value">{{ $customer->crn }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if ($customer->acn)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">ACN:</div>
                                            <div class="data-value">{{ $customer->acn }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if ($customer->abn)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">ABN:</div>
                                            <div class="data-value">{{ $customer->abn }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if ($customer->trustee)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Trustee Type:</div>
                                            <div class="data-value">{{ $customer->trustee }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if ($customer->company)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Company:</div>
                                            <div class="data-value">{{ $customer->getCompany->c_first_name }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if ($customer->contact_person)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">
                                                @if ($customer->entity_type == 'Company')
                                                    Contact Person:
                                                @else
                                                    @if ($customer->company)
                                                        Contact Person:
                                                    @else
                                                        Individual Name:
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="data-value">{{ $customer->contactPerson->c_first_name }}
                                                {{ $customer->contactPerson->c_last_name }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

<style>
    .table .thead-dark th {
        background-color: #111111 !important;
        color: #fff;
    }
</style>
