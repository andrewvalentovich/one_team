@extends('admin.layouts.default')
@section('title')
    {{$category->name}}
@endsection

<style>
    input{
        color: white !important;
    }
    textarea{
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
                    <h4 class="card-title">Добавления {{$category->name}}</h4>
                    <form class="forms-sample" action="{{route('create_product')}}" enctype="multipart/form-data" id="create_product">


                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Особенности</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control" multiple name="osobenosti[]" style="color: #e2e8f0" required>
                                        @foreach($categorys->where('type', 'Особенности') as $osobenosti)
                                        <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                            @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="osobenosti[]" value="{{$category->id}}">
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Вид</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="osobenosti[]" style="color: #e2e8f0">
                                        @foreach($categorys->where('type', 'Вид') as $osobenosti)
                                            <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">До моря</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="osobenosti[]" style="color: #e2e8f0">
                                        @foreach($categorys->where('type', 'До моря') as $osobenosti)
                                            <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Спальни</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="osobenosti[]" style="color: #e2e8f0">
                                        @foreach($categorys->where('type', 'Спальни')->where('name','!=','Неважно') as $osobenosti)
                                            <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Ванные</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="osobenosti[]" style="color: #e2e8f0">
                                        @foreach($categorys->where('type', 'Ванные')->where('name','!=','Неважно') as $osobenosti)
                                            <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Гостиные</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="osobenosti[]" style="color: #e2e8f0">
                                        @foreach($categorys->where('type', 'Гостиные')->where('name','!=','Неважно') as $osobenosti)
                                            <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>


{{--                        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">ВНЖ в подарок</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="vnj" style="color: #e2e8f0">
                                            <option value="Да">Да</option>
                                            <option value="Нет">Нет</option>
                                    </select>
                                </div>
                            </div>
                        </div>




                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Без комиссии</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="commissions" style="color: #e2e8f0">
                                            <option value="Да">Да</option>
                                            <option value="Нет">Нет</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Паркинг в подарок
                                </label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="parking" style="color: #e2e8f0">
                                            <option value="Да">Да</option>
                                            <option value="Нет">Нет</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Оплата криптовалютой
                                </label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="cryptocurrency" style="color: #e2e8f0">
                                            <option value="Да">Да</option>
                                            <option value="Нет">Нет</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Гражданства за инвестиции
                                </label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="grajandstvo" style="color: #e2e8f0">
                                            <option value="Да">Да</option>
                                            <option value="Нет">Нет</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Застройщик или Владелец
                                </label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="owner" style="color: #e2e8f0">
                                            <option value="Застройщик">Застройщик</option>
                                            <option value="Владелец">Владелец</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Страна</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select data_url="{{route('get_city')}}" class="form-control country_select"  name="country_id" style="color: #e2e8f0">
                                        @foreach($country as $countr)
                                        <option  value="{{$countr->id}}">{{$countr->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div style="display:none;" class="col-md-6 hide_city_select" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Город</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select  class="form-control"  name="city_id" style="color: #e2e8f0">

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div  class="col-md-6 hide_city_select" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Продажа или аренда</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select  class="form-control"  name="sale_or_rent" style="color: #e2e8f0">
                                            <option value="sale">Продажа</option>
                                            <option value="rent">Аренда</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div  class="col-md-6 hide_city_select" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Комплекс</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select  class="form-control other_photo_select"   name="complex_or_not" style="color: #e2e8f0">
                                        <option class="close_other_photo_button" value="Нет">Нет</option>
                                        <option class="open_other_photo_button" value="Да">Да</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group other_photo" bis_skin_checked="1" style="display: none;">
                            <label class="btn btn-outline-warning" for="other_photo_file">Фотографии чертежа</label>
                            <input style="display: none"  type="file" name="other_photo[]" id="other_photo_file" accept="image/*" multiple  >
                            <div id="imagePreview3">
                                <div id="newDivqwe3"></div>
                            </div>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Адрес</label>
                            <input name="address" type="text" class="form-control" id="" placeholder="Адрес" required >
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Названия </label>
                            <input name="name" type="text" class="form-control" id="" placeholder="Названия" required >
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Цена в € </label>
                            <input name="price" type="number" class="form-control" id="" placeholder="Цена в €" required >
                        </div>


                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Общая площадь (кв.м)</label>
                            <input name="size" type="text" class="form-control" id="" placeholder="Названия" required >
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Площадь застройки (кв.м)</label>
                            <input name="size_home" type="text" class="form-control" id="" placeholder="Названия" required >
                        </div>

                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Долгота </label>
                            <input name="long" type="text" class="form-control" id="" placeholder="Долгота" required>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Широта</label>
                            <input name="lat" type="text" class="form-control" id="" placeholder="Широта" required>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Расположения на Русском</label>
                            <textarea name="disposition"  class="form-control" id="" placeholder="Расположения" required></textarea>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Расположения на Англиском</label>
                            <textarea name="disposition_en"  class="form-control" id="" placeholder="Расположения на Англиском" required></textarea>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Расположения на Турецком</label>
                            <textarea name="disposition_tr"  class="form-control" id="" placeholder="Расположения на Турецком" required></textarea>
                        </div>


                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Описание на Русском</label>
                            <textarea name="description"  class="form-control" id="" placeholder="Описание" required></textarea>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Описание на Англиском</label>
                            <textarea name="description_en"  class="form-control" id="" placeholder="Описание на Англиском" required></textarea>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Описание на Турецком</label>
                            <textarea name="description_tr"  class="form-control" id="" placeholder="Описание на Турецком" required></textarea>
                        </div>


                        <div class="form-group" bis_skin_checked="1">
                            <label class="btn btn-outline-warning" for="file">Выберете фотографии</label>
                            <input style="display: none"  type="file" name="image[]" id="file" accept="image/*" multiple  >
                            <div id="imagePreview">
                                <div id="newDivqwe"></div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>

                        <div style="display: none" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                        <button  type="submit" class="submit_button btn btn-inverse-success btn-fw">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection