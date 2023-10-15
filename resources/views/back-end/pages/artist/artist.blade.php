@extends('layouts.master')

@section('title')
    {{ __('Artist') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="table-header justify-content-end border-0 p-0">
                <div class="button-group nav">
                    <a href="#user-list" data-bs-toggle="tab" class="add-report-btn active"> {{ __('Artist List') }}</a>
                    <a href="#user-add" data-bs-toggle="tab" class="add-report-btn"><i class="fas fa-plus-circle"></i> {{ __('Add Artist') }}</a>
                </div>
            </div>
            <div class="tab-content order-summary-tab">
                <div class="tab-pane fade show active" id="user-list">
                    <div class="table-header">
                        <h4>Artist List</h4>
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
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($artists as $artist)
                                    <tr>
                                        <td>{{ $artist->id }}</td>
                                        <td>{{ $artist->artist_name }}</td>
                                        @if ($artist->status == 1)
                                            <td>Active</td>
                                        @else
                                            <td>Deactive</td>
                                        @endif
                                        <td>
                                            <a href="{{route('view-artist', $artist->id)}}" class="btn btn-sm btn-warning me-1">{{ __('View') }}</a>
                                            <a href="{{route('edit-artist', $artist->id)}}" class="btn btn-sm btn-primary text-white me-1">{{ __('Edit') }}</a>
                                            <a href="{{route('delete-artist', $artist->id)}}" class="confirm-action btn btn-sm btn-danger text-white" data-method="DELETE">{{ __('Delete') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $artists->links() }}
                </div>
                <div class="tab-pane fade" id="user-add">
                    <div class="table-header">
                        <h4>Add new music</h4>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-9">
                            <div class="order-form-section">
                                <form action="{{route('new-artist')}}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Name')}}</label>
                                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Image')}}</label>
                                            <input type="file" name="image" class="form-control" id="image">
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
                                                <button type="submit" class="theme-btn m-2 submit-btn">{{ __('Save') }}</button>
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
