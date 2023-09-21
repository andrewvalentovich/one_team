@extends('admin.layouts.default')
@section('title')
    Объявления
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

                            <h4 class="card-title">Курс валют</h4>
                            <a href="{{ route('admin.exchange_rates.create') }}" class="btn btn-inverse-warning btn-fw" style="    display: flex;  align-items: center !important;  justify-content: center;">Добавить</a>
                        </div>

                        <div class="table-responsive" bis_skin_checked="1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width:50px;">#</th>
                                    <th style="width:120px;">Прямой</th>
                                    <th style="width:120px;">Относительный</th>
                                    <th style="width:200px;">Значение</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                @foreach($exchange_rates as $exchange_rate)
                                    <tbody>
                                    <tr>
                                        <td>{{$exchange_rate->id}}</td>
                                        <td>{{$exchange_rate->direct}}</td>
                                        <td>{{$exchange_rate->relative}}</td>
                                        <td>{{$exchange_rate->value}}</td>
                                        <td style="display: flex; justify-content: flex-end;">
                                            <a href="{{route('admin.exchange_rates.show', $exchange_rate->id)}}" class="btn btn-inverse-success btn-fw" bis_skin_checked="1">Просмотреть</a>
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
