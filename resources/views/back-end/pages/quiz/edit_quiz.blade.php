@extends('layouts.master')

@section('title')
    {{ __('Update quiz') }}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav" role="tablist">
                <a href="{{ route('quiz') }}" class="add-report-btn active">
                    <i class="fas fa-list"></i> &nbsp;
                    {{ __('View List') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade active show" id="add-new-petty" role="tabpanel">
                <div class="table-header">
                    <h4>Update quiz</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-9">
                        <div class="order-form-section">
                            <form action="{{route('update-quiz',['id'=> $info->id])}}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Category Name') }}</label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="" disabled selected>{{__('Select a Quiz Category')}}</option>
                                            @foreach($categories as $category)
                                                <option @selected($category->id == $info->category_id) value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Quiz Name')}}</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" required  value="{{ $info->name }}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Free or Paid')}}</label>
                                        <select name="paid_status" id="paid_status" class="form-control" required>
                                            <option @selected($info->paid_status == 0) value="0" value="0">{{ __('Free') }} </option>
                                            <option @selected($info->paid_status == 1) value="1" value="1">{{ __('Paid') }} </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Status')}}</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option @selected($info->status == 1) value="1">{{ __('Published') }} </option>
                                            <option @selected($info->status == 0) value="0">{{ __('Unpublished') }} </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Reward Point')}}</label>
                                        <input type="number" name="reward_point" class="form-control" placeholder="Reward Point" required  value="{{ $info->reward_point }}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Retake Point')}}</label>
                                        <input type="number" name="retake_point" class="form-control" placeholder="Retake Point" required  value="{{ $info->retake_point }}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Image')}}</label>
                                        <input type="file" name="image" class="form-control" id="image">
                                    </div>
                                    <div class="col-lg-6 mt-3 align-self-center">
                                        <img height="35" width="35" class="rounded-circle" src="{{ asset($info->image) }}" alt="">
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
    </div>
</div>
@endsection

