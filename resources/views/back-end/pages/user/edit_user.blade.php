@extends('layouts.master')

@section('title')
    {{ __('Update Profile') }}
@endsection

@section('main_content')
    <div class="erp-state-overview-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="erp-dashboard-profile-section card">
                        <div class="table-header">
                            <h4>{{ __('Update profile') }}</h4>
                        </div>
                        <form action="{{ route('update-user', ['id' => $info->id]) }}" method="post" class="add-brand-form ajaxform_instant_reload" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 mt-3">
                                    <label>{{ __('Name') }}</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" name="name" class="form-control" value="{{ $info->name }}" required>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label>{{ __('Email') }}</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="email" name="email" class="form-control" value="{{ $info->email }}" required>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label>{{ __('User Type') }}</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <select name="user_type" id="user_type" class="form-control" required>
                                        <option value=""> {{ __('Select') }} </option>
                                        <option value="Admin" @selected($info->user_type == 'Admin')>
                                            {{ __('Admin') }} </option>
                                        <option value="Manager" @selected($info->user_type == 'Manager')>
                                            {{ __('Manager') }} </option>
                                        <option value="User" @selected($info->user_type == 'User')>
                                            {{ __('User') }} </option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label>{{ __('Status') }}</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <select name="status" id="status" class="form-control" required>
                                        <option value=""> {{ __('Select') }} </option>
                                        <option value="1" @selected($info->status == 1)>{{ __('Active') }} </option>
                                        <option value="0" @selected($info->status == 0)>{{ __('Deactive') }} </option>
                                    </select>
                                </div>

                                <div class="col-lg-4 mt-3">
                                    <label>{{ __('Balance') }}</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="number" name="balance" class="form-control" step="any" value="{{ optional($info->wallet)->balance ?? 0 }}">
                                </div>

                                <div class="col-lg-4 mt-3">
                                    <label>{{ __('Refer By') }}</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" name="refer" class="form-control" value="{{ $info->refer }}" placeholder="Reference">
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label>{{ __('Phone') }}</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" name="phone" class="form-control" value="{{ $info->phone }}" required placeholder="Enter your phone">
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label>{{ __('Profile Picture') }}</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                                @if ($info->user_type == 'Admin')
                                <div class="col-lg-4 mt-3">
                                    <label>{{ __('Current Password') }}</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="password" class="form-control" placeholder="Enter Your Current Password" name="old_password">
                                </div>
                                @endif
                                <div class="col-lg-4 mt-3">
                                    <label>{{ __('Password') }}</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="password" class="form-control" placeholder="Enter Your Password" name="password">
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label>{{ __('Confirm password') }}</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="password" class="form-control" placeholder="Enter Your Confirm password" name="password_confirmation">
                                </div>
                                <div class="col-lg-12 mt-5">
                                    <button class="theme-btn submit-btn">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="erp-dashboard-profile card">
                        <div class="profile-img">
                            <img id="profile_picture" src="{{ asset($info->image ?? '/back-end/img/icon/user.png') }}" alt="user avatar">
                        </div>
                        <div class="profile-details card-body">
                            <ul class="list-group">
                                <li class="list-group-item"><span>{{ __('Name') }} : </span>{{ $info->name }}</li>
                                <li class="list-group-item"><span>{{ __('Email') }} : </span>{{ $info->email }}</li>
                                <li class="list-group-item">{{ __('Balance') }} : {{ optional($info->wallet)->balance ?? 0 }}</li>
                                <li class="list-group-item">{{ __('Registration Date') }} : {{ formatted_date($info->created_at) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('/back-end/css/image-preview.css') }}">
@endpush
