@extends('admin.layouts.default')
@section('title')
    Инвестиции
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
                    <h4 class="card-title">Инвестиции</h4>
                    <form class="forms-sample" action="{{route('invest_page_create')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1" class="">Русский</label>
                            <textarea id="mytextarea" name="invest_editor">{!!  json_decode($get->content ) !!}</textarea>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1" class="">Англиский</label>
                            <textarea id="mytextarea_en" name="invest_editor_en">{!!  json_decode($get->content_en ) !!}</textarea>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1" class="">Турецкий</label>
                            <textarea id="mytextarea_tr" name="invest_editor_tr">{!!  json_decode($get->content_tr) !!}</textarea>
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
