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
                                    <select class="form-control" multiple name="osobenosti[]" style="color: #e2e8f0">
                                        @foreach($categorys->where('type', 'Особенности') as $osobenosti)
                                        <option value="{{$osobenosti->id}}">{{$osobenosti->name}}</option>
                                            @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="osobenosti[]" value="{{$category->id}}">
                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Опция (для landing page)</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select class="form-control"  name="option_id" style="color: #e2e8f0">
                                        <option value="0">{{ __('Не выбрано') }}</option>
                                        @foreach($options as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
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
                                        <option value="" disabled selected>Не выбрано</option>
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
                                        <option value="" disabled selected>Не выбрано</option>
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
                                    <select data_url="{{ route('get_city') }}" class="form-control country_select" name="country_id" style="color: #e2e8f0">
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
                                    <select  class="form-control objects_module_select" name="complex_or_not" style="color: #e2e8f0">
                                        <option class="close_other_photo_button" value="Нет">Нет</option>
                                        <option class="open_other_photo_button" value="Да">Да</option>
                                    </select>
                                </div>
                            </div>
                        </div>


{{--                        <div class="form-group other_photo" bis_skin_checked="1" style="display: none;">--}}
{{--                            <label class="btn btn-outline-warning" for="other_photo_file">Фотографии чертежа</label>--}}
{{--                            <input style="display: none"  type="file" name="other_photo[]" id="other_photo_file" accept="image/*" multiple  >--}}
{{--                            <div id="imagePreview3">--}}
{{--                                <div id="newDivqwe3"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group col-md-6" bis_skin_checked="1" id="objects_module" style="display: none;">
                            <div class="card">
                                <div class="card-header" id="objects_module_field">
                                    <!-- Начало аккардеона -->
{{--                                    <div id="accordion1">--}}
{{--                                        <div class="card">--}}
{{--                                            <div class="card-header" id="heading1">--}}
{{--                                                <h5 class="mb-0">--}}
{{--                                                    <p class="btn btn-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">--}}
{{--                                                        Объект #0--}}
{{--                                                    </p>--}}
{{--                                                </h5>--}}
{{--                                            </div>--}}
{{--                                            <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordion1">--}}
{{--                                                <div class="card-body">--}}
{{--                                                    <div class="form-group" bis_skin_checked="1" style="display: block;">--}}
{{--                                                        <div class="form-group" bis_skin_checked="1">--}}
{{--                                                            <label for="add_building">Копрус</label>--}}
{{--                                                            <input name="add_building" type="text" class="form-control" id="add_building" placeholder="А">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-group" bis_skin_checked="1">--}}
{{--                                                            <label for="add_price">Цена в € </label>--}}
{{--                                                            <input name="add_price" type="number" class="form-control" id="add_price" placeholder="249">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-group" bis_skin_checked="1">--}}
{{--                                                            <label for="add_size">Общая площадь (кв.м)</label>--}}
{{--                                                            <input name="add_size" type="text" class="form-control" id="add_size" placeholder="40">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-group" bis_skin_checked="1">--}}
{{--                                                            <label for="add_floor_plan">Планировка</label>--}}
{{--                                                            <input name="add_floor_plan" type="text" class="form-control" id="add_floor_plan" placeholder="1+1">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-group" bis_skin_checked="1">--}}
{{--                                                            <label for="add_floor">Этаж</label>--}}
{{--                                                            <input name="add_floor" type="text" class="form-control" id="add_floor" placeholder="5">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-group" bis_skin_checked="1">--}}
{{--                                                            <label class="btn btn-outline-warning" for="other_photo_file">Фотография планировки</label>--}}
{{--                                                            <input style="display: none" type="file" name="other_photo" id="other_photo_file" accept="image/*">--}}
{{--                                                            <div id="imagePreview3">--}}
{{--                                                                <div id="newDivqwe3"></div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <p class="btn btn-outline-danger" onclick="document.getElementById('accordion1').remove()">Удалить квартиру</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <!-- Конец аккардеона -->
                                </div>
                                <div class="card-body">
                                    <p class="btn btn-outline-primary" id="object_module_add">Добавить объект</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group pt-3" bis_skin_checked="1">
                            <label for="">Адрес</label>
                            <input name="address" type="text" class="form-control" id="" placeholder="Адрес" required>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Названия </label>
                            <input name="name" type="text" class="form-control" id="" placeholder="Названия" required>
                        </div>

                        <div class="form-group d-flex" bis_skin_checked="1">
                            <div class="form-group row col-md-3" bis_skin_checked="1">
                                <label for="">Цена</label>
                                <input name="price" type="number" class="form-control" id="" placeholder="Цена" >
                            </div>
                            <div class="form-group row col-md-3 ml-2" bis_skin_checked="1">
                                <label>Валюта</label>
                                <select class="form-control" name="price_code" style="color: #e2e8f0">
                                    @foreach($exchanges as $exchange)
                                        <option value="{{ $exchange->relative }}" {{ $exchange->relative === "EUR" ? "selected" : "" }}>{{ $exchange->relative }}</option>
                                    @endforeach
                                    <option value="RUB">RUB</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Общая площадь (кв.м)</label>
                            <input name="size" type="text" class="form-control" id="" placeholder="Названия" required>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Площадь застройки (кв.м)</label>
                            <input name="size_home" type="text" class="form-control" id="" placeholder="Названия" required>
                        </div>

                        <input type="hidden" name="category_id" value="{{$category->id}}">


                        <style>
                            #set_placemark_map {
                                width: 100%;
                                height: 400px;
                            }
                        </style>
                        <label for="set_placemark_map" class="pt-3">Выберите координаты объекта</label>
                        <div id="set_placemark_map"></div>

                        <div class="row pt-3">
                            <div class="form-group col-sm-12 col-md-6" bis_skin_checked="1">
                                <label for="">Широта (вводить через точку)</label>
                                <input name="lat" type="text" class="form-control" id="lat" placeholder="Широта">
                            </div>
                            <div class="form-group col-sm-12 col-md-6" bis_skin_checked="1">
                                <label for="">Долгота (вводить через точку)</label>
                                <input name="long" type="text" class="form-control" id="long" placeholder="Долгота">
                            </div>
                        </div>

                        <div class="form-group pt-5" bis_skin_checked="1">
                            <label for="">Расположение на Русском</label>
                            <textarea name="disposition"  class="form-control" id="" placeholder="Расположение"></textarea>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Расположение на Англиском</label>
                            <textarea name="disposition_en"  class="form-control" id="" placeholder="Расположение на Англиском"></textarea>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Расположение на Турецком</label>
                            <textarea name="disposition_tr"  class="form-control" id="" placeholder="Расположение на Турецком"></textarea>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Расположение на Немецком</label>
                            <textarea name="disposition_de"  class="form-control" id="" placeholder="Расположение на Немецком"></textarea>
                        </div>


                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Описание на Русском</label>
                            <textarea name="description"  class="form-control" id="" placeholder="Описание"></textarea>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Описание на Англиском</label>
                            <textarea name="description_en"  class="form-control" id="" placeholder="Описание на Англиском"></textarea>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Описание на Турецком</label>
                            <textarea name="description_tr"  class="form-control" id="" placeholder="Описание на Турецком"></textarea>
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="">Описание на Немецком</label>
                            <textarea name="description_de"  class="form-control" id="" placeholder="Описание на Немецком"></textarea>
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
@section('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2a0f0e9d-44f3-4f13-8628-12588d752fc3" type="text/javascript"></script>
    <script src="{{ asset('admin/js/ymapSetPlaceMark.js') }}"></script>
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
            document.getElementById('accordion'+el.dataset.identificator).remove();
            checkAccordions();
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

                    // accordions[i].childNodes[0].childNodes[0] нашли .card-header
                    // console.log(accordions[i].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[0].id = "heading"+i;

                    // accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0] нашли .card-header
                    console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].dataset.target = "#collapse"+i;
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].ariaControls = "collapse"+i; // ?
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].textContent  = "Объект #"+i;

                    // accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1] нашли input[type='hidden'] add_id
                    console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].name = "add_id"+i;
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].value = i;
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].id = "add_id"+i;

                    // accordions[i].childNodes[0].childNodes[1] нашли .collapse
                    // console.log(accordions[i].childNodes[0].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].id = "collapse"+i;
                    accordions[i].childNodes[0].childNodes[1].ariaLabelledby = "heading"+i;
                    accordions[i].childNodes[0].childNodes[1].dataset.parent = "#accordion"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[6] нашли .delete_accordion
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[7]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[7].dataset.identificator = i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1] нашли add_building
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0].htmlFor = "add_building"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].id = "add_building"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].name = "add_building"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1] нашли label add_price
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].childNodes[2]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].childNodes[1].htmlFor = "add_price"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].childNodes[2].id = "add_price"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].childNodes[2].name = "add_price"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1] нашли select add_price
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[3].childNodes[3]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[3].childNodes[3].name = "add_price_code"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2].childNodes[1] нашли add_size
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[3].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[3].childNodes[0].htmlFor = "add_size"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[3].childNodes[1].id = "add_size"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[3].childNodes[1].name = "add_size"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[3].childNodes[1] нашли add_apartment_layout
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[4].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[4].childNodes[0].htmlFor = "add_apartment_layout"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[4].childNodes[1].id = "add_apartment_layout"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[4].childNodes[1].name = "add_apartment_layout"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[4].childNodes[1] нашли add_floor
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[5].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[5].childNodes[0].htmlFor = "add_floor"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[5].childNodes[1].id = "add_floor"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[5].childNodes[1].name = "add_floor"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[5].childNodes[1] нашли add_apartment_layout_image
                    // console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[6].childNodes[2].childNodes[1]);
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
