@extends('layouts.app')

@section('admincontent')

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Add Tracker</h1>

          </div>

          </div>

      </div><!-- /.container-fluid -->

    </section>



    <!-- Main content -->

    <style>

      .required {

  color: red;

}

    </style>

    <section class="content">

      <div class="container-fluid">

        <div class="row">

          <!-- left column -->

          <div class="col-md-12">


            <!-- jquery validation -->

            <div class="card card-primary">



              <!-- /.card-header -->

              <!-- form start -->

              <form method="POST"  enctype="multipart/form-data" action="{{ route('tracking.store') }}">

                @csrf

                <div class="card-body">

                   <div class="row">

                      <div class="col-md-6">

                        <div class="form-group">

                    <label for="exampleInputEmail1">Name<span aria-hidden="true" class="required">*</span></label>

                    <input type="text" autocomplete="policy_number" required name="tracker_name" class="form-control" value="{{old('tracker_name')}}" id="tracker_name" placeholder="Enter Name">

                  </div>



                 </div>

                  <div class="col-md-6">

                  <div class="form-group">

                    <label for="exampleInputEmail1">IMEI Number<span aria-hidden="true" class="required">*</span></label>

                    <input type="text" name="tracker_imei" required autocomplete="tracker_imei" class="form-control" value="{{old('tracker_imei')}}" id="tracker_imei" placeholder="Enter IMEI">

                  </div>

                 </div>

                 </div>

                  <div class="row">

                    <div class="col-md-6">

                  <div class="form-group">

                    <label for="exampleInputEmail1">Cell Provider<span aria-hidden="true" class="required">*</span></label>

                    <input type="text" name="cell_provider" required autocomplete="cell_provider" class="form-control" value="{{old('cell_provider')}}" id="cell_provider" placeholder="Enter Cell Provider">

                  </div>

                 </div>

                  <div class="col-md-6">

                    <div class="form-group">

                    <label for="mobile_no">Telephone<span aria-hidden="true" class="required">*</span> <small>Format: XXXXXXXXXX</small></label>

                    <input type="tel" pattern="[0-9]{10}" name="mobile_no" required autocomplete="mobile_no" class="form-control" value="{{old('mobile_no')}}" id="mobile_no" placeholder="Enter Telephone">

                  </div>

                 </div>

                 </div>





                  <div class="row">

                    <div class="col-md-6">

                  <div class="form-group">

                    <label for="exampleInputPhone1">ICCID Number<span aria-hidden="true" class="required">*</span></label>

                    <input type="text" name="iccid_no" required autocomplete="iccid_no" required class="form-control" value="{{old('iccid_no')}}" id="iccid_no" placeholder="Enter ICCID Number">

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Vehicle<span aria-hidden="true" class="required">*</span></label>

                    <input type="text" required autocomplete="vehicle_reg_id"
                      value="{{ $vehicle->vehicle_registration_no }}" id="vehicle_reg_id"
                       class="form-control" readonly
                      placeholder="Vehicle Registration">

                    <input type="hidden" name="vehicle_reg_id" value="{{ $vehicle->vehicle_id }}">

                  </div>

                </div>

               </div>

                {{-- <div class="row">

                  <div class="col-md-6">

                 <div class="form-group">

                    <label>Driver</label>

                    <select required name="driver_id" class="form-control">

                      <option>Select Driver</option>

                      @foreach($driver as $driverData)

                      <option value="{{$driverData->driver_id}}">{{$driverData->first_name}}</option>

                      @endforeach

                    </select>

                  </div>

                 </div>

                 </div> --}}





                </div>

                <!-- /.card-body -->

                <div class="card-footer">

                  <button type="submit" class="btn btn-primary">Save</button>

                </div>

              </form>

            </div>

            <!-- /.card -->

            </div>

          <!--/.col (left) -->

          <!-- right column -->

          <div class="col-md-6">

            <br><br>

          </div>

          <!--/.col (right) -->

        </div>

        <!-- /.row -->

      </div><!-- /.container-fluid -->

    </section>

    <script type="text/javascript">

      function init() {

          var input = document.getElementById('company_address');

          var autocomplete = new google.maps.places.Autocomplete(input);

      }



      google.maps.event.addDomListener(window, 'load', init);

  </script>

  @endsection