@extends('layouts.master')

@section('title')
    {{__('Update blog category')}}
@endsection

@section('main_content')
<div class="erp-table-section">
    <div class="container-fluid">
        <div class="table-header justify-content-end border-0 p-0">
            <div class="button-group nav" role="tablist">
                <a href="{{ route('game') }}" class="add-report-btn active">
                    <i class="fas fa-list"></i> &nbsp;
                    {{ __('View List') }}
                </a>
            </div>
        </div>
        <div class="tab-content order-summary-tab">
            <div class="tab-pane fade active show" id="add-new-petty" role="tabpanel">
                <div class="table-header">
                    <h4>Update game</h4>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="order-form-section">
                            <form action="{{route('update-game',['id'=> $info->id])}}" method="post" class="add-brand-form ajaxform_instant_reload" enctype="multipart/form-data">
                                @csrf
                                <div class="add-suplier-modal-wrapper">
                                    <div class="row">
                                        <div class="col-lg-6 mt-2">
                                            <label>{{__('Title')}}</label>
                                            <input type="text" name="title" class="form-control" placeholder="Name" value="{{$info->title}}" required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>Hero Image</label>
                                            <input type="file" name="hero_image" class="form-control" id="hero_image" required>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>Status</label>
                                            <select name="status" class="form-control table-select w-100 form-control">
                                                <option @selected($info->status == 1) value="1">Published</option>
                                                <option @selected($info->status == 0) value="0">Unpublished</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <label>Cover Image</label>
                                            <input type="file" name="cover_image" class="form-control" id="cover-image" required>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <label>{{__('Game Link')}}</label>
                                            <input type="text" name="game_link" class="form-control" placeholder="Game link" value="{{ $info->game_link }}" required>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="button-group text-center mt-5">
                                                <button type="reset" class="theme-btn border-btn m-2">{{ __('Reset') }}</button>
                                                <button class="theme-btn m-2 submit-btn" type="submit">{{ __('Save') }}</button>
                                            </div>
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

