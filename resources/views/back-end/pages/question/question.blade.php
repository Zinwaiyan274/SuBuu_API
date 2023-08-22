@extends('layouts.master')

@section('title')
{{__('Questions list')}}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav">
                <a href="#question-list" data-bs-toggle="tab" class="add-report-btn active"><i class="fas fa-list"></i>
                    &nbsp;
                    {{ __('Question List') }}</a>
                <a href="#quiz-question" data-bs-toggle="tab" class="add-report-btn"><i class="fas fa-plus-circle"></i>
                    &nbsp;
                    {{ __('Add Question') }}</a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade show active" id="question-list">
                <div class="table-header">
                    <h4>Question List</h4>
                </div>
                <div class="w-500">
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <select class="form-control" onchange="getQuestions($(this).val())" data-url="{{ route('get-question') }}">
                                <option value="">-All Questions-</option>
                                @foreach($quizzes as $quiz)
                                    <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control rounded-0" placeholder="Searching..." aria-describedby="basic-addon2" name="search" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="input-group-text btn btn-warning rounded-0 rounded-end">{{ __('Search') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Questions Table Data --}}
                <div class="questions-data">
                    @include('back-end.pages.question.data')
                </div>
            </div>
            <div class="tab-pane fade" id="quiz-question">
                <div class="table-header">
                    <h4>{{ __('Create new question') }}</h4>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="order-form-section">
                            <form action="{{route('new-question')}}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-4 mt-2">
                                        <label>{{ __('Quiz Name') }}</label>
                                        <select name="quiz_id" class="form-control" required>
                                            <option value="" disabled selected>{{__('Select a quiz name')}}</option>
                                            @foreach($quizzes as $quiz)
                                                <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 mt-2">
                                        <label>{{__('Question')}}</label>
                                        <input type="text" name="question" class="form-control" placeholder="Question" required>
                                    </div>
                                    <div class="col-lg-4 mt-2">
                                        <label>{{__('Option A')}}</label>
                                        <input type="text" name="option_a" class="form-control" placeholder="Option A" required>
                                    </div>
                                    <div class="col-lg-4 mt-2">
                                        <label>{{__('Option B')}}</label>
                                        <input type="text" name="option_b" class="form-control" placeholder="Option B" required>
                                    </div>
                                    <div class="col-lg-4 mt-2">
                                        <label>{{__('Option C')}}</label>
                                        <input type="text" name="option_c" class="form-control" placeholder="Option C">
                                    </div>
                                    <div class="col-lg-4 mt-2">
                                        <label>{{__('Option D')}}</label>
                                        <input type="text" name="option_d" class="form-control" placeholder="Option D">
                                    </div>
                                    <div class="col-lg-4 mt-2">
                                        <label>{{ __('Answer') }}</label>
                                        <select name="answer" class="form-control" required>
                                            <option value="" disabled selected>{{__('Select a Answer')}}</option>
                                            <option value="A">{{__('A')}}</option>
                                            <option value="B">{{__('B')}}</option>
                                            <option value="C">{{__('C')}}</option>
                                            <option value="D">{{__('D')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 mt-2">
                                        <label>{{ __('Status') }}</label>
                                        <select name="status" class="form-control" required>
                                            <option selected value="1">{{__('Published')}}</option>
                                            <option value="0">{{__('Unpublished')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 mt-2">
                                        <label>{{__('Image (optional)')}}</label>
                                        <input type="file" name="image" class="form-control" id="image">
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

<input type="hidden" id="get-question" value="{{ route('get-question') }}">
@endsection
