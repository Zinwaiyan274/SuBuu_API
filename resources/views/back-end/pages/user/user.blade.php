@extends('layouts.master')

@section('title')
    {{ __('Users') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="table-header justify-content-end border-0 p-0">
                <div class="button-group nav">
                    <a href="#user-list" data-bs-toggle="tab" class="add-report-btn active"> {{ __('User List') }}</a>
                    <a href="#user-add" data-bs-toggle="tab" class="add-report-btn"><i class="fas fa-plus-circle"></i> {{ __('Add User') }}</a>
                </div>
            </div>
            <div class="tab-content order-summary-tab">
                <div class="tab-pane fade show active" id="user-list">
                    <div class="table-header">
                        <h4>Users List</h4>
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
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Refer Code') }}</th>
                                    <th>{{ __('Point') }}</th>
                                    <th>{{ __('Refer By') }}</th>
                                    <th>{{ __('User Type') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <img class="rounded-circle" height="40" width="40" src="{{ asset($user->image ?? '/back-end/img/profile/avatar.jpg') }}" alt="user image">
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->refer_code }}</td>
                                        <td>
                                            @if ($user->total_point)
                                                {{ $user->total_point }}
                                            @endif
                                        </td>
                                        <td>{{ $user->refer }}</td>
                                        <td>{{ $user->user_type }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input status-item" type="checkbox"  name="status_{{$user->id}}" id="status_{{$user->id}}" value="{{$user->status}}"  {{$user->status==1?'checked':''}} data-id ="{{$user->id}}" data-status="User Status" >
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
                                                        <a href="{{ route('edit-user', $user->id) }}">
                                                            <i class="fal fa-pencil-alt"></i> {{ __('Edit') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('delete-user',$user->id) }}" class="confirm-action" data-method="DELETE">
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
                    {{ $users->links() }}
                </div>
                <div class="tab-pane fade" id="user-add">
                    <div class="table-header">
                        <h4>Create new user</h4>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-9">
                            <div class="order-form-section">
                                <form action="{{route('new-user')}}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Name')}}</label>
                                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Email')}}</label>
                                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Phone')}}</label>
                                            <input type="number" name="phone" class="form-control" placeholder="Phone">
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Password')}}</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Image')}}</label>
                                            <input type="file" name="image" class="form-control" id="image">
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Balance')}}</label>
                                            <input type="number" name="balance" step="any" class="form-control" placeholder="Balance">
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Refer By')}}</label>
                                            <input type="text" name="refer" class="form-control" placeholder="Refer">
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('User Type')}}</label>
                                            <select name="user_type" id="user_type" class="form-control form-select" required>
                                                <option value=""> {{ __('Select') }} </option>
                                                <option value="Admin"> {{ __('Admin') }} </option>
                                                <option value="Manager"> {{ __('Manager') }} </option>
                                                <option value="User"> {{ __('User') }} </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <label>{{__('Status')}}</label>
                                            <select name="status" id="status" class="form-control  form-select" required>
                                                <option value=""> {{ __('Select') }} </option>
                                                <option value="1">{{ __('Active') }} </option>
                                                <option value="0">{{ __('Deactive') }} </option>
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
