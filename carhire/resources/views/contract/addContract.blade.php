@extends('layouts.app')

@section('admincontent')

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Add Contract</h1>

          </div>

        </div>

      </div>

    </section>



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        <div class="row">

          <!-- left column -->

          <div class="col-md-12">

            <!-- jquery validation -->

            <div class="card card-primary">

             

              <!-- /.card-header -->

              <!-- form start -->

              <form method="POST"  enctype="multipart/form-data" action="{{ url('save-contract') }}" aria-label="{{ __('save-contract') }}">

                @csrf

                <div class="card-body">

                   <div class="row">

                      <div class="col-md-6">

                   <div class="form-group">

                    <label>Vehicle</label>

                    <select onchange="fetchVin()" required name="vehicle_id" id="vehicle_id" class="form-control">

                      <option>Select Vehicle</option>

                      @foreach($vehicle as $vehicleData)

                      <option value="{{$vehicleData->vehicle_id}}">{{$vehicleData->fuel_type}}-{{$vehicleData->vehicle_registration_no}}</option>

                      @endforeach

                    </select>

                  </div>

                 </div>

                  <div class="col-md-6">

                  <div class="form-group">

                    <label>Driver</label>

                    <select required name="driver_id" class="form-control">

                      <option>Select Driver</option>

                      @foreach($driver as $driverData)

                      <option value="{{$driverData->driver_id}}">{{$driverData->first_name}}-{{$driverData->last_name}}</option>

                      @endforeach

                    </select>

                  </div>

                 </div>

                 </div>

                 <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                          <label for="start_date">Start Date</label>

                          <input required type="date" autocomplete="start_date"  name="start_date" class="form-control" value="{{ old('start_date')}}" id="start_date" placeholder="Enter Start Date">

                        </div>

                       </div>

                      {{-- <div class="col-md-6">

                   <div class="form-group">

                    <label>Tracker</label>

                    <select name="tracker_id" class="form-control">

                      <option>Select Tracker</option>

                      @foreach($tracker as $trackerData)

                      <option value="{{$trackerData->tracking_id}}">{{$trackerData->tracker_name}}</option>

                      @endforeach

                    </select>

                  </div>

                 </div> --}}

                  <div class="col-md-6">

                  <div class="form-group">

                    <label>Insurance</label>

                    <select  name="insurance_id" class="form-control" id="fetch_insurance" required>

                      <option value="">Select Insurance</option>

                      @foreach($insurance as $insuranceData)

                      <option value="{{ $insuranceData->insurance_id }}">{{$insuranceData->icompany_name}}</option>

                      @endforeach

                    </select>

                  </div>

                 </div>

                 </div>

                  <div class="row">

                    <div class="col-md-6">

                  <div class="form-group">

                    <label for="exampleInputEmail1">Bond</label>

                    <input required type="text" autocomplete="Bond" name="Bond" class="form-control" value="{{ old('Bond')}}" id="Bond" placeholder="Enter Bond">

                  </div>

                 </div>

                  <div class="col-md-6">

                  <div class="form-group">

                    <label>Held By</label>

                    <select required name="held_by" class="form-control">

                      <option value="">Select Held By</option>

                      <option value="QAG">QAG</option>

                      <option value="SKI">SKI</option>

                    </select>

                  </div>

                 </div>

                 </div>

                  <div class="row">

                    <div class="col-md-6">

                  <div class="form-group">

                    <label>Advance</label>

                    <select required name="advance" class="form-control">

                      <option>Select Advances</option>

                      <option value="1">1 Week</option>

                      <option value="2">2 Week</option>

                      <option value="3">3 Week</option>

                      <option value="4">4 Week</option>

                      <option value="5">1 Month</option>

                    </select>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label for="exampleInputPhone1">Per week</label>

                    <input required type="text" autocomplete="per_week" name="per_week" required class="form-control" value="{{ old('per_week')}}" id="per_week" placeholder="Enter Per week">

                  </div>

                </div>

               </div>

                <div class="row">

                  {{-- <div class="col-md-6">

                 <div class="form-group">

                  <label for="exampleInputPhone1">Rate Changes</label>

                   <input required type="text" autocomplete="rate_changes" name="rate_changes" required class="form-control" value="{{ old('rate_changes')}}" id="rate_changes" placeholder="Enter changes">

                 </div>

                 </div> --}}

                 <div class="col-md-6">

                  <div class="form-group">

                <label for="exampleInputPhone1">Vin</label>

                <input required type="text" autocomplete="vin" name="vin"  class="form-control" value="{{ old('vin')}}" id="vin" placeholder="Enter Vin">

              </div>

                </div>

                  {{-- <div class="col-md-6">

                  <div class="form-group">

                    <label for="exampleInputPhone1">REGO Due</label>

                    <input required type="text" autocomplete="rego_due" name="rego_due" class="form-control" value="{{ old('rego_due')}}" id="rego_due" placeholder="Enter Rego Due">

                  </div>

                 </div> --}}

                 </div>

                 {{-- <div class="row">

                   <div class="col-md-6">

                  <div class="form-group">

                    <label for="exampleInputPhone1">COI Due</label>

                    <input  type="text" autocomplete="coi_due" name="coi_due" class="form-control" value="{{ old('coi_due')}}" id="coi_due" placeholder="Enter Coi Due">

                  </div>

                 </div>



                    <div class="col-md-6">

                      <div class="form-group">

                    <label for="exampleInputPhone1">BHSL Due</label>

                    <input required type="text" autocomplete="bhsl_due" name="bhsl_due" class="form-control" value="{{ old('bhsl_due')}}" id="bhsl_due" placeholder="Enter BHSL Due">

                  </div>

                    </div>

                    <div class="col-md-6">

                      <div class="form-group">

                    <label for="exampleInputPhone1">Biller Code</label>

                    <input type="text" autocomplete="biller_code" name="biller_code" class="form-control" value="{{ old('biller_code')}}" id="biller_code" placeholder="Enter Biler Code">

                  </div>

                    </div>

                  </div> --}}

                 

                    

                    

                    

                  </div>

                  <div class="row">

                   {{-- <div class="col-md-6">

                  <div class="form-group">

                    <label for="exampleInputPhone1">Reference Number</label>

                    <input type="text" autocomplete="reference_no" name="reference_no" class="form-control" value="{{ old('reference_no')}}" id="reference_no" placeholder="Enter Reference number">

                  </div>

                 </div> --}}





                </div>

                <!-- /.card-body -->

                <div class="card-footer">

                  <button type="submit" class="btn btn-primary">Add Contract</button>

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

  <script type="text/javascript">



     function fetchVin(){

          var id = $("#vehicle_id option:selected").val();

           $.ajax({

                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                    type: 'POST',

                    url: '/fetch-vin-data',

                    data: { id: id},

                    success: function (data) {

                          obj1 = JSON.parse(data);





                        if(obj1.success == 1)

                          {

                              console.log(obj1.vin);

                              $("#vin").val(obj1.vin);

                            //   var insurance = obj1.facility;

                            //   if(facility == ""){

                            //      $('#facility_id').html();

                            //     assetsHtml+='<option value="">No Facility Found</option>';

                            //     $("#facility_id").html(assetsHtml);



                            //   }else{

                            //   var assetsHtml = '';

                            //   $('#facility_id').html();

                            //     assetsHtml+='<option value="">Select Facility</option>';



                            //       for (var i = 0; i < facility.length; i++) {

                            //           assetsHtml+='<option value="'+facility[i].id+'">'+facility[i].CompanyName+'</option>';

                            //       }

                            //   $("#facility_id").html(assetsHtml);

                            // }

                          }

                    }

                });



           $.ajax({

                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                    type: 'POST',

                    url: '/fetch-insurance-data',

                    data: { id: id},

                    success: function (data) {

                          obj1 = JSON.parse(data);



                        if(obj1.success == 1)

                          {

                              console.log(obj1);

                              // $("#vin").val(obj1.vin);

                              var insurance = obj1.insurance;

                              if(insurance == ""){

                                 $('#fetch_insurance').html();

                                assetsHtml+='<option value="">No insurance Found</option>';

                                $("#fetch_insurance").html(assetsHtml);



                              }else{

                              var assetsHtml = '';

                              $('#fetch_insurance').html();

                              assetsHtml+='<option value="">Select insurance</option>';

                                  for (var i = 0; i < insurance.length; i++) {

                                      assetsHtml+='<option value="'+insurance[i].insurance_id+'">'+insurance[i].bsb+'</option>';

                                  }

                              $("#fetch_insurance").html(assetsHtml);

                            }

                          }

                    }

                });

        }



  </script>

  @endsection

