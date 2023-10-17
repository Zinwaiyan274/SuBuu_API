@extends('layouts.master')

@section('title')
    {{ __('Blogs') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="table-header justify-content-end border-0 p-0">
                <div class="button-group nav">
                    <a href="#user-list" data-bs-toggle="tab" class="add-report-btn active"> {{ __('Blog List') }}</a>
                    <a href="#user-add" data-bs-toggle="tab" class="add-report-btn"><i class="fas fa-plus-circle"></i> {{ __('Add Blog') }}</a>
                </div>
            </div>
            <div class="tab-content order-summary-tab">
                <div class="tab-pane fade show active" id="user-list">
                    <div class="table-header">
                        <h4>Blogs List</h4>
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
                                    <th>{{ __('SL') }}</th>
                                    <th>{{ __('Category Name') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Created Date') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $post->blogCategory->name }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>
                                            <a href="{{route('view-blog', $post->id)}}" class="btn btn-sm btn-warning me-1">{{ __('View') }}</a>
                                            <a href="{{route('edit-blog', $post->id)}}" class="btn btn-sm btn-primary text-white me-1">{{ __('Edit') }}</a>
                                            <a href="{{route('delete-blog', $post->id)}}" class="confirm-action btn btn-sm btn-danger text-white" data-method="DELETE">{{ __('Delete') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $posts->links() }}
                </div>
                <div class="tab-pane fade" id="user-add">
                    <div class="table-header">
                        <h4>Create new post</h4>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-9">
                            <div class="order-form-section">
                                c
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 mt-2">
                                            <label>{{ __('Category Name') }}</label>
                                            <select name="category_id" class="form-control" required>
                                                <option value="" disabled selected>{{__('Select Blog Category')}}</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-12 mt-2">
                                            <label>{{__('Title')}}</label>
                                            <input type="text" name="title" class="form-control" placeholder="Name" required>
                                        </div>

                                        <div class="col-lg-12 mt-2">
                                            <label>{{__('Description')}}</label>
                                            <textarea name="content" id="summernote"></textarea>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="button-group text-center mt-5">
                                                <button type="reset" class="theme-btn border-btn m-2">{{ __('Reset') }}</button>
                                                <button class="theme-btn m-2 submit-btn" type="submit">{{ __('Save') }}</button>
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

    {{-- scripts  --}}
    @push('js')
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    minHeight: 500,
                    maxHeight: 800,
                });
            });
        </script>
    @endpush
@endsection
