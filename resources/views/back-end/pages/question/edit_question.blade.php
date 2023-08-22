@extends('layouts.master')

@section('title')
    {{ __('Update question') }}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav" role="tablist">
                <a href="{{ route('question') }}" class="add-report-btn active">
                    <i class="fas fa-list"></i> &nbsp;
                    {{ __('View List') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade active show" id="add-new-petty" role="tabpanel">
                <div class="table-header">
                    <h4>{{ __('Update question') }}</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <div class="order-form-section">
                            <form action="{{ route('update-question',['id'=> $info->id]) }}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Quiz Name') }}</label>
                                        <select name="quiz_id" class="form-control" required>
                                            <option value="" disabled selected>{{__('Select a quiz name')}}</option>
                                            @foreach($quizzes as $quiz)
                                                <option @selected($quiz->id == $info->quiz_id) value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Question')}}</label>
                                        <input type="text" name="question" class="form-control" placeholder="Question" required value="{{$info->question}}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Option A')}}</label>
                                        <input type="text" name="option_a" class="form-control" placeholder="Option A" required value="{{$info->option_a}}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Option B')}}</label>
                                        <input type="text" name="option_b" class="form-control" placeholder="Option B" required value="{{$info->option_b}}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Option C')}}</label>
                                        <input type="text" name="option_c" class="form-control" placeholder="Option C" value="{{$info->option_c}}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Option D')}}</label>
                                        <input type="text" name="option_d" class="form-control" placeholder="Option D" value="{{$info->option_d}}">
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Answer') }}</label>
                                        <select name="answer" class="form-control" required>
                                            <option value="" disabled selected>{{__('Select a Answer')}}</option>
                                            <option @selected($info->answer == 'A') value="A">{{__('A')}}</option>
                                            <option @selected($info->answer == 'B') value="B">{{__('B')}}</option>
                                            <option @selected($info->answer == 'C') value="C">{{__('C')}}</option>
                                            <option @selected($info->answer == 'D') value="D">{{__('D')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Status') }}</label>
                                        <select name="status" class="form-control" required>
                                            <option @selected($info->status == 1) value="1">{{__('Published')}}</option>
                                            <option @selected($info->status == 0) value="0">{{__('Unpublished')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Image (optional)')}}</label>
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
