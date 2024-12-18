@extends('layouts.app')
@section('admincontent')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Owner</h1>
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
                    <label for="exampleInputName1">ACN</label>
                    <input type="text" name="acn" autocomplete="first_name" required class="form-control" value="{{ old('first_name')}}" id="name" placeholder="Enter First Name">
                  </div>
                </div>
                    <div class="col-md-6">
                      <div class="form-group">
                    <label for="exampleInputName1">ABN</label>
                    <input type="text" name="abn" required autocomplete="last_name" class="form-control" value="{{ old('last_name')}}" id="name" placeholder="Enter Last Name">
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
  @endsection
