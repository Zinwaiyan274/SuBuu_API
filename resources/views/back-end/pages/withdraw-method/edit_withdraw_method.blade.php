@extends('layouts.master')

@section('title')
    {{ __('Update withdraw method') }}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav" role="tablist">
                <a href="{{ route('withdraw-method') }}" class="add-report-btn active">
                    <i class="fas fa-list"></i> &nbsp;
                    {{ __('View List') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade active show" id="add-new-petty" role="tabpanel">
                <div class="table-header">
                    <h4>{{ __('Update withdraw method') }}</h4>
                </div>
                <div class="order-form-section">
                    <form action="{{ route('update-withdraw-method',['id'=> $info->id]) }}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required  value="{{ $info->name }}">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label>{{__('Minimum Amount')}}</label>
                                <input type="number" name="minimum_amount" step="any" class="form-control" placeholder="Minimum Amount" required  value="{{ $info->minimum_amount }}">
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label>{{__('Status')}}</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option @selected($info->status == 1) value="1">{{ __('Published') }} </option>
                                    <option @selected($info->status == 0) value="0">{{ __('Unpublished') }} </option>
                                </select>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label>{{__('Image')}}</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <div class="col-lg-12 mt-3 text-end">
                                <img height="50" width="50" src="{{ asset($info->image) }}" alt="">
                            </div>

                            <div class="col-lg-12">
                                <div class="button-group text-center mt-5">
                                    <button type="reset" class="theme-btn border-btn m-2">{{ __('Reset') }}</button>
                                    <button class="theme-btn m-2 submit-btn">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

