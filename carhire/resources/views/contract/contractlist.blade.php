@extends('layouts.app')

@section('admincontent')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0">Contract List</h1>

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

            <div style="display: none;" class="alert alert-success successAlert" role="alert"><span class="successMessage"></span></div>


            <div class="card">

              <div class="card-header">

                <div class="row">

               

                <div class="col-2">

                  <a type="button" href="{{url('add-contract')}}" class="btn btn-block btn-primary btn-sm">Add Contract</a>

                </div>

                </div>

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">

                  <thead>

                  <tr>

                    <th>Vehicle</th>

                    <th>Driver</th>

                    <th>Bond</th>

                    <th>Held by</th>

                    <th>Advance</th>

                    <th>Action</th>

                  </tr>

                  </thead>

                  <tbody>

                    @foreach($contract as $contractData)

                  <tr>

                    <td>{{$contractData->fuel_type}}</td>

                    <td>{{$contractData->first_name}}{{$contractData->last_name}}</td>

                    <td>{{$contractData->bond}}</td>

                    <td>{{$contractData->held_by}}</td>

                    <td>@if($contractData->advance == 1)

                        One Week

                        @elseif($contractData->advance == 2)

                        Two Week

                        @elseif($contractData->advance == 3)

                        Three Week

                        @elseif($contractData->advance == 4)

                        Four Week

                        @elseif($contractData->advance == 5)

                        One Month

                        @endif

                    </td>



                    <td>

                      <a class="btn btn-primary btn-sm" href="{{url('/edit-contract')}}/{{$contractData->contract_id}}">

                          <i class="fas fa-pencil-alt">

                          </i>

                          Edit

                      </a>

                      @if($contractData->role_name =='Super-Admin') 

                      <a class="btn btn-danger btn-sm" id="deleteadmin" onclick="deletecontractConfirmation({{$contractData->contract_id}})" href="#">

                          <i class="fas fa-trash">

                          </i>

                          Delete

                      </a>

                      @endif



                      <a class="btn btn-primary btn-sm" href="{{url('/invoice-contract')}}/{{$contractData->contract_id}}"><i class="fa fa-eye"></i></a>

                  </tr>

                  @endforeach

                  </tbody>

                  <tfoot>

                  <tr>

                    <th>Vehicle</th>

                    <th>Driver</th>

                    <th>Bond</th>

                    <th>Held by</th>

                    <th>Advance</th>

                    <th>Action</th>

                  </tr>

                  </tfoot>

                </table>

              </div>

              <!-- /.card-body -->

            </div>

            <!-- /.card -->

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->

      </div>

      <!-- /.container-fluid -->

    </section>

 <style type="text/css">

  .dt-buttons{

    display: none;

  }

</style>

@endsection

