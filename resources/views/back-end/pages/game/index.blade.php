@extends('layouts.master')

@section('title')
    {{ __('Games') }}
@endsection

@section('main_content')
    <div class="erp-table-section">
        <div class="container-fluid">
            <div class="table-header justify-content-end border-0 p-0">
                <div class="button-group nav">
                    <a href="#user-list" data-bs-toggle="tab" class="add-report-btn active"> {{ __('Game List') }}</a>
                    <a href="#user-add" data-bs-toggle="tab" class="add-report-btn"><i class="fas fa-plus-circle"></i> {{ __('Add Game') }}</a>
                </div>
            </div>
            <div class="tab-content order-summary-tab">
                <div class="tab-pane fade show active" id="user-list">
                    <div class="table-header">
                        <h4>Games List</h4>
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
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Hero Image') }}</th>
                                    <th>{{__('Cover Image')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{ __('Created Date') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($games as $game)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $game->title }}</td>
                                        <td><img class="rounded-circle" height="35" width="35" src="{{ asset($game->hero_image) }}" alt=""></td>
                                        <td><img class="rounded" height="35" width="35" src="{{ asset($game->cover_image) }}" alt=""></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input status-item" type="checkbox"  name="status_{{$game->id}}" id="status_{{$game->id}}" value="{{$game->status}}"  {{$game->status==1?'checked':''}} data-id ="{{$game->id}}" data-status="Game Status" >
                                            </div>
                                        </td>
                                        <td>{{ $game->created_at }}</td>
                                        <td>
                                            <a href="{{route('edit-game', $game->id)}}" class="btn btn-sm btn-primary text-white me-1">{{ __('Edit') }}</a>
                                            <a href="{{route('delete-game', $game->id)}}" class="confirm-action btn btn-sm btn-danger text-white" data-method="DELETE">{{ __('Delete') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $games->links() }}
                </div>
                <div class="tab-pane fade" id="user-add">
                    <div class="table-header">
                        <h4>Create new game</h4>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-9">
                            <div class="order-form-section">
                                <form action="{{route('new-game')}}" method="post" class="add-brand-form ajaxform_instant_reload" id="add-brand-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="add-suplier-modal-wrapper">
                                        <div class="row">
                                            <div class="col-lg-6 mt-2">
                                                <label>{{__('Title')}}</label>
                                                <input type="text" name="title" class="form-control" placeholder="Name" required>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <label>Hero Image</label>
                                                <input type="file" name="hero_image" class="form-control" id="hero_image" required>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <label>Status</label>
                                                <select name="status" class="form-control table-select w-100 form-control">
                                                    <option selected value="1">Published</option>
                                                    <option value="0">Unpublished</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <label>Cover Image</label>
                                                <input type="file" name="cover_image" class="form-control" id="cover-image" required>
                                            </div>
                                            <div class="col-lg-12 mt-2">
                                                <label>{{__('Game Link')}}</label>
                                                <input type="text" name="game_link" class="form-control" placeholder="Game link" required>
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
