@extends('layouts.master')

@section('title')
{{__('Withdraw methods list')}}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav">
                <a href="#withdraw-list" data-bs-toggle="tab" class="add-report-btn active"><i class="fas fa-list"></i>
                    {{ __('Question List') }}</a>
                <a href="#withdraw-add" data-bs-toggle="tab" class="add-report-btn "><i class="fas fa-plus-circle"></i>
                    {{ __('Create new') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade show active" id="withdraw-list">
                <div class="table-header">
                    <h4>{{ __('Withdraw methods List') }}</h4>
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
                                <th>{{__('SL')}}</th>
                                <th>{{__('Image')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Minimum Amount')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($methods as $method)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img height="45" width="45" class="rounded-circle" src="{{ asset($method->image) }}" alt="{{ asset($method->image) }}">
                                    </td>
                                    <td>{{$method->name}}</td>
                                    <td>{{$method->minimum_amount}}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-item" type="checkbox"  name="status_{{$method->id}}" id="status_{{$method->id}}" value="{{$method->status}}"  {{$method->status==1?'checked':''}} data-id ="{{$method->id}}" data-status="Method Status" >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown table-action">
                                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                class="">
                                                <i class="far fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('edit-withdraw-method', ['id' => $method->id]) }}"><i class="fal fa-pencil-alt"></i> {{ __('Edit') }} </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('delete-withdraw-method',$method->id) }}" class="confirm-action" data-method="DELETE">
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
                {{ $methods->links() }}
            </div>
            <div class="tab-pane fade" id="withdraw-add">
                <div class="table-header">
                    <h4>{{ __('Create withdraw method') }}</h4>
                </div>
                <div class="order-form-section w-800">
                    <form action="{{ route('new-withdraw-method') }}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label>{{__('Minimum Amount')}}</label>
                                <input type="number" name="minimum_amount" step="any" class="form-control" placeholder="Minimum Amount" required>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label>{{__('Status')}}</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option selected value="1">{{ __('Published') }} </option>
                                    <option value="0">{{ __('Unpublished') }} </option>
                                </select>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label>{{__('Image')}}</label>
                                <input type="file" name="image" class="form-control" id="image" required>
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

