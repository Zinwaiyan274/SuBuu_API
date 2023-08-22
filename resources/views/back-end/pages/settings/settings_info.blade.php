@extends('layouts.master')

@section('title')
    {{ __('Website Settings') }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('/back-end/css/image-preview.css')}}">
@endpush

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid"><br>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade active show" id="add-new-petty" role="tabpanel">
                <div class="table-header">
                    <h4>{{ __('Website Settings') }}</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-12">
                        <div class="order-form-section">
                            <form action="{{ route('update-settings', ['id' => $info->id]) }}" method="post" class="ajaxform_instant_reload" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Title')}}</label>
                                        <input type="text" name="title" class="form-control" value="{{ $info->title }}" required>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <label>{{__('Name')}}</label>
                                        <input type="text" name="name" class="form-control" value="{{ $info->name }}" required>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mt-2">
                                        <label>{{__('Favicon')}} <small class="text-warning">{{ __('( favicon max size 50 x 50 )') }}</small></label>
                                        <div class="form-input">
                                            <div class="preview">
                                                <img src="{{ asset($info->favicon) }}" id="file-ip-1-preview">
                                            </div>
                                            <label class="left-0" for="favicon">{{__('Upload Favicon')}}</label>
                                            <input type="file" name="favicon" id="favicon" accept="image/*" onchange="showPreview(event);">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mt-2">
                                        <label>{{__('Frontend Logo')}} <small class="text-warning">{{ __('( logo max size 200 x 200 )') }}</small></label>
                                        <div class="form-input">
                                            <div class="preview">
                                                <img src="{{ asset($info->header_logo) }}" id="file-ip-2-preview">
                                            </div>
                                            <label class="left-0" for="header_logo">{{__('Upload Logo')}}</label>
                                            <input type="file" name="header_logo" id="header_logo" accept="image/*" onchange="showPreviewHeaderLogo(event);">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mt-2">
                                        <label>{{__('Admin Logo')}} <small class="text-warning">{{ __('( logo max size 200 x 200 )') }}</small></label>
                                        <div class="form-input">
                                            <div class="preview">
                                                <img src="{{ asset($info->footer_logo) }}" id="file-ip-3-preview">
                                            </div>
                                            <label class="left-0" for="footer_logo">{{__('Upload Logo')}}</label>
                                            <input type="file" name="footer_logo" id="footer_logo" accept="image/*" onchange="showPreviewFooterLogo(event);">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <label>{{__('Content')}}</label>
                                        <textarea name="content" class="form-control">{{ $info->content }}</textarea>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="button-group text-center mt-5">
                                            <button type="reset" class="theme-btn border-btn m-2">{{ __('Reset') }}</button>
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

@push('js')
    <script src="{{ asset('back-end/js/image-preview.js') }}"></script>
@endpush
