@extends('admin.layouts.default')
@section('title')
    Страны
@endsection

<style>
    input{
        color: white !important;
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
                    <h4 class="card-title">Редактирование {{$string}}</h4>
                    <form class="forms-sample" action="{{route('update_peculiarities')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Названия</label>
                            <input value="{{$get->name}}" name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Названия" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название на Английском</label>
                            <input value="{{$get->name_en}}" name="name_en" type="text" class="form-control" id="exampleInputName1" placeholder="Название на Английском" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название на Турецком</label>
                            <input value="{{$get->name_tr}}" name="name_tr" type="text" class="form-control" id="exampleInputName1" placeholder="Название на Турецком" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название на Немецком</label>
                            <input value="{{$get->name_de}}" name="name_de" type="text" class="form-control" id="exampleInputName1" placeholder="Название на Немецком" required >
                        </div>
                        <input type="hidden" name="id" value="{{$get->id}}">
                        <div style="display: flex; justify-content: space-between">
                        <button type="submit" class="btn btn-inverse-success btn-fw">Сохранить</button>
                        <a href="{{route('delete_peculiarities', $get->id)}}" class="btn btn-inverse-danger btn-fw">Удалить</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
