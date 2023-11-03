@extends('admin.layouts.default')
@section('title')
    Новая страница
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
                    <h4 class="card-title">Новая страница</h4>
                    <form class="forms-sample" action="{{route('all_company_select_page_create')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1" class="">Название страницы</label>
                            <input name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Названия страницы" required="">
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="slug" class="">Название страницы в url (* поле должно быть уникальным и записано латинскими буквами)</label>
                            <input name="slug" type="text" class="form-control" id="slug" placeholder="Например - team" required="">
                        </div>
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Очередь</label>
                                <?php $i = 0;?>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select name="status" style="color: white !important;" class="form-control">
                                        @for($i = 0; $i <11 ; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
{{--                        <div class="form-group" bis_skin_checked="1">--}}
{{--                            <label for="mytextarea" class="">Контент</label>--}}
{{--                            <textarea id="mytextarea" name="contents" ></textarea>--}}
{{--                        </div>--}}
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1" class="">Контент Русский</label>
                            <textarea id="mytextarea" name="contents"></textarea>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1" class="">Контент Англиский</label>
                            <textarea id="mytextarea_en" name="contents_en"></textarea>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1" class="">Контент Турецкий</label>
                            <textarea id="mytextarea_tr" name="contents_tr"></textarea>
                        </div>


                        <br>
                        <br>
                        <button type="submit" class="btn btn-inverse-success btn-fw">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
