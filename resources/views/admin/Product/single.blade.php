@extends('admin.layouts.default')
@section('title')
    @foreach($product_category as $title)
    {{$title->name}}
    @endforeach
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
                    <h4 class="card-title">Редактирование     @foreach($product_category as $title)
                            {{$title->name}}
                        @endforeach</h4>
                    <form class="forms-sample" action="{{route('update_product')}}" enctype="multipart/form-data" id="update_product">
                        <br><br>
                        <input type="hidden" value="{{$get->id}}" name="product_id">
                            @foreach($get_old_category as  $old_cat)
                        <input type="hidden" value="{{$old_cat->peculiarities_id}}" name="osobenosti[]">
                            @endforeach
                        <div class="col-md-6" bis_skin_checked="1">
                            @foreach($get_old_category as  $old)
                                <p>{{$old->category->name}} <a style="color: red" href="{{route('delete_osobenosti', $old->id)}}">Удалить</a></p>
                            @endforeach
                            <div class="form-group row" bis_skin_checked="1">

                                <label class="col-sm-3 col-form-label">Особенности</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control" multiple name="osobenosti[]" style="color: #e2e8f0" >
                                        @foreach($get_new_category->where('type', 'Особенности') as $osobenosti)
                                            <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="osobenosti[]" value="@foreach($product_category as $title)
                        {{$title->id}}
                        @endforeach">
                        <input type="hidden" name="category_id" value="@foreach($product_category as $title)
                        {{$title->peculiarities_id}}
                        @endforeach">
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Вид</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="osobenosti[]" style="color: #e2e8f0">
                                        @foreach($categorys->where('type', 'Вид') as $osobenosti)
                                            @if($get->type_vid[0]->peculiarities_id == $osobenosti->id)
                                            <option value="{{$osobenosti->id}}" selected>{{$osobenosti->name}}</option>
                                                @else
                                                <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                                @endif
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
                                            @if($get->do_more[0]->peculiarities_id == $osobenosti->id)
                                                <option value="{{$osobenosti->id}}" selected>{{$osobenosti->name}}</option>
                                            @else
                                                <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                            @endif
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
                                            @if($get->spalni[0]->peculiarities_id == $osobenosti->id)
                                                <option value="{{$osobenosti->id}}" selected>{{$osobenosti->name}}</option>
                                            @else
                                                <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                            @endif
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
                                            @if($get->vanie[0]->peculiarities_id == $osobenosti->id)
                                                <option value="{{$osobenosti->id}}" selected>{{$osobenosti->name}}</option>
                                            @else
                                                <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                            @endif
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
                                            @if($get->gostinnie[0]->peculiarities_id == $osobenosti->id)
                                                <option value="{{$osobenosti->id}}" selected>{{$osobenosti->name}}</option>
                                            @else
                                                <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                            @endif
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
                                        @if($get->vnj == 'Да')
                                        <option value="Да">Да</option>
                                        <option value="Нет">Нет</option>
                                        @else
                                            <option value="Нет">Нет</option>
                                            <option value="Да">Да</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>




                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Без комиссии</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="commissions" style="color: #e2e8f0">
                                        @if($get->commissions == 'Да')
                                        <option value="Да">Да</option>
                                        <option value="Нет">Нет</option>
                                            @else
                                            <option value="Нет">Нет</option>
                                            <option value="Да">Да</option>
                                        @endif
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
                                        @if($get->parking == 'Да')
                                        <option value="Да">Да</option>
                                        <option value="Нет">Нет</option>
                                            @else
                                            <option value="Нет">Нет</option>
                                            <option value="Да">Да</option>
                                        @endif
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
                                        @if($get->cryptocurrency == 'Да')
                                        <option value="Да">Да</option>
                                        <option value="Нет">Нет</option>
                                            @else
                                            <option value="Нет">Нет</option>
                                            <option value="Да">Да</option>
                                        @endif
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
                                        @if($get->owner == 'Застройщик')
                                        <option value="Застройщик">Застройщик</option>
                                        <option value="Владелец">Владелец</option>
                                            @else
                                            <option value="Владелец">Владелец</option>
                                            <option value="Застройщик">Застройщик</option>
                                        @endif

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
                                            <option @if($countr->id == $get->country_id) selected @endif  value="{{$countr->id}}">{{$countr->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div  class="col-md-6 hide_city_select" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Город</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select  class="form-control"  name="city_id" style="color: #e2e8f0">
                                        @foreach($city as $ct)
                                            <option @if($ct->id == $get->city_id) selected  @endif  value="{{$ct->id}}">{{$ct->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div  class="col-md-6 hide_city_select" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Продажа или аренда</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select  class="form-control"  name="sale_or_rent" style="color: #e2e8f0">
                                        @if($get->sale_or_rent == 'sale')
                                        <option value="sale">Продажа</option>
                                        <option value="rent">Аренда</option>
                                            @else
                                            <option value="rent">Аренда</option>
                                            <option value="sale">Продажа</option>
                                            @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div  class="col-md-6 hide_city_select" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Комплекс</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    @if($get->complex_or_not == 'Нет')
                                    <select  class="form-control other_photo_select"   name="complex_or_not" style="color: #e2e8f0">
                                        <option class="close_other_photo_button" value="Нет">Нет</option>
                                        <option class="open_other_photo_button" value="Да">Да</option>
                                    </select>
                                        @else
                                        <select  class="form-control other_photo_select"   name="complex_or_not" style="color: #e2e8f0">
                                            <option class="open_other_photo_button" value="Да">Да</option>
                                            <option class="close_other_photo_button" value="Нет">Нет</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="form-group other_photo" bis_skin_checked="1" @if($get->complex_or_not == 'Нет') style="display: none;" @endif>
                            <label class="btn btn-outline-warning" for="other_photo_file">Фотографии чертежа</label>
                            <input style="display: none"  type="file" name="other_photo[]" id="other_photo_file" accept="image/*" multiple  >
                            <div id="imagePreview3">
                                <div id="newDivqwe3">

                                    @foreach($get->Drawing as $dr)
                                        <div class="PhotoDiv" style="overflow: visible;position: relative; width: 150px; height: 150px" bis_skin_checked="1">
                                            <a  href="{{route('delete_drawing', $dr->id)}}" class="ixsButton2" data-id="0" style="
                                    outline: none;
                                    border: none;
                                position: relative;
                                background-color: transparent;
                                cursor: pointer;
                                " onclick="return confirm('Вы уверены, что хотите удалить это фото?');"></a>
                                            <img class="sendPhoto" style="width: 150px; height: 150px" src="{{asset("uploads/$dr->photo")}}">
                                        </div>
                                        @endforeach

                                </div>
                            </div>
                        </div>


                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Адрес</label>
                            <input value="{{$get->address}}" name="address" type="text" class="form-control" id="" placeholder="Адрес" required >
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Названия </label>
                            <input value="{{$get->name}}" name="name" type="text" class="form-control" id="" placeholder="Названия" required >
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Цена в € </label>
                            <input value="{{$get->price}}" name="price" type="number" class="form-control" id="" placeholder="Цена в €" required >
                        </div>


                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Общая площадь (кв.м)</label>
                            <input value="{{$get->size}}" name="size" type="text" class="form-control" id="" placeholder="Названия" required >
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Площадь застройки (кв.м)</label>
                            <input value="{{$get->size_home}}" name="size_home" type="text" class="form-control" id="" placeholder="Названия" required >
                        </div>

                        <input type="hidden" name="category_id" value="@foreach($product_category as $title)
                        {{$title->peculiarities_id}}
                        @endforeach">
                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Долгота </label>
                            <input value="{{$get->long}}"  name="long" type="text" class="form-control" id="" placeholder="Долгота" required>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Широта</label>
                            <input value="{{$get->lat}}"  name="lat" type="text" class="form-control" id="" placeholder="Широта" required>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Расположения на Русском</label>
                            <textarea  name="disposition"  class="form-control" id="" placeholder="Расположения" required>{{$get->disposition}}</textarea>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Расположения на Англиском</label>
                            <textarea name="disposition_en"  class="form-control" id="" placeholder="Расположения на Англиском" required>{{$get->disposition_en}}</textarea>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Расположения на Турецком</label>
                            <textarea name="disposition_tr"  class="form-control" id="" placeholder="Расположения на Турецком" required>{{$get->disposition_tr}}</textarea>
                        </div>


                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Описание на Русском</label>
                            <textarea name="description"  class="form-control" id="" placeholder="Описание" required>{{$get->description}}</textarea>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Описание на Англиском</label>
                            <textarea name="description_en"  class="form-control" id="" placeholder="Описание на Англиском" required>{{$get->description_en}}</textarea>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Описание на Турецком</label>
                            <textarea name="description_tr"  class="form-control" id="" placeholder="Описание на Турецком" required>{{$get->description_tr}}</textarea>
                        </div>


                        <div class="form-group" bis_skin_checked="1">
                            <label class="btn btn-outline-warning" for="file">Выберете фотографии</label>
                            <input style="display: none"  type="file" name="image[]" id="file" accept="image/*" multiple  >
                            <div id="imagePreview">
                                <div id="newDivqwe">
                                    @foreach($get->photo as $photo)
                                        <div class="PhotoDiv" style="overflow: visible;position: relative; width: 150px; height: 150px" bis_skin_checked="1">
                                            <a  href="{{route('delete_product_photo', $photo->id)}}" class="ixsButton2" data-id="0" style="
                                    outline: none;
                                    border: none;
                                position: relative;
                                background-color: transparent;
                                cursor: pointer;
                                " onclick="return confirm('Вы уверены, что хотите удалить это фото?');"></a>
                                            <img class="sendPhoto" style="width: 150px; height: 150px" src="{{asset("uploads/$photo->photo")}}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div style="display: none" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                        <div style="display: flex; justify-content: space-between;">
                        <button  type="submit" class="submit_button btn btn-inverse-success btn-fw">Сохранить</button>
                        <a href="{{route('delete_product', $get->id)}}" class="btn btn-inverse-danger btn-fw">Удалить</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection