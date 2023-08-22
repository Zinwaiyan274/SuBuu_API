@extends('layouts.master')

@section('title')
    {{ __('Withdraws list') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid"><br>
            <div class="tab-content order-summary-tab">
                <div class="tab-pane fade show active" id="supplier-list-two">
                    <div class="table-header">
                        <h4>{{ __('Withdraws List') }}</h4>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-sm-4">
                            <form action="">
                                <div class="input-group w-280">
                                    <input type="text" class="form-control rounded-0" placeholder="Searching..." aria-describedby="basic-addon2" name="search" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="input-group-text btn btn-warning rounded-0 rounded-end">{{ __('Search') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="responsive-table">
                        <table class="table" id="erp-table">
                            <thead>
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Points') }}</th>
                                    <th>{{ __('Method') }}</th>
                                    <th>{{ __('Account') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ optional($request->user)->name }}</td>
                                        <td>{{ $request->coins }}</td>
                                        <td>{{ optional($request->methodName)->name }}</td>
                                        <td>{{ $request->account }}</td>
                                        <td>{{ optional($request->convert->currency)->symbol . $request->amount }}</td>
                                        <td>
                                            {{ date('d M Y - H:i A', strtotime($request->created_at)) }}
                                        </td>
                                        <td>
                                            @if ($request->approve_status == 0)
                                                <div class="badge bg-danger">{{ __('Rejected') }}</div>
                                            @elseif ($request->approve_status == 3)
                                                <div class="badge bg-success">{{ __('Approved') }}</div>
                                            @else
                                                <div class="badge bg-warning">{{ __('Pending') }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown table-action">
                                                <button type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                    class="">
                                                    <i class="far fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @if ($request->approve_status != 3)
                                                        <li>
                                                            <a href="{{ route('withdraw.approved', $request->id) }}"
                                                                class="confirm-action" data-method="GET">
                                                                <i class="fas fa-check-circle"></i>
                                                                {{ __('Approve') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if ($request->approve_status != 0)
                                                        <li>
                                                            <a href="{{ route('withdraw.reject', $request->id) }}"
                                                                class="confirm-action" data-method="GET">
                                                                <i class="fas fa-times-circle"></i>
                                                                {{ __('Reject') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="javascript:void(0)" class="view-withdraw"
                                                            data-name="{{ optional($request->user)->name }}"
                                                            data-points="{{ $request->coins }}"
                                                            data-method="{{ optional($request->methodName)->name }}"
                                                            data-account="{{ $request->account }}"
                                                            data-amount="{{ optional($request->convert->currency)->symbol . $request->amount }}"
                                                            data-created_at="{{ date('d M Y - H:i A', strtotime($request->created_at)) }}"
                                                            data-status="{{ $request->approve_status }}"
                                                            data-notes="{{ $request->notes }}">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                            {{ __('View') }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $requests->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="withdraw-view-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Withdraw View</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body order-form-section loan-view-modal-wrapper">
                    <ul class="bank-status-list">
                        <li><span class="w-140">User Name </span> <span>:</span> <span class="user_name"></span></li>
                        <li><span class="w-140">Points </span> <span>:</span> <span class="points"></span></li>
                        <li><span class="w-140">Method </span> <span>:</span> <span class="method"></span></li>
                        <li><span class="w-140">Account </span> <span>:</span> <span class="account"></span></li>
                        <li><span class="w-140">Amount </span> <span>:</span> <span class="amount"></span></li>
                        <li><span class="w-140">Created At </span> <span>:</span> <span class="created_at"></span></li>
                        <li><span class="w-140">Status </span> <span>:</span> <span class="status"></span></li>
                        <li><span class="w-140">Notes </span> <span>:</span> <span class="notes"></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="withdraw-reject-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">{{ __("Are you sure you want to reject this?") }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" class="ajaxform_instant_reload reject-form">
                    @csrf

                    <div class="modal-body">
                        <textarea cols="2" rows="5" name="notes" class="form-control mt-3" placeholder="Note"></textarea>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="theme-btn border-btn" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="theme-btn submit-btn">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
