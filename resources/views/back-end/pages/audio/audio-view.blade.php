@extends('layouts.master')

@section('title')
    {{ __('Audio') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid mb-3">
            <div class="table-header justify-content-end border-0 p-0">
                <a href="{{route('audio')}}" class="btn btn-secondary text-white">Back To List</a>
            </div>
        </div>

        <div class="container row border rounded-2 py-2">
            <div class="col-lg-6">
                <h1 class="border-0 mb-1 pb-2">Music Title</h1>
                <h3 class="border-0 border-bottom mb-3 pb-2">{{ $audio->audio_title }}</h3>
            </div>

            <div class="col-lg-6">
                <h1 class="border-0 mb-1 pb-2">Artist Name</h1>
                <h3 class="border-0 border-bottom mb-3 pb-2">{{ $artist->artist_name }}</h3>
            </div>

            <div class="col-lg-12">
                <img src="{{ asset('audio_cover/' . $audio->image) }}" alt="Image" width="500">
            </div>
        </div>
    </div>
@endsection
