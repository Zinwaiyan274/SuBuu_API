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

            </div>
            <div class="tab-pane fade" id="quiz-question">

            </div>
        </div>
    </div>
</div>

@endsection
