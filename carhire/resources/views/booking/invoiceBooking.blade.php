@extends('layouts.app')

@section('admincontent')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Booking Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item active">Date: <span>{{$booking->created_at}}</span></li> --}}
                    </ol>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm adj-sm-icon">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                        </div>
                        <div class="col-6 col-md-8">
                            <div class="text-right">
                                @if($booking->status != 'Completed')
                                    <a class="btn btn-outline-primary btn-sm sm text-decoration-none mt-sm-0 mt-2"
                                        data-toggle="modal" data-target="#extendbookingmodal">
                                        <i class="far fa-calendar"></i> Extend end date
                                    </a>
                                @endif
                                @if (Auth::user()->hasPermissionTo('edit-booking'))
                                    @if (!$booking->actual_return_date && $booking->status == 'Booked')
                                        <form action="{{ route('booking.returndate', $booking->booking_id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="Completed">
                                            <button type="submit" class="btn btn-outline-primary btn-sm sm adj-sm-icon">
                                                <i class="fas fa-check"></i> Mark as Completed
                                            </button>
                                        </form>
                                    @elseif($booking->status == 'Pending')
                                        <form action="{{ route('booking.returndate', $booking->booking_id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="status" value="Booked">
                                            <button type="submit" class="btn btn-outline-primary btn-sm sm adj-sm-icon">
                                                <i class="fas fa-check"></i> Confirm Booking
                                            </button>
                                        </form>
                                    @endif

                                    <a class="btn btn-outline-primary btn-sm sm adj-sm-icon"
                                        href="{{ route('booking.edit', $booking->booking_id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($isEndToday && $booking->status != 'Completed')
                <div class="alert alert-danger alert-dismissible fade show px-3" role="alert" id="reminderAlert">
                    <h5 id="countdown" class="mb-2"></h5>
                    <a class="btn btn-outline-primary btn-sm sm text-decoration-none mt-sm-0 mt-2" data-toggle="modal"
                        data-target="#extendbookingmodal">
                        <i class="far fa-calendar"></i> Extend end date
                    </a>
                    <a class="btn btn-outline-primary btn-sm sm text-decoration-none mt-sm-0 mt-2" id="remind-later-btn"
                        data-dismiss="alert" aria-label="Close">
                        <i class="far fa-bell"></i> Remind me later
                    </a>
                    <input id="remainingTime" value="{{ $remainingTimeInSeconds }}" type="hidden"></input>
                    <input id="bookingId" value="{{ $booking->booking_id }}" type="hidden"></input>
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="dashboard-title">Booking</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Serial No:</div>
                                        <div class="data-value">B-{{ str_pad($booking->booking_id, 5, '0', STR_PAD_LEFT) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Vehicle Registration:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_registration_no }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Start Date:</div>
                                        <div class="data-value">{{ date('d-m-Y', strtotime($booking->start_date)) }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">End Date:</div>
                                        <div class="data-value">
                                            {{ date('d-m-Y', strtotime($booking->end_date)) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Bond Held By:</div>
                                        <div class="data-value">
                                            {{ $booking->customer ? $booking->customer->c_first_name . ' ' . $booking->customer->c_last_name : 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Bond Amount:</div>
                                        <div class="data-value">
                                            {{ $booking->bond_amount != 0 ? '$' . number_format($booking->bond_amount, 2) : 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Driver:</div>
                                        <div class="data-value">{{ $driver->first_name }} {{ $driver->last_name }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Weekly Rent:</div>
                                        <div class="data-value">${{ number_format($booking->amount, 2) }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Booking created:</div>
                                        <div class="data-value">{{ date('d-m-Y h:i A', strtotime($booking->created_at)) }}
                                        </div>
                                    </div>
                                </div>
                                @if ($booking->actual_return_date)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Booking completed:</div>
                                            <div class="data-value">
                                                {{ date('d-m-Y h:i A', strtotime($booking->actual_return_date)) }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Comments:</div>
                                        <div class="data-value">
                                            <div id="comment_content">
                                                {{ $booking->comments }}
                                            </div>
                                            <button id="toggleButton">
                                                Show More
                                                <i class="fas fa-caret-down" id="caret_icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="dashboard-title">Documents</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p class="">Contract</p>
                                    @if ($booking->contract_image)
                                        <div class="doc-wrapper mb-4">
                                            @if (pathinfo($booking->contract_image, PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ asset('') . $booking->contract_image }}" target="_blank">
                                                    <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                        alt="pdf">
                                                </a>
                                            @else
                                                <a href="{{ asset('') . $booking->contract_image }}" target="_blank">
                                                    <img src="{{ asset($booking->contract_image) }}" alt="Document"
                                                        class="img-fluid">
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <div class="doc-wrapper mb-4">
                                            <img src="{{ asset('panelslayout/dist/img/placholder-img.jpg') }}"
                                                alt="pdf">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <p>EziDebit Form</p>
                                    @if ($booking->ezidebit_image)
                                        <div class="doc-wrapper mb-4">
                                            @if (pathinfo($booking->ezidebit_image, PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ asset('') . $booking->ezidebit_image }}" target="_blank">
                                                    <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                        alt="pdf">
                                                </a>
                                            @else
                                                <a href="{{ asset('') . $booking->ezidebit_image }}" target="_blank">
                                                    <img src="{{ asset($booking->ezidebit_image) }}" alt="Document"
                                                        class="img-fluid">
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <div class="doc-wrapper mb-4">
                                            <img src="{{ asset('panelslayout/dist/img/placholder-img.jpg') }}"
                                                alt="pdf">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <p>Insurance Declaration</p>
                                    @if ($booking->insurance_declaration_image)
                                        <div class="doc-wrapper mb-4">
                                            @if (pathinfo($booking->insurance_declaration_image, PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ asset('') . $booking->insurance_declaration_image }}"
                                                    target="_blank">
                                                    <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                        alt="pdf">
                                                </a>
                                            @else
                                                <a href="{{ asset('') . $booking->insurance_declaration_image }}"
                                                    target="_blank">
                                                    <img src="{{ asset($booking->insurance_declaration_image) }}"
                                                        alt="Document" class="img-fluid">
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <div class="doc-wrapper mb-4">
                                            <img src="{{ asset('panelslayout/dist/img/placholder-img.jpg') }}"
                                                alt="pdf">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <p>Handover Checklist</p>
                                    @if ($booking->handover_checklist_image)
                                        <div class="doc-wrapper mb-4">
                                            @if (pathinfo($booking->handover_checklist_image, PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ asset('') . $booking->handover_checklist_image }}"
                                                    target="_blank">
                                                    <img src="{{ asset('panelslayout/dist/img/pdf.png') }}"
                                                        alt="pdf">
                                                </a>
                                            @else
                                                <a href="{{ asset('') . $booking->handover_checklist_image }}"
                                                    target="_blank">
                                                    <img src="{{ asset($booking->handover_checklist_image) }}"
                                                        alt="Document" class="img-fluid">
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <div class="doc-wrapper mb-4">
                                            <img src="{{ asset('panelslayout/dist/img/placholder-img.jpg') }}"
                                                alt="pdf">
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h4 class="dashboard-title">Vehicle</h4>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <a class="btn btn-outline-primary btn-sm sm adj-sm-icon"
                                            href="{{ route('vehicle.show', $vehicle->vehicle_id) }}">
                                            <i class="fas fa-eye">
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Make:</div>
                                        <div class="data-value">{{ $vehicle->fuel_type }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Vehicle Owner:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_owner->c_first_name }}
                                            @if ($vehicle->vehicle_owner->c_last_name != null)
                                                {{ $vehicle->vehicle_owner->c_last_name }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Registration No:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_registration_no }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Model:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_model }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Engine No:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_engine_no }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h4 class="dashboard-title">Driver</h4>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <a class="btn btn-outline-primary btn-sm sm adj-sm-icon"
                                            href="{{ route('driver.show', $driver->driver_id) }}">
                                            <i class="fas fa-eye">
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Name:</div>
                                        <div class="data-value">{{ $driver->first_name }} {{ $driver->last_name }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Email:</div>
                                        <div class="data-value">{{ $driver->email }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Telephone:</div>
                                        <div class="data-value">{{ $driver->contact }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Driver licence number:</div>
                                        <div class="data-value">{{ $driver->driver_license_no }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Expiration Date:</div>
                                        <div class="data-value">
                                            {{ date('d-m-Y', strtotime($driver->license_expiry_date)) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Comments --}}
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h4 class="dashboard-title">Comments</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <form class=""
                                onsubmit="addComment(event, '{{ $booking->booking_id }}', '{{ Auth::user()->name }}', '{{ route('booking.comment.store', ['id' => $booking->booking_id]) }}', '{{ route('comment.delete', ['id' => $booking->booking_id, 'commentId' => ':commentId']) }}', 'booking')"
                                id="add-comment" action="">
                                @csrf
                                <input type="type" value="{{ old('comments') }}" id="comment-input" name="comment"
                                    class="form-control mr-1 booking-add-comment-input" placeholder="Add a Comment">
                                <div class="booking-add-comment-button">
                                    <div class="text-right mt-2">
                                        <button class="btn btn-outline-primary btn-sm sm adj-sm-icon" type="submit">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12" id="comments">
                            @foreach ($comments as $comment)
                                <div id="comment-{{ $comment->comment_id }}" class="my-2">
                                    <div class="media">
                                        <div class="img-size-50 mr-3 img-circle bg-danger d-flex justify-content-center align-items-center"
                                            style="width: 40px; height: 40px">
                                            <span>{{ implode(
                                                '',
                                                array_map(function ($word) {
                                                    return strtoupper($word[0]);
                                                }, preg_split('/\s+/', $comment->user->name)),
                                            ) }}</span>
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="text-sm">
                                                        <span class="mr-2">{{ $comment->user->name }}</span> <br
                                                            class="d-sm-none"> <span class="text-xs text-muted"><i
                                                                class="far fa-clock"></i>
                                                            {{ \Carbon\Carbon::parse($comment->created_at)->format('d-m-y g:i A') }}</span>
                                                    </div>
                                                    @if (Auth::id() === $comment->user_id)
                                                        <div class="dropdown">
                                                            <button class="action-button" type="button"
                                                                id="actionsDropdown1" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <!-- Three vertical dots icon -->
                                                                <i class="fas fa-ellipsis-v fa-xs"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                aria-labelledby="actionsDropdown1" style="">
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="showEditCommentModal(event,'{{ $comment->comment_id }}', '{{ $booking->booking_id }}', '{{ route('comment.edit', ['commentId' => $comment->comment_id]) }}'); return false;">Edit</a>
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="deleteComment(event, '{{ $comment->comment_id }}', '{{ $booking->booking_id }}', '{{ route('comment.delete', ['commentId' => $comment->comment_id]) }}', 'booking'); return false;">Delete</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p id="comment-{{ $comment->comment_id }}-text"
                                                    class="pr-xs-3 pr-0 mt-1">{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal w-100" tabindex="-1" id="exampleModal">
            <form action="" onsubmit="editComment(event);">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <div class="modal-content booking-modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title">Edit Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-outline-primary"
                                id="saveChangesButton">Confirm</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Extend Booking Modal -->
        <div class="modal w-100" tabindex="-1" id="extendbookingmodal">
            <form action="" onsubmit="extendBooking(event, {{$booking->booking_id}})">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <div class="modal-content booking-modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title">Extend Booking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetExtendDateModal()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputConfirmPassword1">Start Date<span aria-hidden="true"
                                                class="required">*</span></label>

                                        <input type="text"
                                            value="{{ date('d-m-Y', strtotime($booking->start_date)) }}"
                                            id="starting_date" required name="starting_date"
                                            class="date-input form-control" placeholder="Start Date" disabled>

                                        <input type="hidden" name="driver_id" id="driver_id"
                                            value="{{ $driver->driver_id }}">
                                        <input type="hidden" name="vehicle_reg_id" id="vehicle_reg_id"
                                            value="{{ $vehicle->vehicle_id }}">
                                    </div>
                                </div>

                                <?php $today = date('Y-m-d'); ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="showInput">
                                            <label for="exampleInputConfirmPassword1">End Date<span aria-hidden="true"
                                                    class="required">*</span></label>

                                            <input type="text" name="new_ending_date"
                                                value="{{ date('d-m-Y', strtotime($booking->end_date)) }}"
                                                class="date-input form-control" id="ending_date"
                                                placeholder="Enter Return Date" required
                                                onchange="endDateValidation({{ $booking->booking_id }})">

                                            <input type="hidden" id="curr-ending-date"
                                                value="{{ date('d-m-Y', strtotime($booking->end_date)) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <span class="text-danger" id="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" onclick="resetExtendDateModal()">Cancel</button>
                            <button type="submit" class="btn btn-outline-primary"
                                id="saveChangesButton">Confirm</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </section>
@endsection

<style>
    .table .thead-dark th {
        background-color: #111111 !important;
        color: #fff;
    }
</style>

@if (!$isEndToday)
    <script>
        let bookingId = {{ $booking->booking_id }};
        localStorage.removeItem(`remindMeLaterTime-${bookingId}`);
    </script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        addCommentButtonToggle();
    })

    function resetExtendDateModal() {
        $('#starting_date').val("{{ date('d-m-Y', strtotime($booking->start_date)) }}");
        $('#ending_date').val("{{ date('d-m-Y', strtotime($booking->end_date)) }}");
        $('#error-message').text("");
        $('#saveChangesButton').prop('disabled', false);
    }
</script>
