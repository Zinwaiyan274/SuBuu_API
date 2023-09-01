@extends('layouts.master')

@section('title')
    {{ __('Blogs') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid mb-3">
            <div class="table-header justify-content-end border-0 p-0">
                <a href="{{route('blog')}}" class="btn btn-secondary text-white">Back To List</a>
            </div>
        </div>

        <div class="container border rounded-2 py-2">
            <h1 class="border-0 border-bottom mb-3 pb-2">{{ $title }}</h1>

            <div>{!! $content !!}</div>
        </div>
    </div>
@endsection
