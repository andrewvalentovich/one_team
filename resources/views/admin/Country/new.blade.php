@extends('admin.layouts.default')
@section('title')
    Страны
@endsection




@section('content')
    <style>
        input{
            color: white !important;
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
                    <h4 class="card-title">Добавления страны</h4>
                    <form class="forms-sample" action="{{route('create_country')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Материк</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select name="metric_id" class="form-control" style="color: white">
                                        @foreach($metric as $met)
                                        <option value="{{$met->id}}">{{$met->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Названия страны</label>
                            <input name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Названия страны" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Названия страны на Английском</label>
                            <input name="name_en" type="text" class="form-control" id="exampleInputName1" placeholder="Названия страны на английском" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Названия страны на Турецком</label>
                            <input name="name_tr" type="text" class="form-control" id="exampleInputName1" placeholder="Названия страны на Турецком" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Longitude</label>
                            <input name="long" type="text" class="form-control" id="exampleInputName1" placeholder="Longitude" required>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Latitude</label>
                            <input name="lat" type="text" class="form-control" id="exampleInputName1" placeholder="Latitude" required>
                        </div>


                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Гражданство</label>
{{--                            <textarea style="color: white !important; height:  500px;" name="citizenship"  class="form-control" id="exampleInputName1" placeholder="Гражданство" ></textarea>--}}
                            <textarea id="mytextarea" name="citizenship"></textarea>
                        </div>

                        <div bis_skin_checked="1">
                            <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%; display: none;" src="" alt="" id="blahas" >
                            <br>
                            <input accept="image/*" style="display: none" name="photo" id="file-logos" class="btn btn-outline-success" type="file" required>
                            <br>
                            <label style="width: 200px" for="file-logos" class="custom-file-upload btn btn-outline-success">
                                Выберети флаг
                            </label>
                        </div>
                        <button type="submit" class="btn btn-inverse-success btn-fw">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection