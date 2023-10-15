@extends('layouts.master')

@section('title')
    {{ __('Artist') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid mb-3">
            <div class="table-header justify-content-end border-0 p-0">
                <a href="{{route('artist')}}" class="btn btn-secondary text-white">Back To List</a>
            </div>
        </div>

        <div class="container border rounded-2 py-2">
            <h1 class="border-0 border-bottom mb-3 pb-2">{{ $artist->artist_name }}</h1>

            <img src="{{ asset('artist_image/' . $artist->image) }}" alt="Image" width="500">
        </div>
    </div>
@endsection
