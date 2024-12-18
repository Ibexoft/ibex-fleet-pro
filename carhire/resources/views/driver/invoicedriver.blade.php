@extends('layouts.app')

@section('admincontent')

 <br><br>



                                

                                {{--  --}}

                                <div class="container">

                                    <div class="card">

                                        <div class="modal-header">

                                            <p><span class="order-main-head" style="font-size: 20px;font-weight: bold">Driver Details</span><span> &nbsp;&nbsp;&nbsp; <span class="bold">Order Id:</span>{{$driver->driver_id   }}  </span><span > &nbsp;&nbsp;&nbsp; <span class="bold">Date:</span>{{$driver->created_at}}  </span> <span > &nbsp;&nbsp;&nbsp;</span></p>

                                            <div class="col-md-1">

                                              <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm">
                                                <i class="fas fa-arrow-left mr-1"></i>
                                              </button>

                                            </div>

        

                                        </div>

                                  

                                  <div class="card-body">

                                 

                                  <div class="table-responsive">

                                  <table class="table table-striped">

                                    <tbody>

                                  <tr>

                                  <th>First Name :</th>

                                  <td>{{$driver->first_name }}</td>

                                  <th>Last Name :</th>

                                  <td>{{$driver->last_name }}</td>

                                  <th>Driver Licence Number :</th>

                                  <td>{{$driver->driver_license_no}}</td>

                                  

                                  </tr>

                                  <tr>

                                    <th>DL Expiry Date:</th>

                                    <td >{{$driver->license_expiry_date}}</td>

                                  <th>EziDebit Driver Id :</th>

                                  <td >{{$driver->ezi_debt}}</td>

                                  <th>Date of Birth :</th>

                                  <td >{{$driver->dob}}</td>

                                 

                                  </tr>

                                  <tr>

                                    <th>Email :</th>

                                    <td>{{$driver->email }}</td>

                                  <th>Telephone :</th>

                                  <td>{{$driver->contact}}</td>

                                  <th>Street Address :</th>

                                  <td>{{$driver->street}}</td>

                                 

                                  </tr>

                                  <tr>

                                    <th>Suburb :</th>

                                    <td >{{$driver->suburb}}</td>

                                  <th>Postal Code :</th>

                                  <td >{{$driver->postal_code}}</td>

                                  <th>City :</th>

                                  <td >{{$driver->city}}</td>

                                  

                                  </tr>

                                  <tr>

                                    <th>State :</th>

                                    <td >{{$driver->state}}</td>

                                  <th>Country :</th>

                                  <td>{{$countries->country_name}}</td>

                                  </tr>

                                  

                                  </tbody>

                                  </table>

                                  </div>

                                  

                                  

                                  </div>

                                  </div>

                                  </div>



                                  

                              







@endsection

<style>

    .table .thead-dark th {

        background-color: #111111 !important;

        color: #fff;

    }

</style>

