@extends('layouts.app')

@section('admincontent')
    <section class="content-header mb-0 pb-0">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <h1>Fine Details</h1>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row d-flex justify-content-between">
                        <button type="button" onclick="goBack()" class="btn btn-primary btn-sm sm">
                            <i class="fas fa-arrow-left mr-1"></i>
                        </button>
                        @if (Auth::user()->hasPermissionTo('edit-fine'))
                            <a href="{{ route('fine.edit', $fine->fine_id) }}" class="btn btn-outline-primary btn-sm sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        @endif
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
                            <h4 class="dashboard-title">Fine</h4>
                        </div>
                        <div class="card-body custom-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Vehicle Registration:</div>
                                        <div class="data-value">{{ $vehicle->vehicle_registration_no }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Driver:</div>
                                        <div class="data-value">
                                            @if ($fine->payable_type == 'App\Models\Driver')
                                                {{ $offender->first_name }} {{ $offender->last_name }}
                                            @else
                                                {{ $offender->c_first_name }} @if ($offender->c_last_name != null)
                                                    {{ $offender->c_last_name }}
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Notice Number:</div>
                                        <div class="data-value">{{ $fine->notice }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Notice Type:</div>
                                        <div class="data-value">
                                            {{ isset(config('app.notice_types')[$fine->notice_type]) ? config('app.notice_types')[$fine->notice_type] : 'Unknown' }}
                                        </div>
                                    </div>
                                </div>
                                @if ($fine->notice_type_details['2'] ?? false)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Police State:</div>
                                            <div class="data-value">{{ $fine->notice_type_details['2'] }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if ($fine->notice_type_details['4'] ?? false)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Recovery Company:</div>
                                            <div class="data-value">{{ $fine->notice_type_details['4'] }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if ($fine->notice_type_details['3'] ?? false)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">City Council Name:</div>
                                            <div class="data-value">{{ $fine->notice_type_details['3'] }}</div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Due Date:</div>
                                        <div class="data-value">{{ date('d-m-Y', strtotime($fine->due_date)) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Amount:</div>
                                        <div class="data-value">${{ number_format($fine->amount, 2) }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Owner:</div>
                                        <div class="data-value">
                                            {{ $customer->c_first_name }} @if ($customer->c_last_name != null)
                                                {{ $customer->c_last_name }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Date of Offence:</div>
                                        <div class="data-value">
                                            {{ date('d-m-Y', strtotime($fine->date_of_offence)) }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Date Process:</div>
                                        <div class="data-value">{{ date('d-m-Y', strtotime($fine->date_process)) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="profile-data">
                                        <div class="data-key">Status:</div>
                                        <div class="data-value">{{ $fine->status }}</div>
                                    </div>
                                </div>
                                @if ($fine->comment)
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="profile-data">
                                            <div class="data-key">Comment:</div>
                                            <div class="data-value">{{ $fine->comment }}</div>
                                        </div>
                                    </div>
                                @endif
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
                            <h4 class="dashboard-title">Notes</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <form class=""
                                onsubmit="addComment(event, '{{ $fine->fine_id }}', '{{ Auth::user()->name }}', '{{ route('fine.comment.store', ['id' => $fine->fine_id]) }}', '{{ route('comment.delete', ['id' => $fine->fine_id, 'commentId' => ':commentId']) }}', 'fine')"
                                id="add-comment" action="">
                                @csrf
                                <input type="type" value="{{ old('comments') }}" id="comment-input" name="comment"
                                    class="form-control mr-1 booking-add-comment-input" placeholder="Add a Note">
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
                                                                    onclick="showEditCommentModal(event,'{{ $comment->comment_id }}', '{{ $fine->fine_id }}', '{{ route('comment.edit', ['commentId' => $comment->comment_id]) }}'); return false;">Edit</a>
                                                                <a class="dropdown-item" href="#"
                                                                    onclick="deleteComment(event, '{{ $comment->comment_id }}', '{{ $fine->fine_id }}', '{{ route('comment.delete', ['commentId' => $comment->comment_id]) }}', 'fine'); return false;">Delete</a>
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
        </div><!-- /.container-fluid -->

        <!-- Modal -->
        <div class="modal w-100" tabindex="-1" id="exampleModal">
            <form action="" onsubmit="editComment(event);">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <div class="modal-content booking-modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title">Edit Note</h5>
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

    </section>
@endsection

<style>
    .table .thead-dark th {
        background-color: #111111 !important;
        color: #fff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        addCommentButtonToggle();
    })
</script>
