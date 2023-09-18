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
                    <h4 class="card-title">Редактирование    @if($get->parent_id == null) страны @else города @endif</h4>
                    <form class="forms-sample" action="{{route('update_country')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if($get->parent_id == null)
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Материк</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select name="metric_id" class="form-control" style="color: white">
                                        @foreach($metric as $met)
                                            @if($get->metric_id == $met->id)
                                            <option selected value="{{$met->id}}">{{$met->name}}</option>
                                            @else
                                                <option value="{{$met->id}}">{{$met->name}}</option>
                                                @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название  @if($get->parent_id == null) страны @else города @endif</label>
                            <input  value="{{$get->name}}" name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Название  @if($get->parent_id == null) страны @else города @endif" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название  @if($get->parent_id == null) страны @else города @endif на Английском</label>
                            <input value="{{$get->name_en}}" name="name_en" type="text" class="form-control" id="exampleInputName1" placeholder="Название  @if($get->parent_id == null) страны @else города @endif на английском" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название  @if($get->parent_id == null) страны @else города @endif на Турецком</label>
                            <input value="{{$get->name_tr}}" name="name_tr" type="text" class="form-control" id="exampleInputName1" placeholder="Название  @if($get->parent_id == null) страны @else города @endif на Турецком" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название  @if($get->parent_id == null) страны @else города @endif на Немецком</label>
                            <input value="{{$get->name_de}}" name="name_de" type="text" class="form-control" id="exampleInputName1" placeholder="Название  @if($get->parent_id == null) страны @else города @endif на Немецком" required >
                        </div>

                        <input type="hidden" name="country_id" value="{{$get->id}}">
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Longitude</label>
                            <input value="{{$get->long}}" name="long" type="text" class="form-control" id="exampleInputName1" placeholder="Longitude" required>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Latitude</label>
                            <input  value="{{$get->lat}}" name="lat" type="text" class="form-control" id="exampleInputName1" placeholder="Latitude" required>
                        </div>
                        @if($get->parent_id == null)

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Гражданство на Русском</label>
{{--                                <textarea style="color: white !important; height:  500px;" name="citizenship"  class="form-control" id="exampleInputName1" placeholder="Гражданство" >{{$get->div}}</textarea>--}}
                                <textarea id="mytextarea" name="citizenship">{!!  $get->div  !!}</textarea>
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Гражданство на Английском</label>
                                <textarea id="mytextarea_en" name="citizenship_en">{!!  $get->div_en  !!}</textarea>
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Гражданство на Турецком</label>
                                <textarea id="mytextarea_tr" name="citizenship_tr">{!!  $get->div_tr  !!}</textarea>
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Гражданство на Немецком</label>
                                <textarea id="mytextarea_de" name="citizenship_de">{!!  $get->div_de  !!}</textarea>
                            </div>


                        @endif
                        <div bis_skin_checked="1">
                            <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="{{asset("uploads/$get->photo")}}" alt="" id="blahas" >
                            <br>
                            <input accept="image/*" style="display: none" name="photo" id="file-logos" class="btn btn-outline-success" type="file" >
                            <br>
                            <label style="width: 200px" for="file-logos" class="custom-file-upload btn btn-outline-success">
                                Выберети флаг
                            </label>
                        </div>
                        <br>
                        <br>
                        <div style="display: flex; justify-content: space-between;">
                        <button type="submit" class="btn btn-inverse-success btn-fw">Сохранить</button>
                            <a href="{{route('delete_country' , $get->id)}}" class="btn btn-inverse-danger btn-fw">Удалить</a>
                        </div>
                    </form>
                </div>

                @if($get->parent_id == null)
                <div class="card-body" bis_skin_checked="1">
                    <h4 class="card-title">Добавление города</h4>
                    <form class="forms-sample" action="{{route('create_country')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{$get->id}}">
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название города</label>
                            <input   name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Название города" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название   города  на Английском</label>
                            <input value="" name="name_en" type="text" class="form-control" id="exampleInputName1" placeholder="Название   города  на английском" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название   города  на Турецком</label>
                            <input value="" name="name_tr" type="text" class="form-control" id="exampleInputName1" placeholder="Название  города  на Турецком" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название   города  на Немецком</label>
                            <input value="" name="name_de" type="text" class="form-control" id="exampleInputName1" placeholder="Название  города  на Немецком" required >
                        </div>


                        <input type="hidden" name="country_id" value="{{$get->id}}">
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Longitude</label>
                            <input  name="long" type="text" class="form-control" id="exampleInputName1" placeholder="Longitude" required>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Latitude</label>
                            <input   name="lat" type="text" class="form-control" id="exampleInputName1" placeholder="Latitude" required>
                        </div>



                        <div bis_skin_checked="1">
                            <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%; display: none;" src="" alt="" id="blaha"  >
                            <br>
                            <input accept="image/*" style="display: none" name="photo" id="file-logo" class="btn btn-outline-success" type="file" >
                            <br>
                            <label style="width: 200px" for="file-logo" class="custom-file-upload btn btn-outline-success">
                                Выберети фотографию
                            </label>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div style="display: flex; justify-content: space-between;">
                            <button type="submit" class="btn btn-inverse-success btn-fw">Сохранить</button>
{{--                            <a href="{{route('delete_country' , $get->id)}}" class="btn btn-inverse-danger btn-fw">Удалить</a>--}}
                        </div>
                    </form>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <div class="row " bis_skin_checked="1">
                    <div class="col-12 grid-margin" bis_skin_checked="1">
                        <div class="card" bis_skin_checked="1">
                            <div class="card-body" bis_skin_checked="1">
                                <div style="display: flex; justify-content: space-between">

                                    <h4 class="card-title">Список городов</h4>
{{--                                    <a href="{{route('new_country_page')}}" class="btn btn-inverse-warning btn-fw" style="    display: flex;  align-items: center !important;  justify-content: center;">Добавить</a>--}}
                                </div>

                                <div class="table-responsive" bis_skin_checked="1">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th> Название страны</th>

                                        </tr>
                                        </thead>
                                        @foreach($get->cities as $item)
                                            <tbody>
                                            <tr>
                                                <td> {{$item->name}}</td>
                                                <td style="display: flex; justify-content: flex-end;">
                                                    <a href="{{route('single_country',$item->id)}}" class="btn btn-inverse-success btn-fw" bis_skin_checked="1">Просмотреть</a>
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
                    @endif
            </div>
        </div>
    </div>
@endsection
