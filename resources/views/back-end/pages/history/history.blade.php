@extends('layouts.master')

@section('title')
    {{ __('All Reports') }}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade show active" id="supplier-list-two"><br>
                <div class="table-header">
                    <h4>{{ __('All Reports') }}</h4>
                </div>
                <div class="row mt-3">
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
                                <th>{{__('#')}}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Note') }}</th>
                                <th>{{ __('Created At') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $history)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $history->user->name ?? '' }}</td>
                                    <td>{{ $history->amount }}</td>
                                    <td>{{ $history->description }}</td>
                                    <td>{{ $history->note }}</td>
                                    <td>{{ date('d M Y - H:i A', strtotime($history->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $histories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

