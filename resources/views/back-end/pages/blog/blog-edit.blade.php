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

        <div class="row justify-content-center">
            <div class="col-sm-9">
                <div class="order-form-section">
                    <form action="{{route('update-blog', $info->id)}}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div>
                                <img class="col-lg-4" src="{{ asset($info->cover_image) }}" alt="Image" width="400px">
                            </div>

                            <div class="col-lg-6 mt-2">
                                <label>{{ __('Category Name') }}</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="" disabled selected>{{__('Select Blog Category')}}</option>
                                    @foreach($categories as $category)
                                        <option @selected($category->id == $info->category_id) value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mt-2">
                                <label>Cover Image</label>
                                <input type="file" name="cover_image" class="form-control" id="cover-image" required>
                            </div>

                            <div class="col-lg-12 mt-2">
                                <label>{{__('Title')}}</label>
                                <input type="text" name="title" class="form-control" placeholder="Name" value="{{ $info->title }}" required>
                            </div>

                            <div class="col-lg-12 mt-2">
                                <label>{{__('Description')}}</label>
                                <textarea name="content" id="summernote">{{ $info->content }}</textarea>
                            </div>

                            <div class="col-lg-12">
                                <div class="button-group text-center mt-5">
                                    <a href="{{route('blog')}}" class="theme-btn border-btn m-2">{{ __('Cancel') }}</a>
                                    <button class="theme-btn m-2 submit-btn" type="submit">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
