@extends('admin.layouts.default')
@section('title')
    {{ __('Все категории для фото') }}
@endsection

@section('content')


    <div class="content-wrapper" bis_skin_checked="1">
        <br>
        <br>   <br>
        <div class="row " bis_skin_checked="1">
            <div class="col-12 grid-margin" bis_skin_checked="1">
                <div class="card" bis_skin_checked="1">
                    <div class="card-body" bis_skin_checked="1">
                        @if(Session::has('true'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('true') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(Session::has('false'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ Session::get('false') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div style="display: flex; justify-content: space-between">

                            <h4 class="card-title">{{ __('Все категории для фото') }}</h4>
                            <a href="{{ route('admin.photo_categories.create') }}" class="btn btn-inverse-warning btn-fw" style="    display: flex;  align-items: center !important;  justify-content: center;">Добавить</a>
                        </div>

                        <div class="table-responsive" bis_skin_checked="1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:50px;">#</th>
                                    <th style="width:200px;">Название категории</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                @foreach($photo_categories as $photo_category)
                                    <tbody>
                                    <tr>
                                        <td>{{ $photo_category->id }}</td>
                                        <td>{{ $photo_category->name }}</td>
                                        <td style="display: flex; justify-content: flex-end;">
                                            <a href="{{ route('admin.photo_categories.show', $photo_category->id) }}" class="btn btn-inverse-success btn-fw" bis_skin_checked="1">Просмотреть</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
