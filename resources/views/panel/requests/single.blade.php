@extends('panel.layouts.default')
@section('title')
    Заявка № {{ $request->id }}
@endsection

<style>
    input{
        color: white !important;
    }
    .list-group-flush > .list-group-item{
        background-color: black;
    }
</style>



@section('content')
    <div class="content-wrapper" bis_skin_checked="1">
        <br><br><br>
        <div class="col-12 grid-margin stretch-card" bis_skin_checked="1">


            <div class="card" bis_skin_checked="1" style="min-height: 1000px">

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
                    <h4 class="card-title">Заявка № {{ $request->id }}</h4>
                        <div class="card" style="width: 18rem;">
                            <ul class="list-group list-group-flush">
                                @if(isset($request->fio))
                                <li class="list-group-item">ФИО ` {{ $request->fio }}</li>
                                @endif
                                @if(isset($request->product_id))
                                        <li class="list-group-item">ID обекта `  <a href="{{ route('panel.requests.show', $request->product_id) }}">{{ $request->product_id }}</a> </li>
                                @endif
                                    @if(isset($request->messenger))
                                        <li class="list-group-item">Мессенджер ` {{ $request->messenger }}</li>
                                    @endif
                                    @if(isset($request->country))
                                        <li class="list-group-item">Страна ` {{ $request->country }}</li>
                                    @endif
                                    @if(isset($request->phone))
                                        <li class="list-group-item">Номер телефона ` {{ $request->phone }}</li>
                                    @endif

                            </ul>
                        </div>
                        <br>
                        <div style="display: flex; justify-content: space-between">
                            @if($request->status == 1)
                                <a href="{{ route('panel.requests.set_status_unchecked', $request->id) }}" class="btn btn-inverse-warning btn-fw">Отметить как просмотренное</a>
                            @endif

                            @if($request->status == 2)
                                <a href="{{ route('panel.requests.set_status_checked', $request->id) }}" class="btn btn-inverse-warning btn-fw">Отметить как не просмотренное</a>
                            @endif
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection
