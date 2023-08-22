@extends('layouts.master')

@section('title')
{{__('Currency convert')}}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav">
                <a href="#currency-list" data-bs-toggle="tab" class="add-report-btn active"><i class="fas fa-list"></i>
                    &nbsp;
                    {{ __('Currency Convert List') }}</a>
                <a href="#currency-add" data-bs-toggle="tab" class="add-report-btn"><i class="fas fa-plus-circle"></i>
                    &nbsp;
                    {{ __('Create new') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade show active" id="currency-list">
                <div class="table-header">
                    <h4>{{ __('Currency convert') }}</h4>
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
                                <th>{{__('Per Currency')}}</th>
                                <th>{{__('Coin')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($currencyConverts as $currencyConvert)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($currencyConvert->currency)->name }}</td>
                                    <td>{{ $currencyConvert->par_currency }}</td>
                                    <td>{{ $currencyConvert->coin }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-item" type="checkbox"  name="status_{{$currencyConvert->id}}" id="status_{{$currencyConvert->id}}" value="{{$currencyConvert->status}}"  {{$currencyConvert->status==1?'checked':''}} data-id ="{{$currencyConvert->id}}" data-status="Currency Convert Status" >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown table-action">
                                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                                <i class="far fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="edit-convert" data-id="{{ $currencyConvert->id }}" data-currency-id="{{ $currencyConvert->currency_id }}" data-per-currency="{{ $currencyConvert->par_currency }}" data-coin="{{ $currencyConvert->coin }}" href="javascript:void(0)"><i class="fal fa-pencil-alt"></i> {{ __('Edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('currency-convert.destroy',$currencyConvert->id) }}" class="confirm-action" data-method="DELETE">
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
                {{ $currencyConverts->links() }}
            </div>
            <div class="tab-pane fade" id="currency-add">
                <div class="table-header">
                    <h4>{{ __('Add Currency Convert') }}</h4>
                </div>
                <div class="order-form-section w-900">
                    <form action="{{route('currency-convert.store')}}" method="post" class="ajaxform_instant_reload">
                        @csrf

                        <div class="add-suplier-modal-wrapper">
                            <div class="row">
                                <div class="col-lg-6 mt-2">
                                    <label>{{ __('Currency Name') }}</label>
                                    <select name="currency_id" class="form-control" required>
                                        <option value=""> {{ __('select') }} </option>
                                        @foreach($currencies as $currency)
                                        <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label>{{ __('Per Currency') }}</label>
                                    <input type="number" name="par_currency" class="form-control" placeholder="Enter currency" required>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <label>{{__('Coin')}}</label>
                                    <input type="number" name="coin" class="form-control" placeholder="Enter coin" required>
                                </div>

                                <div class="col-lg-12">
                                    <div class="button-group text-center mt-5">
                                        <button class="theme-btn border-btn m-2" type="reset">{{ __('Reset') }}</button>
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

<input type="hidden" id="url" value="{{ route('currency-convert.index') }}">
@endsection

@section('modal')

<div class="modal fade" id="convert-edit">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">{{ __('Update currency convert') }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body order-form-section">
            <form action="" method="post" class="ajaxform_instant_reload edit-convert-form">
                @csrf
                @method('put')

                <div class="add-suplier-modal-wrapper">
                    <div class="row">
                        <div class="col-lg-12 mt-2">
                            <label>{{ __('Currency Name') }}</label>
                            <select name="currency_id" id="currency_id" class="form-control" required>
                                <option value=""> {{ __('select') }} </option>
                                @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label>{{ __('Per Currency') }}</label>
                            <input type="number" name="par_currency" id="per_currency" class="form-control" placeholder="Enter currency" required>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label>{{__('Coin')}}</label>
                            <input type="number" name="coin" id="coin" class="form-control" placeholder="Enter coin" required>
                        </div>

                        <div class="col-lg-12">
                            <div class="button-group text-center mt-5">
                                <button class="theme-btn border-btn m-2" type="reset">{{ __('Reset') }}</button>
                                <button class="theme-btn m-2 submit-btn">{{ __('Save') }}</button>
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
