@extends('layouts.master')

@section('title')
    Movies
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="table-header justify-content-end border-0 p-0">
                <div class="button-group nav">
                    <a href="#user-list" data-bs-toggle="tab" class="add-report-btn active">Movies</a>
                    <a href="#user-add" data-bs-toggle="tab" class="add-report-btn">Add Movie</a>
                </div>
            </div>
            <div class="tab-content order-summary-tab">
                <div class="tab-pane fade show active" id="user-list">
                    <div class="table-header">
                        <h4>Movies List</h4>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <form action="">
                                <div class="input-group w-280">
                                    <input type="text" class="form-control rounded-0" placeholder="Searching..."
                                        aria-describedby="basic-addon2" name="search" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button
                                            class="input-group-text btn btn-warning rounded-0 rounded-end">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="responsive-table">
                        <table class="table" id="erp-table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>URL</th>
                                    <th>Thumbnail</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $movie)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $movie->title }}</td>
                                        <td>{{ $movie->description }}</td>
                                        <td>{{ $movie->movieCategory->name }}</td>
                                        <td>{{ $movie->url }}</td>
                                        <td>
                                            <img class="rounded-circle" height="35" width="35"
                                                src="{{ asset($movie->thumbnail) }}" alt="thumbnail">
                                        </td>
                                        <td>{{ $movie->created_at->format('d-M-Y h:i:s') }} </td>
                                        <td>
                                            <div class="dropdown table-action">
                                                <button type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                    class="">
                                                    <i class="far fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('edit-movie', $movie->id) }}">
                                                            <i class="fal fa-pencil-alt"></i> {{ __('Edit') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('delete-movie', $movie->id) }}"
                                                            class="confirm-action" data-method="DELETE">
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
                    {{ $movies->links() }}
                </div>
                <div class="tab-pane fade" id="user-add">
                    <div class="table-header">
                        <h4>Create new movies</h4>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-9">
                            <div class="order-form-section">
                                <form action="{{ route('new-movie') }}" method="post"
                                    class="add-brand-form ajaxform_instant_reload" id="add-brand-form"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-lg-6 mt-2">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control" placeholder="Title"
                                                required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>URL</label>
                                            <input type="text" name="url" class="form-control" placeholder="URL"
                                                required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>Thumbnail</label>
                                            <input type="file" name="thumbnail" class="form-control" placeholder="URL"
                                                required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>Category</label>
                                            <select name="category_id" class="form-control" required>
                                                @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" required>
                                            </textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="button-group text-center mt-5">
                                                <button type="reset"
                                                    class="theme-btn border-btn m-2">{{ __('Reset') }}</button>
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
