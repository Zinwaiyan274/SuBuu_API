@extends('layouts.master')

@section('title')
    {{__('Cash Rocket') }}
@endsection

@section('main_content')
    <div class="erp-state-overview-section">
        <div class="container-fluid">
            <div class="erp-state-overview">
                <div class="erp-state-overview-wrapper">
                    <div class="state-overview-box">
                        <div class="icons">
                            <img src="{{ asset('back-end/img/icon/category.png') }}" alt="Not found">
                        </div>
                        <div class="count-content-wrapper">
                            <h2 class="quiz_category"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></h2>
                            <p>{{__('Total quiz category')}}</p>
                        </div>
                    </div>
                    <div class="state-overview-box">
                        <div class="icons">
                            <img src="{{ asset('back-end/img/icon/balance.png') }}" alt="Not found">
                        </div>
                        <div class="count-content-wrapper">
                            <h2>$<span class="total_balance"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></span>
                            </h2>
                            <p>{{__('Total balance')}}</p>
                        </div>
                    </div>
                    <div class="state-overview-box">
                        <div class="icons">
                            <img src="{{ asset('back-end/img/icon/quiz.png') }}" alt="Not found">
                        </div>
                        <div class="count-content-wrapper">
                            <h2 class="total_quizes"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></h2>
                            <p>{{__('Total quizes')}}</p>
                        </div>
                    </div>
                    <div class="state-overview-box">
                        <div class="icons">
                            <img src="{{asset('back-end/img/icon/questions.png')}}" alt="">
                        </div>
                        <div class="count-content-wrapper">
                            <h2 class="total_questions"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></h2>
                            <p>{{__('Total questions')}}</p>
                        </div>
                    </div>
                    <div class="state-overview-box">
                        <div class="icons">
                            <img src="{{asset('back-end/img/icon/total-withdraw.png')}}" alt="">
                        </div>
                        <div class="count-content-wrapper">
                            <h2>$<span class="total_withdraw"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></span></h2>
                            <p>{{__('Total withdraw')}}</p>
                        </div>
                    </div>
                    <div class="state-overview-box">
                        <div class="icons">
                            <img data-src="{{asset('/back-end/img/icon/pending-withdraw.png')}}" alt="">
                        </div>
                        <div class="count-content-wrapper">
                            <h2>$<span class="pending_withdraw"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></span></h2>
                            <p>{{__('Total pending withdraw')}}</p>
                        </div>
                    </div>
                    <div class="state-overview-box">
                        <div class="icons">
                            <img data-src="{{asset('/back-end/img/icon/withdraw-success.png')}}" alt="">
                        </div>
                        <div class="count-content-wrapper">
                            <h2>$<span class="approved_withdraw"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></span></h2>
                            <p>{{__('Total approved withdraw')}}</p>
                        </div>
                    </div>
                    <div class="state-overview-box">
                        <div class="icons">
                            <img data-src="{{asset('/back-end/img/icon/rejected-withdraw.png')}}" alt="">
                        </div>
                        <div class="count-content-wrapper">
                            <h2>$<span class="rejected_withdraw"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></span></h2>
                            <p>{{__('Total rejected withdraw')}}</p>
                        </div>
                    </div>
                    <div class="state-overview-box">
                        <div class="icons">
                            <img data-src="{{asset('/back-end/img/icon/user.png')}}" alt="">
                        </div>
                        <div class="count-content-wrapper">
                            <h2 class="total_user"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></h2>
                            <p>{{__('Total user')}}</p>
                        </div>
                    </div>
                    <div class="state-overview-box">
                        <div class="icons">
                            <img data-src="{{asset('/back-end/img/icon/dollar.png')}}" alt="">
                        </div>
                        <div class="count-content-wrapper">
                            <h2 class="total_currency"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></h2>
                            <p>{{__('Total currency')}}</p>
                        </div>
                    </div>
                    <div class="state-overview-box">
                        <div class="icons">
                            <img data-src="{{asset('/back-end/img/icon/currency-convert.png')}}" alt="">
                        </div>
                        <div class="count-content-wrapper">
                            <h2 class="currency_covert"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></h2>
                            <p>{{__('Total currency covert')}}</p>
                        </div>
                    </div>
                    <div class="state-overview-box">
                        <div class="icons">
                            <img data-src="{{asset('/back-end/img/icon/rewards.png')}}" alt="">
                        </div>
                        <div class="count-content-wrapper">
                            <h2 class="total_rewards"><img data-src="{{ asset('assets/img/loader.gif') }}" alt=""></h2>
                            <p>{{__('Total rewards')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="graph-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="erp-graph-box">
                        <div class="graph-header">
                            <h4>{{ __('Withdraws') }}</h4>
                        </div>
                        <div class="erp-box-content">
                            <canvas class="timeline-chart-wrapper min-height-200px" id="timeline-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="graph-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="erp-graph-box top-customer">
                        <div class="graph-header d-flex flex-wrap justify-content-between">
                            <h4>{{__('Top Users')}}</h4>
                            <a href="{{ route('user') }}" class="btn btn-light btn-sm rounded-circle"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </div>
                        <div class="erp-box-content">
                            <div class="top-customer-table">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Phone') }}</th>
                                            <th>{{ __('Balance') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['wallet_max'] as  $wallet_user)
                                        <tr>
                                            <td>
                                                <img height="45" width="45" class="rounded-circle" src="{{asset($wallet_user->user->image ? $wallet_user->user->image : '/back-end/img/icon/cover-photo.jpg')}}" alt="">
                                            </td>
                                            <td>
                                                <strong>{{$wallet_user->user->name}}</strong>
                                            </td>
                                            <td>
                                                <span>{{$wallet_user->user->email}}</span>
                                            </td>
                                            <td>{{$wallet_user->user->phone}}</td>
                                            <td><b>{{$wallet_user->balance}}</b></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="erp-graph-box yearly-status">
                        <div class="graph-header d-flex flex-wrap justify-content-between">
                            <h4>{{__('Latest Quiz')}}</h4>
                            <a href="{{ route('quiz') }}" class="btn btn-light btn-sm rounded-circle"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </div>
                        <div class="erp-box-content">
                            <div class="top-customer-table">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Quiz Name') }}</th>
                                            <th>{{ __('Reward Point') }}</th>
                                            <th>{{ __('Created At') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['latest_quiz'] as $latest_quiz)
                                        <tr>
                                            <td>
                                                <img class="rounded-circle" width="45" height="45" src="{{asset($latest_quiz->image)}}" alt="">
                                            </td>
                                            <td><span>{{$latest_quiz->name}}</span></td>
                                            <td>{{$latest_quiz->reward_point}}</td>
                                            <td>
                                                {{ date('d M Y H:i A', strtotime($latest_quiz->created_at))}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="get-dashboard-url" value="{{ route('dashboard.data') }}">
@endsection

@push('js')
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('back-end/js/jquery.unveil.js') }}"></script>
<script src="{{ asset('back-end/js/dashboard.js') }}"></script>
@endpush
