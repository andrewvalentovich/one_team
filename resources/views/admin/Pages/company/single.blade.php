@extends('admin.layouts.default')
@section('title')
    Редактирование  страницы
@endsection




@section('content')
    <style>
        input{
            color: white !important;
        }
        .tox-tinymce{
            height: 599px !important;
        }
    </style>

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
                    <h4 class="card-title">Редактирование  страницы</h4>
                    <form class="forms-sample" action="{{ route('update_select_page') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1" class="">Название страницы</label>
                            <input value="{{ $get->name }}" name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Название страницы" required="">
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="slug" class="">Название страницы в url (* поле должно быть уникальным и записано латинскими буквами)</label>
                            <input name="slug" value="{{ $get->slug }}" type="text" class="form-control" id="slug" placeholder="Например - team" required="">
                        </div>
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Очередь</label>
                                <?php $i = 0;?>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select name="status" style="color: white !important;" class="form-control">
                                        @for($i = 0; $i <11 ; $i++)
                                            @if($get->status == $i)
                                            <option value="{{$i}}" selected>{{$i}}</option>
                                            @else
                                                <option value="{{$i}}" >{{$i}}</option>

                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="select_id" value="{{$get->id}}">
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1" class="">Контент Русский</label>
                            <textarea id="mytextarea" name="contents">{!!  json_decode($get->content ) !!}</textarea>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1" class="">Контент Англиский</label>
                            <textarea id="mytextarea_en" name="contents_en">{!!  json_decode($get->content_en ) !!}</textarea>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1" class="">Контент Турецкий</label>
                            <textarea id="mytextarea_tr" name="contents_tr">{!!  json_decode($get->content_tr) !!}</textarea>
                        </div>

                        <br>
                        <br>
                        <div style="display: flex; justify-content: space-between">
                        <button type="submit" class="btn btn-inverse-success btn-fw">Сохранить</button>
                        <a class="btn btn-outline-danger btn-fw" href="{{route('delete_select_page', $get->id)}}">Удалить</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
