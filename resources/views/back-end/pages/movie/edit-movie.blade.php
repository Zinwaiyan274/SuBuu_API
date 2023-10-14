@extends('layouts.master')

@section('title')
    Update Movie
@endsection

@section('main_content')
    <div class="erp-state-overview-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="erp-dashboard-profile-section card">
                        <div class="table-header">
                            <h4>Update Movie</h4>
                        </div>
                        <form action="{{ route('update-movie', ['id' => $movie_info->id]) }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 mt-3">
                                    <label>Title</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" name="title" class="form-control" value="{{ $movie_info->title }}"
                                        required>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label>URL</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="text" name="url" class="form-control" value="{{ $movie_info->url }}"
                                        required>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label>Category</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                        <select name="category_id[]" class="form-control" multiple required>
                                            <option value="" disabled selected>{{__('Select Movie Category')}}</option>
                                            @foreach($categories as $category)
                                                <option @selected(in_array($category->id , $movie_categories)) value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label>Thumbnail</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <input type="file" name="thumbnail" class="form-control" value="{{ $movie_info->thumbnail }}">
                                </div>
                                <div class="col-lg-4 mt-3">
                                    <label>Description</label>
                                </div>
                                <div class="col-lg-8 mt-3">
                                    <textarea name="description" class="form-control"
                                        required>
                                        {{ $movie_info->description}}
                                    </textarea>
                                </div>
                                <div class="col-lg-12 mt-5">
                                    <button class="theme-btn submit-btn">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('/back-end/css/image-preview.css') }}">
@endpush
