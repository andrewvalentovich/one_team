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
                        @method('patch')
                        @if($errors->any())
                            <h4>{{$errors->first()}}</h4>
                        @endif
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

                        @foreach($locales as $locale)
                        <div class="form-group @if($loop->first) pt-5 @endif @if($loop->last) pb-5 @endif" bis_skin_checked="1">
                            <label for="exampleInputName1">Название  @if($get->parent_id == null) страны @else города @endif {{ '(' . $locale->code . ')' }}</label>
                            <input value="{{ !is_null($get->locale_fields->where('locale_id', $locale->id)->first()) ? $get->locale_fields->where('locale_id', $locale->id)->first()->name : "" }}" name="name[{{ $locale->code }}]" type="text" class="form-control" id="exampleInputName1" placeholder="Название  @if($get->parent_id == null) страны @else города @endif {{ '(' . $locale->code . ')' }}" >
                        </div>
                        @endforeach

                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название  @if($get->parent_id == null) страны @else города @endif в url</label>
                            <input value="{{$get->slug}}" name="slug" type="text" class="form-control" id="exampleInputName1" placeholder="Название  @if($get->parent_id == null) страны @else города @endif в url">
                            @error('slug')
                                <label class="text-danger font-weight-normal" for="slug">{{ $message }}</label>
                            @enderror
                        </div>


                        <input type="hidden" name="country_id" value="{{$get->id}}">
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Longitude</label>
                            <input value="{{$get->long}}" name="long" type="text" class="form-control" id="exampleInputName1" placeholder="Longitude" required>
                            @error('long')
                                <label class="text-danger font-weight-normal" for="long">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Latitude</label>
                            <input value="{{$get->lat}}" name="lat" type="text" class="form-control" id="exampleInputName1" placeholder="Latitude" required>
                            @error('lat')
                                <label class="text-danger font-weight-normal" for="lat">{{ $message }}</label>
                            @enderror
                        </div>
                        @if($get->parent_id == null)
                            @foreach($locales as $locale)
                                <div class="form-group @if($loop->first) pt-5 @endif @if($loop->last) pb-5 @endif" bis_skin_checked="1">
                                    <label for="exampleInputName1">Гражданство ({{ $locale->code }})</label>
                                    <textarea rows="5" name="div[{{ $locale->code }}]" class="form-control" placeholder="Гражданство ({{ $locale->code }})">{!! !is_null($get->locale_fields->where('locale_id', $locale->id)->first()) ? $get->locale_fields->where('locale_id', $locale->id)->first()->div : "" !!}</textarea>
                                </div>
                            @endforeach
                        @endif
                        <input type="hidden" name="id" value="{{$get->id}}">
                        <div bis_skin_checked="1">
                            <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="{{asset("uploads/$get->photo")}}" alt="">
                            <br>
                            <input name="photo" id="file-photo-city" type="file" style="opacity: 0">
                            <br>
                            <label style="width: 200px" for="file-photo-city" class="btn btn-outline-success">
                                Выберите фото
                            </label>
                            @error('photo')
                                <label class="text-danger font-weight-normal" for="photo">{{ $message }}</label>
                            @enderror
                        </div>
                        <div bis_skin_checked="1">
                            <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="{{asset("uploads/$get->flag")}}" alt="">
                            <br>
                            <input name="flag" id="file-logo-city" type="file" style="opacity: 0">
                            <br>
                            <label style="width: 200px" for="file-logo-city" class="btn btn-outline-success">
                                Выберите флаг
                            </label>
                            @error('flag')
                                <label class="text-danger font-weight-normal" for="flag">{{ $message }}</label>
                            @enderror
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
                            <label for="exampleInputName1">Название города на русском</label>
                            <input name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Название города">
                            @error('name')
                            <label class="text-danger font-weight-normal" for="name">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Гражданство на русском</label>
                            <textarea rows="5" class="form-control" name="div" placeholder="Гражданство на русском"></textarea>
                            @error('div')
                                <label class="text-danger font-weight-normal" for="div">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6" bis_skin_checked="1">
                                <label for="exampleInputName1">Широта</label>
                                <input name="lat" type="text" class="form-control" id="exampleInputName1" placeholder="Широта">
                                @error('lat')
                                <label class="text-danger font-weight-normal" for="name">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group col-md-6" bis_skin_checked="1">
                                <label for="exampleInputName1">Долгота</label>
                                <input name="long" type="text" class="form-control" id="exampleInputName1" placeholder="Долгота">
                                @error('long')
                                <label class="text-danger font-weight-normal" for="name">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div bis_skin_checked="1">
                            <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="{{asset("uploads/")}}" alt="">
                            <br>
                            <input name="photo" id="file-photo" type="file" style="opacity: 0">
                            <br>
                            <label style="width: 200px" for="file-photo" class="btn btn-outline-success">
                                Выберите фото
                            </label>
                        </div>
                        <div bis_skin_checked="1">
                            <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="{{asset("uploads/")}}" alt="">
                            <br>
                            <input name="flag" id="file-logo" type="file" style="opacity: 0">
                            <br>
                            <label style="width: 200px" for="file-logo" class="btn btn-outline-success">
                                Выберите флаг
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
