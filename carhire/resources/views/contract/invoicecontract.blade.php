@extends('layouts.app')

@section('admincontent')

 <br><br>



 



                                

                                {{--  --}}

                                <div class="container">

                                    <div class="card">

                                        <div class="modal-header">

                                            <p><span class="order-main-head" style="font-size: 20px;font-weight: bold">Contract Details</span><span> &nbsp;&nbsp;&nbsp; <span class="bold">Order Id:</span>{{$contract->contract_id }}  </span><span > &nbsp;&nbsp;&nbsp; <span class="bold">Date:</span>{{$contract->created_at}}  </span> <span > &nbsp;&nbsp;&nbsp;</span></p>

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

                                  <th>Vehicle :</th>

                                  <td >{{$vehicle->fuel_type}}</td>

                                  <th>Driver :</th>

                                  <td >{{$driver->first_name}}-{{$driver->last_name}}</td>

                                  <th>Start Date :</th>

                                  <td >{{$contract->return_date}}</td>

                                </tr>

                                <tr>

                                  <th>Insurance :</th>

                                  <td >{{$incompany->icompany_name}}</td>

                                  <th>Bond :</th>

                                  <td >{{$contract->bond}}</td>

                                  <th>Held By :</th>

                                  <td >{{$contract->held_by}}</td>

                                </tr>

                                <tr>

                                  <th>Advance :</th>

                                  <td >{{$contract->advance}}</td>

                                  <th>Per Week :</th>

                                  <td >{{$contract->per_week}}</td>

                                  <th>Vin :</th>

                                  <td >{{$contract->vin}}</td>

                                  

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

