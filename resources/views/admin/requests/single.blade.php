@extends('admin.layouts.default')
@section('title')
    Заявка № {{$get->id}}
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
                    <h4 class="card-title">Заявка № {{$get->id}}</h4>
                        <div class="card" style="width: 18rem;">
                            <ul class="list-group list-group-flush">
                                @if(isset($get->fio))
                                <li class="list-group-item">ФИО ` {{$get->fio}}</li>
                                @endif
                                @if(isset($get->product_id))
                                        <li class="list-group-item">ID обекта `  <a href="{{ route('single_page_product',$get->product_id)}}">{{$get->product_id}}</a> </li>
                                @endif
                                    @if(isset($get->messenger))
                                        <li class="list-group-item">Мессенджер ` {{$get->messenger}}</li>
                                    @endif
                                    @if(isset($get->country))
                                        <li class="list-group-item">Страна ` {{$get->country}}</li>
                                    @endif
                                    @if(isset($get->phone))
                                        <li class="list-group-item">Номер телефона ` {{$get->phone}}</li>
                                    @endif

                            </ul>
                        </div>
                        <br>
                        <div style="display: flex; justify-content: space-between">
                            @if($get->status == 1)
                            <a href="{{route('update_status_one', $get->id)}}" class="btn btn-inverse-warning btn-fw">Отметить как просмотренное</a>
                                @endif

                                @if($get->status == 2)
                                    <a href="{{route('update_status_two', $get->id)}}" class="btn btn-inverse-warning btn-fw">Отметить как не просмотренное</a>
                                @endif
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection