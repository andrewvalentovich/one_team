@extends('admin.layouts.default')
@section('title')
    Страны
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
                            <h4 class="card-title"> {{ $type }}</h4>
                            <div style="display: flex;">
                                <a href="{{route('new_peculiarities',$type)}}" class="btn btn-inverse-warning btn-fw mr-2" style="    display: flex;  align-items: center !important;  justify-content: center;">Добавить</a>
                                <a href="{{route('new_peculiarities_en',$type)}}" class="btn btn-inverse-warning btn-fw" style="display: flex;  align-items: center !important;  justify-content: center;">Добавить на английском</a>
                            </div>
                        </div>

                        <div class="table-responsive" bis_skin_checked="1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> Название</th>
                                </tr>
                                </thead>
                                @foreach($get as $item)
                                    <tbody>
                                    <tr>
                                        <td> {{ $item->getTranslatedName('ru') }}</td>
                                        <td style="display: flex; justify-content: flex-end;">
                                            <a href="{{route('single_peculiarities',$item->id)}}" class="btn btn-inverse-success btn-fw" bis_skin_checked="1">Просмотреть</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        <div style="display: flex; justify-content: center;" bis_skin_checked="1">   {{$get->links()}} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
