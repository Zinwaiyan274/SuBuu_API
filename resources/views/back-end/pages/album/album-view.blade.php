@extends('layouts.master')

@section('title')
    {{ __('Album') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid mb-3">
            <div class="table-header justify-content-end border-0 p-0">
                <a href="{{route('album')}}" class="btn btn-secondary text-white">Back To List</a>
            </div>
        </div>

        <div class="row container border rounded-2 py-2">
            <div class="col-lg-6">
                <div class="col-lg-12 border-0 border-bottom">
                    <h1 class="border-0 mb-1 pb-2">Album Name</h1>
                    <h3 class="mb-1">{{ $album->album_name }}</h3>
                </div>

                <div class="col-lg-12 mt-2 border-0 border-bottom">
                    <h1 class="border-0 mb-1 pb-2">Music List</h1>
                    @foreach ($songLists as $data)
                        <h3 class="">{{ $data->audio_title }}</h3>
                    @endforeach
                </div>
            </div>

            <img class="col-lg-6" src="{{ asset('album_cover/' . $album->image) }}" alt="Image" width="500">
        </div>
    </div>
@endsection
