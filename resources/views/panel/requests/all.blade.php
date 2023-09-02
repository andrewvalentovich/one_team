@extends('panel.layouts.default')
@section('title')
    Заявки
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
                            <h4 class="card-title"></h4>
{{--                            <a href="" class="btn btn-inverse-warning btn-fw" style="display: flex;  align-items: center !important;  justify-content: center;">Добавить</a>--}}
                        </div>

                        <div class="table-responsive" bis_skin_checked="1">
                            <table class="table" id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ФИО</th>
                                        <th>Страна</th>
                                        <th>Телефон</th>
                                        <th>Мессенджер</th>
                                    </tr>
                                </thead>
                                @foreach($requests as $item)
                                    <tbody>
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->fio }}</td>
                                        <td>{{ $item->country }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->messenger }}</td>
                                        <td style="display: flex; justify-content: flex-end;">
                                            <a href="{{ route('panel.requests.show', $item->id) }}" class="btn btn-inverse-success btn-fw" bis_skin_checked="1">Просмотреть</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        <div style="display: flex; justify-content: center;" bis_skin_checked="1">{{ $requests->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
