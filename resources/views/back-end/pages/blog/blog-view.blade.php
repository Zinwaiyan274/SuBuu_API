@extends('layouts.master')

@section('title')
    {{ __('Blogs') }}
@endsection

@section('main_content')
    <div class="erp-table-section container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav" role="tablist">
                <a href="{{ route('blog') }}" class="add-report-btn active">
                    <i class="fas fa-list"></i> &nbsp;
                    {{ __('View List') }}
                </a>
            </div>
        </div>

        <div class="container border rounded-2 py-2 mt-4">
            <h1 class="border-0 border-bottom mb-3 pb-2">{{ $title }}</h1>

            <div>{!! $content !!}</div>
        </div>
    </div>
@endsection
