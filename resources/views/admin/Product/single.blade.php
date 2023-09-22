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
                                <label class="col-sm-3 col-form-label">Опция (для landing page)</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control" name="option_id" style="color: #e2e8f0">
                                        <option value="0" {{ is_null($get->option) ? "selected" : "" }}>{{ __('Не выбрано') }}</option>
                                        @foreach($options as $option)
                                            <option value="{{ $option->id }}" {{ (!is_null($get->option) && $get->option->id === $option->id ) ? "selected" : "" }}>{{ $option->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Вид</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="osobenosti[]" style="color: #e2e8f0">
                                        @if(!isset($get->type_vid[0]))
                                            <option value="" disabled selected>Не выбрано</option>
                                        @endif
                                        @foreach($categorys->where('type', 'Вид') as $osobenosti)
                                            @if(isset($get->type_vid[0]))
                                                <option value="{{$osobenosti->id}}" {{ ($get->type_vid[0]->peculiarities_id == $osobenosti->id) ? "selected" : "" }}>{{$osobenosti->name}}</option>
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
                                        @if(!isset($get->do_more[0]))
                                            <option value="" disabled selected>Не выбрано</option>
                                        @endif
                                        @foreach($categorys->where('type', 'До моря') as $osobenosti)
                                            @if(isset($get->do_more[0]))
                                                <option value="{{$osobenosti->id}}" {{ ($get->do_more[0]->peculiarities_id == $osobenosti->id) ? "selected" : "" }}>{{$osobenosti->name}}</option>
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
                                    <select class="form-control" name="city_id" style="color: #e2e8f0">
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
                                    @if($get->complex_or_not == 'Нет' || is_null($get->complex_or_not))
                                    <select class="form-control objects_module_select" name="complex_or_not" style="color: #e2e8f0">
                                        <option class="close_other_photo_button" value="Нет">Нет</option>
                                        <option class="open_other_photo_button" value="Да">Да</option>
                                    </select>
                                        @else
                                        <select class="form-control objects_module_select" name="complex_or_not" style="color: #e2e8f0">
                                            <option class="open_other_photo_button" value="Да">Да</option>
                                            <option class="close_other_photo_button" value="Нет">Нет</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group" bis_skin_checked="1" id="objects_module" style="display:{{ ($get->complex_or_not == "Да") ? "block" : "none"}};">
                            <div class="card">
                                <div class="card-header" id="objects_module_field">
                                    <!-- Начало аккардеона -->
                                    @if(isset($get->objects))
                                        @foreach(json_decode($get->objects) as $object)
                                            <div class='accordion' data-identificator='{{ $object->id }}' id='accordion{{ $object->id }}'>
                                                <div class="card">
                                                    <div class="card-header" id='heading{{ $object->id }}'>
                                                        <h5 class='mb-0'>
                                                            <p class='btn btn-link' data-toggle='collapse' data-target='#collapse{{ $object->id }}' aria-expanded='true' aria-controls='collapse{{ $object->id }}'>
                                                                Объект #{{ $object->id }}
                                                            </p>
                                                            <input name='add_id{{ $object->id }}' type='hidden' value='{{ $object->id }}'>
                                                        </h5>
                                                    </div>
                                                    <div id='collapse{{ $object->id }}' class='collapse show' aria-labelledby='heading{{ $object->id }}' data-parent='#accordion{{ $object->id }}'>
                                                        <div class='card-body'>
                                                            <div class='form-group' bis_skin_checked='1' style='display: block;'>
                                                                <div class='form-group' bis_skin_checked='1'>
                                                                    <label for='add_building{{ $object->id }}'>Копрус</label>
                                                                    <input name='add_building{{ $object->id }}' type='text' class='form-control' value="{{ $object->building }}" id='add_building{{ $object->id }}' placeholder='А'>
                                                                </div>
                                                                <div class="form-group d-flex" bis_skin_checked="1">
                                                                    <div class="form-group row col-md-3" bis_skin_checked="1">
                                                                        <label for="">Цена</label>
                                                                        <input name="add_price{{ $object->id }}" value="{{ $object->price }}" type="number" class="form-control" id="" placeholder="Цена" required>
                                                                    </div>
                                                                    <div class="form-group row col-md-3 ml-2" bis_skin_checked="1">
                                                                        <label>Валюта</label>
                                                                        <select class="form-control" name="add_price_code{{ $object->id }}" style="color: #e2e8f0">
                                                                            <option value="RUB" selected>RUB</option>
                                                                            @foreach($exchanges as $exchange)
                                                                                <option value="{{ $exchange->relative }}" @if(isset($object->price_code)){{ $exchange->relative === $object->price_code ? "selected" : "" }}@endif>{{ $exchange->relative }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class='form-group' bis_skin_checked='1'>
                                                                    <label for='add_size{{ $object->id }}'>Общая площадь (кв.м)</label>
                                                                    <input name='add_size{{ $object->id }}' type='text' class='form-control' value="{{ $object->size }}" id='add_size{{ $object->id }}' placeholder='40'>
                                                                </div>
                                                                <div class='form-group' bis_skin_checked='1'>
                                                                    <label for='add_apartment_layout{{ $object->id }}'>Планировка</label>
                                                                    <input name='add_apartment_layout{{ $object->id }}' type='text' class='form-control' value="{{ $object->apartment_layout }}" id='add_apartment_layout{{ $object->id }}' placeholder='1+1'>
                                                                </div>
                                                                <div class='form-group' bis_skin_checked='1'>
                                                                    <label for='add_floor{{ $object->id }}'>Этаж</label>
                                                                    <input name='add_floor{{ $object->id }}' type='text' class='form-control' value="{{ $object->floor }}" id='add_floor{{ $object->id }}' placeholder='5'>
                                                                </div>
                                                                <div class='form-group' bis_skin_checked='1'>
                                                                    <div class="form-main__label" for="add_apartment_layout_image">Прикрепить фотографию планировки</div>
                                                                        <label class="input-file">
                                                                            <span class="input-file-text form-control files_text" type="text">{{ isset($object->apartment_layout_image) ? $object->apartment_layout_image : '' }}</span>
                                                                            <input class="add_apartment_layout_image" type="file" value="" name="add_apartment_layout_image{{ $object->id }}">
                                                                        </label>
                                                                    </div>
                                                                <p class='btn btn-outline-danger delete_accordion' onclick='deleteAccordion(this);' data-identificator='{{ $object->id }}'>Удалить квартиру</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <!-- Конец аккардеона -->
                                </div>
                                <div class="card-body">
                                    <p class="btn btn-outline-primary" id="object_module_add">Добавить объект</p>
                                </div>
                            </div>
                        </div>

{{--                        <div class="form-group other_photo" bis_skin_checked="1" @if($get->complex_or_not == 'Нет') style="display: none;" @endif>--}}
{{--                            <label class="btn btn-outline-warning" for="other_photo_file">Фотографии чертежа</label>--}}
{{--                            <input style="display: none"  type="file" name="other_photo[]" id="other_photo_file" accept="image/*" multiple  >--}}
{{--                            <div id="imagePreview3">--}}
{{--                                <div id="newDivqwe3">--}}

{{--                                    @foreach($get->Drawing as $dr)--}}
{{--                                        <div class="PhotoDiv" style="overflow: visible;position: relative; width: 150px; height: 150px" bis_skin_checked="1">--}}
{{--                                            <a  href="{{route('delete_drawing', $dr->id)}}" class="ixsButton2" data-id="0" style="--}}
{{--                                    outline: none;--}}
{{--                                    border: none;--}}
{{--                                position: relative;--}}
{{--                                background-color: transparent;--}}
{{--                                cursor: pointer;--}}
{{--                                " onclick="return confirm('Вы уверены, что хотите удалить это фото?');"></a>--}}
{{--                                            <img class="sendPhoto" style="width: 150px; height: 150px" src="{{asset("uploads/$dr->photo")}}">--}}
{{--                                        </div>--}}
{{--                                        @endforeach--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}


                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Адрес</label>
                            <input value="{{$get->address}}" name="address" type="text" class="form-control" id="" placeholder="Адрес" required >
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Названия </label>
                            <input value="{{$get->name}}" name="name" type="text" class="form-control" id="" placeholder="Названия" required >
                        </div>

                        <div class="form-group d-flex" bis_skin_checked="1">
                            <div class="form-group row col-md-3" bis_skin_checked="1">
                                <label for="">Цена</label>
                                <input name="price" type="number" value="{{ $get->price }}" class="form-control" placeholder="Цена" required >
                            </div>
                            <div class="form-group row col-md-3 ml-2" bis_skin_checked="1">
                                <label>Валюта</label>
                                <select class="form-control" name="price_code" style="color: #e2e8f0">
                                    @if(is_null($get->price_code))
                                        @foreach($exchanges as $exchange)
                                            <option value="{{ $exchange->relative }}" {{ ($exchange->relative === "EUR") ? "selected" : "" }}>{{ $exchange->relative }}</option>
                                        @endforeach
                                    @else
                                        @foreach($exchanges as $exchange)
                                            <option value="{{ $exchange->relative }}" {{ ($exchange->relative === $get->price_code) ? "selected" : "" }}>{{ $exchange->relative }}</option>
                                        @endforeach
                                    @endif
                                    <option value="RUB">RUB</option>
                                </select>
                            </div>
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

                        <input value="{{$get->long}}"  name="long" type="hidden" class="form-control" id="long" placeholder="Долгота">
                        <input value="{{$get->lat}}"  name="lat" type="hidden" class="form-control" id="lat" placeholder="Широта">

                        <style>
                            #set_placemark_map {
                                width: 100%;
                                height: 400px;
                            }
                        </style>
                        <div id="set_placemark_map"></div>

                        <div class="form-group pt-4" bis_skin_checked="1">
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
                            <label for="">Расположения на Немецком</label>
                            <textarea name="disposition_de"  class="form-control" id="" placeholder="Расположения на Немецком" required>{{$get->disposition_de}}</textarea>
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
                            <label for="">Описание на Немецком</label>
                            <textarea name="description_de"  class="form-control" id="" placeholder="Описание на Немецком" required>{{$get->description_de}}</textarea>
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
                                            <select name="photo_categories[{{ $photo->id }}]" style="overflow: hidden;max-width: 150px;">
                                                <option value="0" {{ !isset($photo->category) ? "selected" : "" }}>Без категории</option>
                                                @foreach($photo_categories as $category)
                                                    <option value="{{ $category->id }}" {{ (isset($photo->category) && $photo->category->id === $category->id) ? "selected" : "" }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
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
                        <a href="{{ route('delete_product', $get->id) }}" class="btn btn-inverse-danger btn-fw">Удалить</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2a0f0e9d-44f3-4f13-8628-12588d752fc3" type="text/javascript"></script>
    <script src="{{ asset('admin/js/ymapGetSetPlaceMark.js') }}"></script>
    <style>
        .input-file {
            position: relative;
            display: flex;
        }
        .input-file-text {
            height: 34px;
            display: block;
            box-sizing: border-box;
            max-width: 100%;
        }
        .input-file input[type=file] {
            position: absolute;
            z-index: -1;
            opacity: 0;
            display: block;
            width: 0;
            height: 0;
        }
    </style>
    <script>
        // Delete Accordion
        function deleteAccordion(el) {
            if (confirm("Вы уверены, что хотите удалить карточку? Если да, то нажимите ОК")) {
                document.getElementById('accordion'+el.dataset.identificator).remove();
                checkAccordions();
            }
        }

        // Check Accordions count
        function checkAccordions() {
            let accordions = document.querySelectorAll('.accordion');
            let accordionsCount = accordions.length;

            console.log("==== checkAccordions start ====");
            // console.log("accordionsCount = "+accordionsCount);

            // Проверяем id и имена классов, для "выравнивания" id и имён классов по порядку и корректной работы элементов
            // id 1 4 5 8 -> id 0 1 2 3, для передачи в JSON-объект в будущем
            for(let i = 0; i < accordionsCount; i++) {
                // console.log('ident = '+accordions[i].dataset.identificator);
                // console.log('i = '+i);
                if (i != Number(accordions[i].dataset.identificator)) {
                    // console.log('- Не совпало -');

                    // accordions[i] нашли .accordion
                    // console.log(accordions[i]);
                    accordions[i].dataset.identificator = i;
                    accordions[i].id = "accordion"+i;

                    // accordions[i].childNodes[1].childNodes[1] нашли .card-header
                    // console.log(accordions[i].childNodes[1].childNodes[1]);
                    accordions[i].childNodes[1].childNodes[1].id = "heading"+i;

                    // accordions[i].childNodes[1].childNodes[1].childNodes[1].childNodes[1] нашли .btn
                    console.log(accordions[i].childNodes[1].childNodes[1].childNodes[1].childNodes[1]);
                    accordions[i].childNodes[1].childNodes[1].childNodes[1].childNodes[1].dataset.target = "#collapse"+i;
                    accordions[i].childNodes[1].childNodes[1].childNodes[1].childNodes[1].ariaControls = "collapse"+i; // ?
                    accordions[i].childNodes[1].childNodes[1].childNodes[1].childNodes[1].textContent  = "Объект #"+i;

                    // accordions[i].childNodes[1].childNodes[1].childNodes[1].childNodes[3] нашли input[type='hidden'] add_id
                    console.log(accordions[i].childNodes[1].childNodes[1].childNodes[1].childNodes[3]);
                    accordions[i].childNodes[1].childNodes[1].childNodes[1].childNodes[3].name = "add_id"+i;
                    accordions[i].childNodes[1].childNodes[1].childNodes[1].childNodes[3].value = i;
                    accordions[i].childNodes[1].childNodes[1].childNodes[1].childNodes[3].id = "add_id"+i;

                    // accordions[i].childNodes[1].childNodes[3] нашли .collapse
                    console.log(accordions[i].childNodes[1].childNodes[3]);
                    accordions[i].childNodes[1].childNodes[3].id = "collapse"+i;
                    accordions[i].childNodes[1].childNodes[3].ariaLabelledby = "heading"+i;
                    accordions[i].childNodes[1].childNodes[3].dataset.parent = "#accordion"+i;

                    // accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[13] нашли .delete_accordion
                    console.log(accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[13]);
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[13].dataset.identificator = i;

                    // accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[1].childNodes[3] нашли add_building
                    console.log(accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[1].childNodes[3]);
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[1].childNodes[1].for = "add_building"+i;
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[1].childNodes[3].id = "add_building"+i;
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[1].childNodes[3].name = "add_building"+i;

                    // accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[3].childNodes[3] нашли add_price
                    console.log(accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[3].childNodes[3]);
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[3].childNodes[1].for = "add_price"+i;
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[3].childNodes[3].id = "add_price"+i;
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[3].childNodes[3].name = "add_price"+i;

                    // accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[5].childNodes[3] нашли add_size
                    console.log(accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[5].childNodes[3]);
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[5].childNodes[1].for = "add_size"+i;
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[5].childNodes[3].id = "add_size"+i;
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[5].childNodes[3].name = "add_size"+i;

                    // accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[7].childNodes[3] нашли add_apartment_layout
                    console.log(accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[7].childNodes[3]);
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[7].childNodes[1].for = "add_apartment_layout"+i;
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[7].childNodes[3].id = "add_apartment_layout"+i;
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[7].childNodes[3].name = "add_apartment_layout"+i;

                    // accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[9].childNodes[3] нашли add_floor
                    console.log(accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[9].childNodes[3]);
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[9].childNodes[1].for = "add_floor"+i;
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[9].childNodes[3].id = "add_floor"+i;
                    accordions[i].childNodes[1].childNodes[3].childNodes[1].childNodes[1].childNodes[9].childNodes[3].name = "add_floor"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[5].childNodes[1] нашли add_apartment_layout_image
                    // console.log(accordions[i].childNodes[1].childNodes[3].childNodes[0].childNodes[0].childNodes[5].childNodes[2].childNodes[1]);
                    $('#accordion'+i+' input.add_apartment_layout_image').attr('name', 'add_apartment_layout_image'+i);
                    console.log($('#accordion'+i+' input.add_apartment_layout_image').attr('name'));
                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[5].childNodes[2].childNodes[1].for = "add_apartment_layout_image"+;
                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[5].childNodes[2].childNodes[2].id = "add_apartment_layout_image"+i;
                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[5].childNodes[2].childNodes[2].name = "add_apartment_layout_image"+i;
                }
            }

            console.log("==== checkAccordions end ====");
        }
    </script>
@endsection
