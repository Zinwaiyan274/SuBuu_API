@extends('layouts.master')

@section('title')
    {{ __('Blogs') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid mb-1">
            <div class="table-header justify-content-end border-0 p-0">
                <a href="{{route('blog')}}" class="btn btn-secondary text-white">Back To List</a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-9">
                <div class="order-form-section">
                    <form action="{{route('update-blog', $id)}}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 mt-2">
                                <label>{{__('Title')}}</label>
                                <input type="text" name="title" class="form-control" placeholder="Name" value="{{ $title }}" required>
                            </div>

                            <div class="col-lg-12 mt-2">
                                <label>{{__('Description')}}</label>
                                <textarea name="content" id="summernote">{{ $content }}</textarea>
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
