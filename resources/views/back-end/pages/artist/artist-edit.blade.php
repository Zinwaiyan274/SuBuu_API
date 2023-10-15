@extends('layouts.master')

@section('title')
    {{ __('Artist') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid mb-1">
            <div class="table-header justify-content-end border-0 p-0">
                <a href="{{route('artist')}}" class="btn btn-secondary text-white">Back To List</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-9">
                <div class="order-form-section">
                    <form action="{{route('update-artist', $artist->id)}}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $artist->artist_name }}" required>
                            </div>

                            <div class="col-lg-6 mt-2">
                                <label>{{__('Status')}}</label>
                                <select name="status" id="status" class="form-control  form-select" required>
                                    <option value=""> {{ __('Select') }} </option>
                                    @if ($artist->status == 1)
                                        <option value="1" selected>{{ __('Active') }} </option>
                                        <option value="0">{{ __('Deactive') }} </option>
                                    @elseif ($artist->status == 0)
                                        <option value="1">{{ __('Active') }} </option>
                                        <option value="0" selected>{{ __('Deactive') }} </option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-lg-12 mt-2">
                                <img src="{{ asset('artist_image/' . $artist->image) }}" alt="Image" width="500">
                            </div>

                            <div class="col-lg-12 mt-2">
                                <label>{{__('Image')}}</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>

                            <div class="col-lg-12">
                                <div class="button-group text-center mt-5">
                                    <a href="{{route('artist')}}" class="theme-btn border-btn m-2">{{ __('Cancel') }}</a>
                                    <button class="theme-btn m-2 submit-btn" type="submit">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
