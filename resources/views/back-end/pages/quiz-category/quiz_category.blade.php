@extends('layouts.master')

@section('title')
    {{__('Quiz categories')}}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav">
                <a href="#ctg-list" data-bs-toggle="tab" class="add-report-btn active">
                    {{ __('Quiz Categories List') }}
                </a>
                <a href="#ctg-add" data-bs-toggle="tab" class="add-report-btn"><i class="fas fa-plus-circle"></i>
                    {{ __('Create New') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade show active" id="ctg-list">
                <div class="table-header">
                    <h4>{{ __('Quiz categories List') }}</h4>
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
                                <th>{{ __('Icon') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img class="rounded-circle" height="35" width="35" src="{{ asset($category->image) }}" alt="">
                                    </td>
                                    <td>{{$category->name}}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-item" type="checkbox"  name="status_{{$category->id}}" id="status_{{$category->id}}" value="{{$category->status}}"  {{$category->status==1?'checked':''}} data-id ="{{$category->id}}" data-status="Quiz Category Status" >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown table-action">
                                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                class="">
                                                <i class="far fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('edit-quiz-category', ['id' => $category->id]) }}">
                                                        <i class="fal fa-pencil-alt"></i>
                                                        {{ __('Edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('delete-quiz-category',$category->id) }}" class="confirm-action" data-method="DELETE">
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
                {{ $categories->links() }}
            </div>
            <div class="tab-pane fade" id="ctg-add">
                <div class="table-header">
                    <h4>{{ __('Create quiz cateogry') }}</h4>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="modal-body order-form-section">
                            <form action="{{ route('new-quiz-category') }}" method="post" class="ajaxform_instant_reload" enctype="multipart/form-data">
                                @csrf

                                <div class="add-suplier-modal-wrapper">
                                    <div class="row">
                                        <div class="col-lg-6 mt-2">
                                            <label>{{ __('Name') }}</label>
                                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>Icon</label>
                                            <input type="file" name="image" class="form-control" id="image" required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>Status</label>
                                            <select name="status" class="form-control table-select w-100 form-control">
                                                <option selected value="1">Published</option>
                                                <option value="0">Unpublished</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{ __('Description') }}</label>
                                            <textarea cols="30" name="description" rows="2" class="form-control" spellcheck="false"></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="button-group text-center mt-5">
                                                <a href="" class="theme-btn border-btn m-2">Cancel</a>
                                                <button class="theme-btn m-2 submit-btn">Save</button>
                                            </div>
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


