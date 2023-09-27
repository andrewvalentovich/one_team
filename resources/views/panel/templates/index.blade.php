@extends('panel.layouts.default')
@section('title')
    {{ __('Шаблоны лендингов') }}
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

                            <h4 class="card-title">{{ __('Шаблоны лендингов') }}</h4>
                            <a href="{{ route('panel.templates.create') }}" class="btn btn-inverse-warning btn-fw" style="    display: flex;  align-items: center !important;  justify-content: center;">{{ __('Добавить') }}</a>
                        </div>

                        <div class="table-responsive" bis_skin_checked="1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:50px;">#</th>
                                    <th style="">{{ __('Название') }}</th>
                                    <th style="">{{ __('Путь шаблона') }}</th>
                                    <th style="">{{ __('Токен') }}</th>
                                    <th>{{ __('Действие') }}</th>
                                </tr>
                                </thead>
                                @foreach($templates as $template)
                                    <tbody>
                                    <tr>
                                        <td>{{$template->id}}</td>
                                        <td>{{$template->name}}</td>
                                        <td>{{$template->path}}</td>
                                        <td>{{$template->token}}</td>
                                        <td style="display: flex; justify-content: flex-end;">
                                            <a href="{{ route('panel.templates.edit', $template->id)}}" class="btn btn-inverse-success btn-fw" bis_skin_checked="1">{{ __('Редактировать') }}</a>
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
