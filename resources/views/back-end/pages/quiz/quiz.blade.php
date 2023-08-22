@extends('layouts.master')

@section('title')
{{__('Quizes list')}}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav">
                <a href="#quiz-list" data-bs-toggle="tab" class="add-report-btn active"><i class="fas fa-list"></i>
                    &nbsp;
                    {{ __('Quiz List') }}</a>
                <a href="#quiz-add" data-bs-toggle="tab" class="add-report-btn"><i class="fas fa-plus-circle"></i>
                    &nbsp;
                    {{ __('Add Quiz') }}</a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade show active" id="quiz-list">
                <div class="table-header">
                    <h4>Quiz List</h4>
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
                                <th>{{ __('SL') }}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Category Name')}}</th>
                                <th>{{__('Quiz Name')}}</th>
                                <th>{{__('Free or Paid')}}</th>
                                <th>{{__('reward point ')}}</th>
                                <th>{{__('Retake Point')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img height="35" width="35" class="rounded-circle" src="{{ asset($quiz->image) }}" alt="">
                                    </td>
                                    <td>{{$quiz->quizCategory->name}}</td>
                                    <td>{{$quiz->name}}</td>
                                    <td>
                                        <div class="badge bg-{{ $quiz->paid_status ? 'warning' : 'success' }}">
                                            {{ $quiz->paid_status ? __('Paid') : __('Free') }}
                                        </div>
                                    </td>
                                    <td>{{$quiz->reward_point}}</td>
                                    <td>{{$quiz->retake_point}}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-item" type="checkbox" name="status_{{$quiz->id}}" id="status_{{$quiz->id}}" value="{{$quiz->status}}" {{$quiz->status==1?'checked':''}} data-id ="{{$quiz->id}}" data-status="Quiz Status">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown table-action">
                                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                class="">
                                                <i class="far fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('edit-quiz', ['id' => $quiz->id]) }}"><i class="fal fa-pencil-alt"></i> {{ __('Edit') }} </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('delete-quiz',$quiz->id) }}" class="confirm-action" data-method="DELETE">
                                                        <i class="fal fa-trash-alt"></i>
                                                        {{ __('Delete') }}
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
                {{ $quizzes->links() }}
            </div>
            <div class="tab-pane fade" id="quiz-add">
                <div class="table-header">
                    <h4>Create new quiz</h4>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="order-form-section">
                            <form action="{{ route('new-quiz') }}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{ __('Category Name') }}</label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="" disabled selected>{{__('Select a Quiz Category')}}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Quiz Name')}}</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Image')}}</label>
                                        <input type="file" name="image" class="form-control" id="image" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Free or Paid')}}</label>
                                        <select name="paid_status" id="paid_status" class="form-control" required>
                                            <option selected value="0">{{ __('Free') }} </option>
                                            <option value="1">{{ __('Paid') }} </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Reward Point')}}</label>
                                        <input type="number" name="reward_point" class="form-control" placeholder="Reward Point" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Retake Point')}}</label>
                                        <input type="number" name="retake_point" class="form-control" placeholder="Retake Point" required>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label>{{__('Status')}}</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option selected value="1">{{ __('Published') }} </option>
                                            <option value="0">{{ __('Unpublished') }} </option>
                                        </select>
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
