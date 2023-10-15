@extends('layouts.master')

@section('title')
    {{ __('Music') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="table-header justify-content-end border-0 p-0">
                <div class="button-group nav">
                    <a href="#user-list" data-bs-toggle="tab" class="add-report-btn active"> {{ __('Music List') }}</a>
                    <a href="#user-add" data-bs-toggle="tab" class="add-report-btn"><i class="fas fa-plus-circle"></i> {{ __('Add Music') }}</a>
                </div>
            </div>
            <div class="tab-content order-summary-tab">
                <div class="tab-pane fade show active" id="user-list">
                    <div class="table-header">
                        <h4>Music List</h4>
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
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Artist') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audios as $audio)
                                    <tr>
                                        <td>{{ $audio->id }}</td>
                                        <td>{{ $audio->audio_title }}</td>
                                        <td>{{ $audio->artist_name }}</td>
                                        @if ($audio->status == 1)
                                            <td>Active</td>
                                        @else
                                            <td>Deactive</td>
                                        @endif
                                        <td>
                                            <a href="{{route('view-audio', $audio->id)}}" class="btn btn-sm btn-warning me-1">{{ __('View') }}</a>
                                            <a href="{{route('edit-audio', $audio->id)}}" class="btn btn-sm btn-primary text-white me-1">{{ __('Edit') }}</a>
                                            <a href="{{route('delete-audio', $audio->id)}}" class="confirm-action btn btn-sm btn-danger text-white" data-method="DELETE">{{ __('Delete') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $audios->links() }}
                </div>
                <div class="tab-pane fade" id="user-add">
                    <div class="table-header">
                        <h4>Add new music</h4>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-9">
                            <div class="order-form-section">
                                <form action="{{route('new-audio')}}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Name')}}</label>
                                            <input type="text" name="title" class="form-control" placeholder="Name" required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Image')}}</label>
                                            <input type="file" name="image" class="form-control" id="image">
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Artist')}}</label>
                                            <select name="artist" id="status" class="form-control  form-select" required>
                                                @foreach ($artists as $artist)
                                                    <option value="{{ $artist->id }}"> {{ $artist->artist_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Audio File')}}</label>
                                            <input type="file" name="audio" class="form-control" id="audio">
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
