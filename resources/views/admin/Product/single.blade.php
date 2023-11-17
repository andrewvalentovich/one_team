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

                        <input type="hidden" name="osobenosti[]" value="@foreach($product_category as $title){{$title->id}} @endforeach">
                        <input type="hidden" name="category_id" value="@foreach($product_category as $title){{$title->peculiarities_id}} @endforeach">
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
                                            @if(isset($get->spalni[0]) && $get->spalni[0]->peculiarities_id == $osobenosti->id)
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
                                            @if(isset($get->vanie[0]) && $get->vanie[0]->peculiarities_id == $osobenosti->id)
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
                                            @if(isset($get->gostinnie[0]) && $get->gostinnie[0]->peculiarities_id == $osobenosti->id)
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
                                    <select class="form-control" name="grajandstvo" style="color: #e2e8f0">
                                        <option value="Да">Да</option>
                                        <option value="Нет">Нет</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1"> <label class="col-sm-3 col-form-label">От застройщика или Вторичка
                                </label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control" name="is_secondary" style="color: #e2e8f0">
                                        <option value="0" {{ $get->is_secondary == 0 ? 'selected' : ''}}>От застройщика</option>
                                        <option value="1" {{ $get->is_secondary == 1 ? 'selected' : ''}}>Вторичка</option>
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
                                    @if(isset($get->layouts))
                                        @foreach($get->layouts as $layout)
                                            @php
                                                $layout_index = $loop->index;
                                            @endphp
                                            <div class='accordion' data-identificator='{{ $loop->index }}' id='accordion{{ $loop->index }}'>
                                                <div class="card">
                                                    <div class="card-header" id='heading{{ $loop->index }}'>
                                                        <h5 class='mb-0'>
                                                            <p class='btn btn-link' data-toggle='collapse' data-target='#collapse{{ $loop->index }}' aria-expanded='true' aria-controls='collapse{{ $loop->index }}'>
                                                                Объект #{{ $loop->index }}
                                                            </p>
                                                            <input name='layouts[{{ $loop->index }}][id]' type='hidden' value='{{ $layout->id }}'>
                                                        </h5>
                                                    </div>
                                                    <div id='collapse{{ $loop->index }}' class='collapse show' aria-labelledby='heading{{ $loop->index }}' data-parent='#accordion{{ $loop->index }}'>
                                                        <div class='card-body'>
                                                            <div class='form-group' bis_skin_checked='1' style='display: block;'>
                                                                <div class='form-group' bis_skin_checked='1'>
                                                                    <label for='add_building{{ $loop->index }}'>Копрус</label>
                                                                    <input name='layouts[{{ $loop->index }}][building]' type='text' class='form-control' value="{{ $layout->building }}" id='add_building{{ $loop->index }}' placeholder='А'>
                                                                </div>
                                                                <div class="form-group d-flex" bis_skin_checked="1">
                                                                    <div class="form-group row col-md-3" bis_skin_checked="1">
                                                                        <label for="">Цена</label>
                                                                        <input name="layouts[{{ $loop->index }}][price]" value="{{ $layout->price }}" type="number" class="form-control" id="" placeholder="Цена">
                                                                    </div>
                                                                    <div class="form-group row col-md-3 ml-2" bis_skin_checked="1">
                                                                        <label>Валюта</label>
                                                                        <select class="form-control" name="layouts[{{ $loop->index }}][price_code]" style="color: #e2e8f0">
                                                                            @foreach($exchanges as $exchange)
                                                                                <option value="{{ $exchange }}"
                                                                                    @if(isset($layout->price_code))
                                                                                        {{ $exchange === $layout->price_code ? "selected" : "" }}
                                                                                    @else
                                                                                        {{ $exchange === "EUR" ? "selected" : "" }}
                                                                                    @endif
                                                                                >{{ $exchange }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class='form-group' bis_skin_checked='1'>
                                                                    <label for='add_size{{ $loop->index }}'>Общая площадь (кв.м)</label>
                                                                    <input name='layouts[{{ $loop->index }}][total_size]' type='text' class='form-control' value="{{ $layout->total_size }}" id='add_size{{ $loop->index }}' placeholder='40'>
                                                                </div>
                                                                <div class='form-group' bis_skin_checked='1'>
                                                                    <label for='add_apartment_layout{{ $loop->index }}'>Планировка</label>
                                                                    <input name='layouts[{{ $loop->index }}][number_rooms]' type='text' class='form-control' value="{{ $layout->number_rooms }}" id='add_apartment_layout{{ $loop->index }}' placeholder='1+1'>
                                                                </div>
                                                                <div class='form-group' bis_skin_checked='1'>
                                                                    <label for='add_floor{{ $loop->index }}'>Этаж</label>
                                                                    <input name='layouts[{{ $loop->index }}][floor]' type='text' class='form-control' value="{{ $layout->floor }}" id='add_floor{{ $loop->index }}' placeholder='5'>
                                                                </div>
                                                                <div class='form-group' bis_skin_checked='1'>
                                                                    <div class="card">
                                                                        <div class="card-header d-flex align-content-center">
                                                                            <div class="form-main__label mr-2" for="add_apartment_layout_image">Прикрепить фотографии планировки</div>
                                                                            <p class="btn btn-outline-primary layout_photo_add" data-id="{{ $loop->index }}">Добавить фотографию планировки</p>
                                                                        </div>
                                                                        <div class="card-body row photo_parent_block">
                                                                            @if(isset($layout->photos))
                                                                                @if(count($layout->photos) > 0)
                                                                                    @foreach($layout->photos as $key => $photo)
                                                                                        <div class='form-group col-md-6 col-sm-12 photo_block' data-id="{{ $photo->id }}">
                                                                                            <p>Фото {{ $loop->index }}</p>
                                                                                            <label class="input-file">
                                                                                                <span class="input-file-text form-control files_text" type="text">
                                                                                                    {{ $photo->url ?? "" }}
                                                                                                </span>
                                                                                                <input class="add_apartment_layout_image" type="file" value="" name="layouts[{{ $layout_index }}][photos][{{ $loop->index }}][file]" accept="image/*" placeholder="">
                                                                                                <input class="add_apartment_layout_id" type="hidden" value="{{ $photo->id }}" name="layouts[{{ $layout_index }}][photos][{{ $loop->index }}][id]">
                                                                                            </label>
                                                                                            <input class="add_apartment_layout_name form-control mb-2" type="text" value="{{ $photo->name ?? null }}" name="layouts[{{ $layout_index }}][photos][{{ $loop->index }}][name]" placeholder="Название фото">
                                                                                            <p class='d-flex btn btn-outline-danger delete_photo' onclick='deletePhoto(this);' data-identificator="{{ $layout_index }}">Удалить фото</p>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <div class='form-group col-md-6 col-sm-12 photo_block' data-id="0">
                                                                                        <p>Фото 0</p>
                                                                                        <label class="input-file">
                                                                                            <span class="input-file-text form-control files_text" type="text">
                                                                                                Добавить фото
                                                                                            </span>
                                                                                            <input class="add_apartment_layout_image" type="file" value="" name="layouts[{{ $layout_index }}][photos][0][file]" accept="image/*" placeholder="">
                                                                                            <input class="add_apartment_layout_id" type="hidden" value="new_0" name="layouts[{{ $layout_index }}][photos][0][id]">
                                                                                        </label>
                                                                                        <input class="add_apartment_layout_name form-control mb-2" type="text" value="" name="layouts[{{ $layout_index }}][photos][0][name]" placeholder="Название фото">
                                                                                        <p class='d-flex btn btn-outline-danger delete_photo' onclick='deletePhoto(this);' data-identificator="{{ $layout_index }}">Удалить фото</p>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class='btn btn-outline-danger delete_accordion' onclick='deleteAccordion(this);' data-identificator='{{ $layout_index }}'>Удалить квартиру</p>
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


                        <div class="form-group" bis_skin_checked="1" style="display: none">
                            <label for="">Slug (название в url)</label>
                            <input value="{{$get->slug}}" name="slug" type="text" class="form-control" id="" placeholder="slug">
                            @error('slug')
                                <label class="text-danger font-weight-normal" for="slug">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Адрес</label>
                            <input value="{{$get->address}}" name="address" type="text" class="form-control" id="" placeholder="Адрес" >
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Названия </label>
                            <input value="{{$get->name}}" name="name" type="text" class="form-control" id="" placeholder="Названия" >
                        </div>

                        <div class="form-group d-flex" bis_skin_checked="1">
                            <div class="form-group row col-md-3" bis_skin_checked="1">
                                <label for="">Цена</label>
                                <input name="price" type="number" value="{{ $get->price }}" class="form-control" placeholder="Цена" >
                            </div>
                            <div class="form-group row col-md-3 ml-2" bis_skin_checked="1">
                                <label>Валюта</label>
                                <select class="form-control" name="price_code" style="color: #e2e8f0">
                                    @if(is_null($get->price_code))
                                        @foreach($exchanges as $exchange)
                                            <option value="{{ $exchange }}" {{ ($exchange === "EUR") ? "selected" : "" }}>{{ $exchange }}</option>
                                        @endforeach
                                    @else
                                        @foreach($exchanges as $exchange)
                                            <option value="{{ $exchange }}" {{ ($exchange == $get->price_code) ? "selected" : "" }}>{{ $exchange }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Общая площадь (кв.м)</label>
                            <input value="{{$get->size}}" name="size" type="text" class="form-control" id="" placeholder="Названия" >
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Площадь застройки (кв.м)</label>
                            <input value="{{$get->size_home}}" name="size_home" type="text" class="form-control" id="" placeholder="Названия" >
                        </div>

                        <style>
                            #set_placemark_map {
                                width: 100%;
                                height: 400px;
                            }
                        </style>
                        <label for="set_placemark_map" class="pt-5">Выберите координаты объекта</label>
                        <div id="set_placemark_map"></div>

                        <div class="row pt-3">
                            <div class="form-group col-sm-12 col-md-6" bis_skin_checked="1">
                                <label for="">Широта (вводить через точку)</label>
                                <input name="lat" value="{{$get->lat}}" type="text" class="form-control" id="lat" placeholder="Широта">
                            </div>
                            <div class="form-group col-sm-12 col-md-6" bis_skin_checked="1">
                                <label for="">Долгота (вводить через точку)</label>
                                <input name="long" value="{{$get->long}}" type="text" class="form-control" id="long" placeholder="Долгота">
                            </div>
                        </div>
                        @foreach($locales as $locale)
                        <div class="form-group @if($loop->first) pt-5 @endif @if($loop->last) pb-5 @endif" bis_skin_checked="1">
                            <label for="">Расположение ({{ $locale->code }})</label>
                            <textarea rows="5" name="disposition[{{ $locale->code }}]" class="form-control" id="" placeholder="Расположение ({{ $locale->code }})">{{ !is_null($get->locale_fields->where('locale_id', $locale->id)->first()) ? $get->locale_fields->where('locale_id', $locale->id)->first()->disposition : "" }}</textarea>
                        </div>
                        @endforeach

                        @foreach($locales as $locale)
                            <div class="form-group @if($loop->first) pt-5 @endif @if($loop->last) pb-5 @endif" bis_skin_checked="1">
                                <label for="">Описание ({{ $locale->code }})</label>
                                <textarea rows="5" name="description[{{ $locale->code }}]" class="form-control" id="" placeholder="Описание ({{ $locale->code }})">{{ !is_null($get->locale_fields->where('locale_id', $locale->id)->first()) ? $get->locale_fields->where('locale_id', $locale->id)->first()->description : "" }}</textarea>
                            </div>
                        @endforeach

                        <div class="form-group" bis_skin_checked="1">
                            <label class="btn btn-outline-warning" for="file">Выберете фотографии</label>
                            <input style="display: none"  type="file" name="photo[]" id="file" accept="image/*" multiple>
                            <div id="imagePreview">
                                <div id="newDivqwe">
                                    @foreach($get->photo as $photo)
                                        <div class="PhotoDiv" style="display:flex; flex-direction: column; overflow: visible;position: relative; width: auto; height: 150px" bis_skin_checked="1">
                                            <a href="{{route('delete_product_photo', $photo->id)}}" class="ixsButton2" data-id="0" style="
                                    outline: none;
                                    border: none;
                                position: relative;
                                background-color: transparent;
                                cursor: pointer;
                                " onclick="return confirm('Вы уверены, что хотите удалить это фото?');"></a>
                                            <img class="sendPhoto" style="width: auto; height: 150px" src="{{asset("uploads/$photo->photo")}}">
                                            <select name="photo_categories[{{ $photo->id }}]" style="overflow: hidden; width: 100%;">
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

        // Delete Photo
        function deletePhoto(el) {
            if (confirm("Вы уверены, что хотите удалить фотографию? Если да, то нажимите ОК")) {
                $(el).parent().remove();
                console.log("el.dataset.identificator");
                console.log(el.dataset.identificator);
                check_layout_photos(el.dataset.identificator);
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

                    var accordion_card = accordions[i].childNodes[1];

                    // accordion_card.childNodes[1] нашли .card-header
                    console.log(accordion_card);
                    accordion_card.childNodes[1].id = "heading"+i;

                    // accordion_card.childNodes[1].childNodes[1].childNodes[1] нашли .btn
                    console.log(accordion_card.childNodes[1].childNodes[1].childNodes[1]);
                    accordion_card.childNodes[1].childNodes[1].childNodes[1].dataset.target = "#collapse"+i;
                    accordion_card.childNodes[1].childNodes[1].childNodes[1].ariaControls = "collapse"+i; // ?
                    accordion_card.childNodes[1].childNodes[1].childNodes[1].textContent  = "Объект #"+i;

                    // accordion_card.childNodes[1].childNodes[1].childNodes[3] нашли input[type='hidden'] add_id
                    console.log(accordion_card.childNodes[1].childNodes[1].childNodes[3]);
                    accordion_card.childNodes[1].childNodes[1].childNodes[3].name = "layouts["+i+"][id]";
                    var layout_id = accordion_card.childNodes[1].childNodes[1].childNodes[3].value;
                    // Если больше, либо равен порядковому номеру (больше на единицу, т.к. при удалении все элементы смещаются на 1 вниз)
                    if (layout_id == i+1) {
                        accordion_card.childNodes[1].childNodes[1].childNodes[3].value = i;
                    }
                    accordion_card.childNodes[1].childNodes[1].childNodes[3].id = "add_id"+i;

                    // accordion_card.childNodes[3] нашли .collapse
                    console.log(accordion_card.childNodes[3]);
                    accordion_card.childNodes[3].id = "collapse"+i;
                    accordion_card.childNodes[3].ariaLabelledby = "heading"+i;
                    accordion_card.childNodes[3].dataset.parent = "#accordion"+i;

                    var common_form_group = accordion_card.childNodes[3].childNodes[1].childNodes[1];

                    // common_form_group.childNodes[13] нашли .delete_accordion
                    console.log(common_form_group.childNodes[13]);
                    common_form_group.childNodes[13].dataset.identificator = i;

                    // common_form_group.childNodes[1].childNodes[3] нашли add_building
                    console.log(common_form_group.childNodes[1].childNodes[3]);
                    common_form_group.childNodes[1].childNodes[1].for = "add_building"+i;
                    common_form_group.childNodes[1].childNodes[3].id = "add_building"+i;
                    common_form_group.childNodes[1].childNodes[3].name = "layouts["+i+"][building]";

                    // common_form_group.childNodes[3].childNodes[3] нашли add_price
                    console.log(common_form_group.childNodes[3].childNodes[1].childNodes[3]);
                    common_form_group.childNodes[3].childNodes[1].childNodes[3].id = "add_price"+i;
                    common_form_group.childNodes[3].childNodes[1].childNodes[3].name = "layouts["+i+"][price]";

                    // common_form_group.childNodes[3].childNodes[3] нашли add_price_code
                    console.log("price_code");
                    console.log(common_form_group.childNodes[3].childNodes[3].childNodes[3]);
                    common_form_group.childNodes[3].childNodes[3].childNodes[3].id = "add_price_code"+i;
                    common_form_group.childNodes[3].childNodes[3].childNodes[3].name = "layouts["+i+"][price_code]";

                    // common_form_group.childNodes[5].childNodes[3] нашли add_size
                    console.log(common_form_group.childNodes[5].childNodes[3]);
                    common_form_group.childNodes[5].childNodes[1].for = "add_size"+i;
                    common_form_group.childNodes[5].childNodes[3].id = "add_size"+i;
                    common_form_group.childNodes[5].childNodes[3].name = "layouts["+i+"][total_size]";

                    // common_form_group.childNodes[7].childNodes[3] нашли add_apartment_layout
                    console.log(common_form_group.childNodes[7].childNodes[3]);
                    common_form_group.childNodes[7].childNodes[1].for = "add_apartment_layout"+i;
                    common_form_group.childNodes[7].childNodes[3].id = "add_apartment_layout"+i;
                    common_form_group.childNodes[7].childNodes[3].name = "layouts["+i+"][number_rooms]";

                    // common_form_group.childNodes[9].childNodes[3] нашли add_floor
                    console.log(common_form_group.childNodes[9].childNodes[3]);
                    common_form_group.childNodes[9].childNodes[1].for = "add_floor"+i;
                    common_form_group.childNodes[9].childNodes[3].id = "add_floor"+i;
                    common_form_group.childNodes[9].childNodes[3].name = "layouts["+i+"][floor]";

                    //  нашли add_apartment_layout_image
                    console.log("img");

                    //  нашли layout_photo_add (button)
                    common_form_group.childNodes[11].childNodes[1].childNodes[1].childNodes[3].dataset.id = i;

                    var photo_count = $('#accordion'+i+'.photo_parent_block').length;
                    console.log(photo_count);
                    //  нашли card-body с фотографиями
                    var photo_card_body = common_form_group.childNodes[11].childNodes[1].childNodes[3];

                    for (var n = 0; n < photo_count; n++) {
                        // Надпись Фото N
                        photo_card_body.childNodes[2*n + 1].childNodes[1].textContent = "Фото " + n;
                        // label->input[file]
                        photo_card_body.childNodes[2*n + 1].childNodes[3].childNodes[3].name = "layouts["+i+"][photos]["+n+"][file]";
                        // label->input[id]
                        photo_card_body.childNodes[2*n + 1].childNodes[3].childNodes[5].name = "layouts["+i+"][photos]["+n+"][id]";
                        // label->input[id]
                        photo_card_body.childNodes[2*n + 1].childNodes[5].name = "layouts["+i+"][photos]["+n+"][name]";
                    }

                    // console.log($('#accordion'+i+' input.add_apartment_layout_image').attr('name'));
                    // $('#accordion'+i+' input.add_apartment_layout_image').attr('name', "layouts["+i+"][photos][]");
                }
            }

            console.log("==== checkAccordions end ====");
        }

        function check_layout_photos(accordion_index) {
            let accordions = document.querySelectorAll('.accordion');
            var accordion_card = accordions[accordion_index].children[0];
            var common_form_group = accordion_card.children[1].children[0].children[0];
            console.log(common_form_group);

            //  нашли card-body с фотографиями
            var photo_card_body = common_form_group.children[5].children[0].children[1];
            console.log(photo_card_body);
            var photo_children = photo_card_body.children;
            console.log(photo_card_body.children);

            for (var n = 0; n < photo_children.length; n++) {
                // Надпись Фото N
                photo_children[n].children[0].textContent = "Фото " + n;
                // label->input[file]
                photo_children[n].children[1].children[1].name = "layouts["+accordion_index+"][photos]["+n+"][file]";
                // label->input[id]
                photo_children[n].children[1].children[2].name = "layouts["+accordion_index+"][photos]["+n+"][id]";

                var photo_id = photo_children[n].children[1].children[2].value;
                if(photo_id.indexOf("new") !== -1) {
                    photo_children[n].children[1].children[2].value = "new_"+n;
                }

                // label->input[id]
                photo_children[n].children[2].name = "layouts["+accordion_index+"][photos]["+n+"][name]";
            }
        }
    </script>
@endsection
