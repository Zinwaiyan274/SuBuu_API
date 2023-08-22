@extends('layouts.master')

@section('title')
{{__('Reward Settings')}}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav">
                <a href="#reward-list" data-bs-toggle="tab" class="add-report-btn active"><i class="fas fa-list"></i>
                    &nbsp;
                    {{ __('Reward List') }}</a>
                <a href="#reward-add" data-bs-toggle="tab" class="add-report-btn"><i class="fas fa-plus-circle"></i>
                    &nbsp;
                    {{ __('Create new') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade show active" id="reward-list">
                <div class="table-header">
                    <h4>{{ __('Reward Settings') }}</h4>
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
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Reward Point') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rewards as $reward)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $reward->name }}</td>
                                    <td>{{ $reward->reward_point }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-item" type="checkbox"  name="status_{{$reward->id}}" id="status_{{$reward->id}}" value="{{$reward->status}}"  {{$reward->status==1?'checked':''}} data-id ="{{$reward->id}}" data-status="Reward" >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown table-action">
                                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                                <i class="far fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0)" class="edit-reward" data-id="{{ $reward->id }}"  data-name="{{ $reward->name }}" data-reward_point="{{ $reward->reward_point }}" data-status="{{ $reward->status }}">
                                                        <i class="fal fa-pencil-alt"></i>
                                                        {{ __('Edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="confirm-action" data-action="{{ route('reward.destroy', $reward->id) }}" data-method="DELETE">
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
                {{ $rewards->links() }}
            </div>
            <div class="tab-pane fade" id="reward-add">
                <div class="table-header">
                    <h4>{{ __('Add Rewards') }}</h4>
                </div>
                <div class="w-900 order-form-section">
                    <form action="{{ route('reward.store') }}" method="post" class="ajaxform_instant_reload">
                        @csrf

                        <div class="add-suplier-modal-wrapper">
                            <div class="row">
                                <div class="col-lg-6 mt-2">
                                    <label>{{ __('Name') }}</label>
                                    <select name="name" class="form-control" required>
                                        <option value="">{{__('Select')}}</option>
                                        <option value="Login">{{__('Login')}}</option>
                                        <option value="Refer">{{__('Refer')}}</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label>{{__('Reward Points')}}</label>
                                    <input type="number" name="reward_point" class="form-control" placeholder="Reward" required>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <label>{{ __("Status") }}</label>
                                    <select name="status" class="form-control table-select w-100 form-control">
                                        <option selected value="1">{{ __("Published") }}</option>
                                        <option value="0">{{ __("Unpublished") }}</option>
                                    </select>
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
</div>

<input type="hidden" id="url" value="{{ route('reward.index') }}">
@endsection

@section('modal')

<div class="modal fade" id="reward-edit">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">{{ __('Update Rewards') }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body order-form-section">
            <form action="" method="post" class="ajaxform_instant_reload edit-reward-form">
                @csrf
                @method('put')

                <div class="add-suplier-modal-wrapper">
                    <div class="row">
                        <div class="col-lg-12 mt-2">
                            <label>{{ __('Name') }}</label>
                            <select name="name" id="name" class="form-control" required>
                                <option value="">{{__('Select')}}</option>
                                <option value="Login">{{__('Login')}}</option>
                                <option value="Refer">{{__('Refer')}}</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label>{{__('Reward Points')}}</label>
                            <input type="number" name="reward_point" id="reward_point" class="form-control" placeholder="Reward" required>
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
