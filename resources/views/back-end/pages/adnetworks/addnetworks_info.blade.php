@extends('layouts.master')

@section('title')
    {{ __('Adnetworks') }}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid"><br>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade active show" id="add-new-petty" role="tabpanel">
                <div class="table-header">
                    <h4>{{ __('Adnetworks') }}</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-12">
                        <div class="order-form-section">
                            <form action="{{ route('update-adnetwork', $info->id) }}" method="post" class="ajaxform" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Admob Interstitial (Android)')}}</label>
                                        <input type="text" name="admob_interstitial_android" class="form-control" value="{{ $info->admob_interstitial_android ?? '' }}">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Admob Interstitial (IOS)')}}</label>
                                        <input type="text" name="admob_interstitial_ios" class="form-control" value="{{ $info->admob_interstitial_ios ?? '' }}">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Admob Rewarded Ad (Android)')}}</label>
                                        <input type="text" name="admob_rewarded_android" class="form-control" value="{{ $info->admob_rewarded_android ?? '' }}">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Admob Rewarded Ad (IOS)')}}</label>
                                        <input type="text" name="admob_rewarded_ad_ios" class="form-control" value="{{ $info->admob_rewarded_ad_ios ?? '' }}">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Applovin Rewarded Ad (Android)')}}</label>
                                        <input type="text" name="applovin_rewarded_ad_android" class="form-control" value="{{ $info->applovin_rewarded_ad_android ?? '' }}">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label>{{ __('Applovin Rewarded Ad (IOS)') }}</label>
                                        <input type="text" name="applovin_rewarded_ad_ios" class="form-control"  value="{{ $info->applovin_rewarded_ad_ios ?? '' }}">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Audience Network Rewarded Ad (Android)')}}</label>
                                        <input type="text" name="audience_network_rewarded_ad_android" class="form-control" value="{{ $info->audience_network_rewarded_ad_android ?? '' }}">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Audience Network Ad (IOS)')}}</label>
                                        <input type="text" name="audience_network_ad_ios" class="form-control" value="{{ $info->audience_network_ad_ios ?? '' }}">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Audience Network Interstitial (Android)')}}</label>
                                        <input type="text" name="audience_network_interstitial_android" class="form-control" value="{{ $info->audience_network_interstitial_android ?? '' }}">
                                    </div>

                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Audience Network Interstitial (IOS)')}}</label>
                                        <input type="text" name="audience_network_interstitial_ios" class="form-control" value="{{ $info->audience_network_interstitial_ios ?? '' }}">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Offertoro Publisher Id')}}</label>
                                        <input type="text" name="offertoro_publisher_id" class="form-control" value="{{ $info->offertoro_publisher_id ?? '' }}">
                                    </div>

                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Offertoro App Id')}}</label>
                                        <input type="text" name="offertoro_app_id" class="form-control" value="{{ $info->offertoro_app_id ?? '' }}">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label>{{__('Offertoro Secret Key')}}</label>
                                        <input type="text" name="offertoro_secret_key" class="form-control" value="{{ $info->offertoro_secret_key ?? '' }}">
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="button-group text-center mt-5">
                                            <button class="theme-btn m-2 submit-btn">{{ __('Update') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
