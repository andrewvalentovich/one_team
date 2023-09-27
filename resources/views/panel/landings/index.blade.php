@extends('panel.layouts.default')
@section('title')
    {{ __('Лендинги') }}
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

                            <h4 class="card-title">{{ __('Лендинги') }}</h4>
                            <a href="{{ route('panel.landings.create') }}" class="btn btn-inverse-warning btn-fw" style="    display: flex;  align-items: center !important;  justify-content: center;">{{ __('Добавить') }}</a>
                        </div>

                        <div class="table-responsive" bis_skin_checked="1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:50px;">#</th>
                                    <th style="">{{ __('Домен') }}</th>
                                    <th style="">{{ __('Название (к чему относится)') }}</th>
                                    <th style="">{{ __('Название шаблона') }}</th>
                                    <th>{{ __('Действие') }}</th>
                                </tr>
                                </thead>
                                @foreach($landings as $landing)
                                    <tbody>
                                    <tr>
                                        <td>{{ $landing->id }}</td>
                                        <td>
                                            <a href="{{ $landing->domain }}" target="_blank">{{ rtrim(preg_replace ('/https:\/\/|http:\/\//', '', $landing->domain, 1), '/') }}</a>
                                        </td>
                                        <td>{{ isset($landing->relation_name) ? $landing->relation_name : "Не указано" }}</td>
                                        <td>{{ $landing->template->name }}</td>
                                        <td style="display: flex; justify-content: flex-end;">
                                            <a href="{{ route('panel.landings.edit', $landing->id) }}" class="btn btn-inverse-success btn-fw" bis_skin_checked="1">{{ __('Редактировать') }}</a>
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
