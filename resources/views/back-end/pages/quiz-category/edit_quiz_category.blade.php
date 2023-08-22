@extends('layouts.master')

@section('title')
    {{__('Update quiz category')}}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav" role="tablist">
                <a href="{{ route('quiz-category') }}" class="add-report-btn active">
                    <i class="fas fa-list"></i> &nbsp;
                    {{ __('View List') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade active show" id="add-new-petty" role="tabpanel">
                <div class="table-header">
                    <h4>Update quiz category</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="order-form-section">
                            <form action="{{route('update-quiz-category',['id'=> $info->id])}}" method="post" class="add-brand-form ajaxform_instant_reload" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Name') }}</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" required value="{{ $info->name }}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>Status</label>
                                        <select name="status" class="form-control table-select w-100 form-control">
                                            <option @selected($info->status == 1) value="1">Published</option>
                                            <option @selected($info->status == 0) value="0">Unpublished</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label>Icon</label>
                                        <input type="file" name="image" class="form-control" id="image">
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label>{{ __('Description') }}</label>
                                        <textarea cols="30" name="description" rows="4" class="form-control" spellcheck="false">{{ $info->description }}</textarea>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="button-group text-center mt-5">
                                            <a href="{{ route('quiz-category') }}" class="theme-btn border-btn m-2">{{ __('Cancle') }}</a>
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

