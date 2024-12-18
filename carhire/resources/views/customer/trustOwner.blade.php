@extends('layouts.app')
@section('admincontent')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Trust Owner</h1>
          </div>
          </div>
      </div><!-- /.container-fluid -->
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
              <form method="POST"  enctype="multipart/form-data" action="{{ route('owner.store') }}" aria-label="{{ __('save-owner') }}">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                   <div class="form-group">
                    <label for="exampleInputName1">Name of Trust</label>
                    <input type="text" name="name_trust" autocomplete="name_trust" required class="form-control" value="{{ old('name_trust')}}" id="name" placeholder="Enter Trust Name">
                  </div>
                </div>
                    <div class="col-md-6">
                      <div class="form-group">
                    <label for="exampleInputName1">Name of Trustee</label>
                    <input type="text" name="name_trustee" required autocomplete="name_trustee" class="form-control" value="{{ old('name_trustee')}}" id="name" placeholder="Enter Trustee Name">
                  </div>
                    </div>
                  </div>
                  <div class="row">
                   <div class="col-md-6">
                  <div class="form-group">
                            <label>Trustee</label>
                            <select name="trustee_type" id="trustee_type" onchange="trusteeType()" class="form-control">
                              <option value="">Select Trustee Type</option>
                              <option value="0">Individual</option>
                              <option value="1">Company</option>

                            </select>
                          </div>
                   </div>
                  </div>
                <div style="display: none;" class="company_show">
                   <div class="row">
                    <div class="col-md-6">
                   <div class="form-group">
                    <label for="exampleInputName1">ACN</label>
                    <input type="text" name="acn" autocomplete="first_name" required class="form-control" value="{{ old('first_name')}}" id="name" placeholder="Enter ACN">
                  </div>
                </div>
                    <div class="col-md-6">
                      <div class="form-group">
                    <label for="exampleInputName1">ABN</label>
                    <input type="text" name="abn" required autocomplete="last_name" class="form-control" value="{{ old('last_name')}}" id="name" placeholder="Enter ABN">
                  </div>
                    </div>
                  </div>
                  <div class="row">
                   <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" name="address" autocomplete="address" class="form-control" value="{{ old('address')}}" id="address" placeholder="Enter Address">
                  </div>
                   </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPhone1">Telephone</label>
                    <input type="text" name="contact" autocomplete="contact" required class="form-control" value="{{ old('contact')}}" id="phone" placeholder="Enter Contact">
                  </div>
                  </div>
                  </div>
                   <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPhone1">TMR CRN</label>
                        <input type="text" name="tmr_crn" autocomplete="tmr_crn" required class="form-control" value="{{ old('tmr_crn')}}" id="tmr_crn" placeholder="Enter Tmr crn">
                      </div>
                   </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPhone1">Email</label>
                        <input type="email" name="email" autocomplete="city" required class="form-control" value="{{ old('trm_email')}}" id="trm_email" placeholder="Enter Email">
                      </div>
                 </div>
                 </div>
                  <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPhone1">Telephone</label>
                          <input type="text" name="contact_no_tmrnc" autocomplete="state" required class="form-control" value="{{ old('contact_no_tmrnc')}}" id="contact_no_tmrnc" placeholder="Enter Contact">
                        </div>
                        </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPhone1">Comments</label>
                        <input type="text" name="comments" autocomplete="comments" required class="form-control" value="{{ old('comments')}}" id="phone" placeholder="Enter Comments">
                      </div>
                    </div>
                  </div>
                 <div class="row">
                    <div class="col-md-6">
                      <div class="form-group w-100">
                        <label for="exampleInputPhone1">Other Documents <small>(Only Pdf/Docs and Jpeg formats are required)</small></label><br>
                        <input type="file" name="document"   class="btn btn-success"  id="other_documents">
                      </div>
                    </div>
                  </div>
                </div>
                <div style="display: none;" class="Individual">
                   <div class="row">
                    <div class="col-md-6">
                   <div class="form-group">
                    <label for="exampleInputName1">First Name of Person</label>
                    <input type="text" name="first_name" autocomplete="first_name" required class="form-control" value="{{ old('first_name')}}" id="name" placeholder="Enter First Name">
                  </div>
                </div>
                    <div class="col-md-6">
                      <div class="form-group">
                    <label for="exampleInputName1">Last Name of Person</label>
                    <input type="text" name="last_name" required autocomplete="last_name" class="form-control" value="{{ old('last_name')}}" id="name" placeholder="Enter Last Name">
                  </div>
                    </div>
                  </div>
                  <div class="row">
                   <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Date of Birth</label>
                    <input type="text" name="dob" autocomplete="dob" class="date-input form-control" value="{{ old('dob')}}" id="dob" placeholder="Enter Date of Birth">
                  </div>
                   </div>
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputPhone1">Driving Licence</label>
                    <input type="text" name="dol" autocomplete="dol" required class="form-control" value="{{ old('dol')}}" id="phone" placeholder="Enter licence number">
                  </div>
                  </div>
                  </div>
                   <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleInputPhone1">Driving Licence Expiry Date</label>
                        <input type="text" name="expiry_date" autocomplete="expiry_date" required class="date-input form-control" value="{{ old('tmr_crn')}}" id="tmr_crn" placeholder="Enter Expiry Date">
                      </div>
                   </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPhone1">Address</label>
                        <input type="text" name="individual_address" autocomplete="city" required class="form-control" value="{{ old('Individual_address')}}" id="Individual_address" placeholder="Enter Address">
                      </div>
                 </div>
                 </div>
                  <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPhone1">Telephone</label>
                          <input type="text" name="individual_contact_no" autocomplete="state" required class="form-control" value="{{ old('individual_contact_no')}}" id="individual_contact_no" placeholder="Enter Contact">
                        </div>
                        </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPhone1">Email Address</label>
                        <input type="text" name="individual_email" autocomplete="individual_email" required class="form-control" value="{{ old('individual_email')}}" id="phone" placeholder="Enter Email">
                      </div>
                    </div>
                  </div>
                 <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPhone1">Comments</label>
                        <input type="text" name="individual_email" autocomplete="individual_email" required class="form-control" value="{{ old('individual_email')}}" id="phone" placeholder="Enter Email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group w-100">
                        <label for="exampleInputPhone1">Other Documents <small>(Only Pdf/Docs and Jpeg formats are required)</small></label><br>
                        <input type="file" name="document"   class="btn btn-success"  id="other_documents">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add Owner</button>
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
    function trusteeType(){
    var conceptName = $('#trustee_type').find(":selected").val();
      if(conceptName == 1){
        $(".Individual").css({"display": "none"});
        $(".company_show").css({"display": "block"});
      }
      if(conceptName == 0){
        $(".company_show").css({"display": "none"});
        $(".Individual").css({"display": "block"});
      }
    }
  </script>
  @endsection
