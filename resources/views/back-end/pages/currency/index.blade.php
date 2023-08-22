@extends('layouts.master')

@section('title')
{{__('Currency list')}}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav">
                <a href="#currency-list" data-bs-toggle="tab" class="add-report-btn active"><i class="fas fa-list"></i>
                    &nbsp;
                    {{ __('Currency List') }}</a>
                <a href="#currency-add" data-bs-toggle="tab" class="add-report-btn"><i class="fas fa-plus-circle"></i>
                    &nbsp;
                    {{ __('Create new') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade show active" id="currency-list">
                <div class="table-header">
                    <h4>{{ __('Currency List') }}</h4>
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
                                <th>{{__('#')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('ISO')}}</th>
                                <th>{{__('Symbol')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($currencies as $currency)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$currency->name}}</td>
                                    <td>{{$currency->iso_code}}</td>
                                    <td>{{$currency->symbol}}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-item" type="checkbox"  name="status_{{$currency->id}}" id="status_{{$currency->id}}" value="{{$currency->status}}"  {{$currency->status==1?'checked':''}} data-id="{{$currency->id}}" data-status="Currency Status">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown table-action">
                                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                                <i class="far fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="edit-currency" data-id="{{ $currency->id }}" data-name="{{ $currency->name }}" data-iso_code="{{ $currency->iso_code }}" data-symbol="{{ $currency->symbol }}" data-status="{{ $currency->status }}" href="javascript:void(0)"><i class="fal fa-pencil-alt"></i> {{ __('Edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('currency.destroy',$currency->id) }}" class="confirm-action" data-method="DELETE">
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
                {{ $currencies->links() }}
            </div>
            <div class="tab-pane fade" id="currency-add">
                <div class="table-header">
                    <h4>{{ __('Create new currency') }}</h4>
                </div>
                <div class="order-form-section w-900">
                    <form action="{{ route('currency.store') }}" method="post" class="ajaxform_instant_reload" enctype="multipart/form-data">
                        @csrf

                        <div class="add-suplier-modal-wrapper">
                            <div class="row">
                                <div class="col-lg-6 mt-2">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label>{{ __('ISO Code') }}</label>
                                    <input type="text" name="iso_code" class="form-control" placeholder="Enter iso code" requiredrequired>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label>{{__('Symbol')}}</label>
                                    <input type="text"  name="symbol" class="form-control" placeholder="Enter symbol" >
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label>Status</label>
                                    <select name="status" class="form-control table-select w-100 form-control" required>
                                        <option selected value="1">Published</option>
                                        <option value="0">Unpublished</option>
                                    </select>
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
<input type="hidden" id="url" value="{{ route('currency.index') }}">
@endsection

@section('modal')

<div class="modal fade" id="edit-currency">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">{{ __('Update currency') }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body order-form-section">
            <form action="" method="post" class="ajaxform_instant_reload edit-currency-form">
                @csrf
                @method('put')

                <div class="add-suplier-modal-wrapper">
                    <div class="row">
                        <div class="col-lg-12 mt-2">
                            <label>{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label>{{ __('ISO Code') }}</label>
                            <input type="text" name="iso_code" id="iso_code" class="form-control" placeholder="Enter iso code" required>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label>{{__('Symbol')}}</label>
                            <input type="text"  name="symbol" id="symbol" class="form-control" placeholder="Enter symbol" required>
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
@endsection
