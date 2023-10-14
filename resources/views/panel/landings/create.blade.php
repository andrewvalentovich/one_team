@extends('panel.layouts.default')
@section('title')
    {{__("Создание лендинга")}}
@endsection

@section('content')
    <style>
        input{
            color: white !important;
        }
        textarea{
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
                    <h4 class="card-title">{{ __('Создание лендинга') }}</h4>
                    <form class="forms-sample" id="create_landings_form" action="{{ route('panel.landings.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row py-3" bis_skin_checked="1">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="col-sm-12 col-md-6 form-group unfilterable">
                                <label for="subdomain">{{ __('Поддомен') }}</label>
                                <input name="subdomain" type="text" class="form-control" id="subdomain" placeholder="{{ __('Поддомен') }}">
                                <label class="text-danger font-weight-normal" for="subdomain" id="subdomain_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 form-group unfilterable">
                                <label for="template_select">{{ __('Шаблон сайта') }}</label>
                                <select class="form-control" name="template_id" id="template_select" style="color: #e2e8f0">
                                    <option value="">{{ __('Выбор шаблона') }}</option>
                                    @foreach($templates as $template)
                                        <option value="{{ $template->id }}" data-path="{{ $template->path }}">{{ $template->name }}</option>
                                    @endforeach
                                </select>
                                <label class="text-danger font-weight-normal" for="template_id" id="template_id_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 form-group" data-select="country" style="display: none;">
                                <label>{{ __('Выбор страны') }}</label>
                                <select class="form-control" style="color: #e2e8f0">
                                    <option value="">{{ __('Выбор страны') }}</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <label class="text-danger font-weight-normal" for="relation_id" id="relation_id" id="relation_id_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 form-group" data-select="region" style="display: none;">
                                <label>{{ __('Выбор региона') }}</label>
                                <select class="form-control" style="color: #e2e8f0">
                                    <option value="">{{ __('Выбор региона') }}</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name.", ".$city->country->name }}</option>
                                    @endforeach
                                </select>
                                <label class="text-danger font-weight-normal" for="relation_id" id="relation_id_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 form-group" data-select="complex" style="display: none;">
                                <label>{{ __('Выбор ЖК') }}</label>
                                <select class="form-control" style="color: #e2e8f0">
                                    <option value="">{{ __('Выбор ЖК') }}</option>
                                    @foreach($complexes as $complex)
                                        <option value="{{ $complex->id }}">{{ $complex->id }} - {{ $complex->name }}</option>
                                    @endforeach
                                </select>
                                <label class="text-danger font-weight-normal" for="relation_id" id="relation_id_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 form-group region country complex" style="display: none;">
                                <label for="phone">{{ __('Номер телефона') }}</label>
                                <input name="phone" type="text" class="form-control" id="phone" placeholder="{{ __('Номер телефона') }}">
                                <label class="text-danger font-weight-normal" for="phone" id="phone_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 region country complex" style="display: none;">Главный экран</h3>
                            <div class="col-12 form-group pt-3 complex" style="display: none;">
                                <label for="main_location">{{ __('Локация/регион для главного блока') }}</label>
                                <input name="main_location" type="text" class="form-control" id="main_location" placeholder="{{ __('Локация/регион для главного блока') }}">
                                <label class="text-danger font-weight-normal" for="main_location" id="main_location_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 form-group pt-3 region country complex" bis_skin_checked="1" style="display: none;">
                                <label for="main_title">{{ __('Заголовок главного блока') }}</label>
                                <input name="main_title" type="text" class="form-control" id="main_title" placeholder="{{ __('Заголовок главного блока') }}">
                                <label class="text-danger font-weight-normal" for="main_title" id="main_title_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 form-group pt-3 complex" bis_skin_checked="1" style="display: none;">
                                <label for="main_subtitle">{{ __('Подзаголовок главного блока') }}</label>
                                <input name="main_subtitle" type="text" class="form-control" id="main_subtitle" placeholder="{{ __('Подзаголовок главного блока') }}">
                                <label class="text-danger font-weight-normal" for="main_subtitle" id="main_subtitle_error"></label>
                            </div>

                            <div class="col-12 form-group pt-3 region country complex" bis_skin_checked="1" style="display: none;">
                                <label for="main_content">{{ __('Контент главного блока') }}</label>
                                <div>
                                    <textarea id="main_content" class="textarea" name="main_content"></textarea>
                                </div>
                                <label class="text-danger font-weight-normal" for="main_content" id="main_content_error"></label>
                            </div>

                            <div class="col-12 form-group region country complex" style="display: none;">
                                <div>
                                    <div class="preview_image" style="display: inline-block; position: relative;">
                                        <span onclick="closeUploadedImage(this);" class="preview_image-close" style="width: 25px; height: 25px; display: block; background: #fff; position: absolute; top: 35px; right: 10px; display: none"></span>
                                        <img class="py-3" src="" alt="" style="max-width: 300px; max-height: 300px;">
                                    </div>
                                    <label class="d-block" for="main_photo">{{ __('Фотография фона главного блока') }}</label>
                                    <input type="file" name="main_photo" onchange="displayUploadedImage(this);" class="form-control-file" id="main_photo">
                                </div>
                                <label class="text-danger font-weight-normal" for="main_photo" id="main_photo_error"></label>
                            </div>

                            <div class="col-12 form-group pt-3 region country complex" style="display: none;">
                                <label for="card">{{ __('Списки для главного блока') }}</label>
                                <div class="card">
                                    <div class="card-header row" style="gap: 30px 0;" id="main_lists_field">
                                    </div>
                                    <div class="card-body">
                                        <p class="btn btn-outline-primary accordion_add" data-type="main_lists">{{ __('Добавить список') }}</p>
                                    </div>
                                </div>
                                <label class="text-danger font-weight-normal" for="main_lists" id="main_lists_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 region country" style="display: none;">Блок с объектами</h3>
                            <div class="col-12 form-group pt-3 region country" style="display: none;">
                                <label for="objects_title">{{ __('Заголовок блока с объектами') }}</label>
                                <input name="objects_title" type="text" class="form-control" id="objects_title" placeholder="{{ __('Новостройки в Турции') }}">
                                <label class="text-danger font-weight-normal" for="objects_title" id="objects_title_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 complex" style="display: none;">Блок с описанием ЖК</h3>
                            <div class="col-sm-12 col-md-6 form-group pt-3 complex" style="display: none;">
                                <label for="about_title">{{ __('Заголовок') }}</label>
                                <input name="about_title" type="text" class="form-control" id="about_title" placeholder="{{ __('PERGE COLLECTION: SKY BLUE') }}">
                                <label class="text-danger font-weight-normal" for="about_title" id="about_title_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 form-group pt-3 complex" style="display: none;">
                                <label for="about_subtitle">{{ __('Подзаголовок') }}</label>
                                <input name="about_subtitle" type="text" class="form-control" id="about_subtitle" placeholder="{{ __('БИЗНЕС-КЛАСС НА БЕРЕГУ СРЕДИЗЕМНОГО МОРЯ') }}">
                                <label class="text-danger font-weight-normal" for="about_subtitle" id="about_subtitle_error"></label>
                            </div>

                            <div class="col-12 form-group pt-3 complex" style="display: none;">
                                <label for="card">{{ __('Карточки с описанием ЖК') }}</label>
                                <div class="card">
                                    <div class="card-header" id="about_description_field">
                                    </div>
                                    <div class="card-body">
                                        <p class="btn btn-outline-primary accordion_add" data-type="about_description" id="about_description_add">{{ __('Добавить карточку') }}</p>
                                    </div>
                                </div>
                                <label class="text-danger font-weight-normal" for="about_description" id="about_description_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 complex" style="display: none;">Блок территория ЖК</h3>
                            <div class="col-12 form-group pt-3 complex" style="display: none;">
                                <div>
                                    <div class="preview_image" style="display: inline-block; position: relative;">
                                        <span onclick="closeUploadedImage(this);" class="preview_image-close" style="width: 25px; height: 25px; display: block; background: #fff; position: absolute; top: 35px; right: 10px; display: none"></span>
                                        <img class="py-3" src="" alt="" style="max-width: 300px; max-height: 300px;">
                                    </div>
                                    <label class="d-block" for="territory">{{ __('Фотография-план территории ЖК') }}</label>
                                    <input type="file" name="territory" onchange="displayUploadedImage(this);" class="form-control-file" id="territory">
                                </div>
                                <label class="text-danger font-weight-normal" for="territory" id="territory_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 region country complex" style="display: none;">Блок с картой</h3>
                            <div class="col-12 form-group pt-3 region country complex" style="display: none;">
                                <label for="map">{{ __('Вставьте скрипт с картой') }}</label>
                                <div>
                                    <textarea class="form-control" rows="10" id="map" name="map"></textarea>
                                </div>
                                <label class="text-danger font-weight-normal" for="map" id="map_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 region country complex" style="display: none;">Блок с условиями покупки</h3>
                            <div class="col-12 form-group pt-3 region country complex" style="display: none;">
                                <label for="card">{{ __('Карточки с условиями покупки') }}</label>
                                <div class="card">
                                    <div class="card-header row" id="purchase_terms_field">
                                    </div>
                                    <div class="card-body">
                                        <p class="btn btn-outline-primary accordion_add" data-type="purchase_terms" id="purchase_terms_add">{{ __('Добавить карточку') }}</p>
                                    </div>
                                </div>
                                <label class="text-danger font-weight-normal" for="purchase_terms" id="purchase_terms_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 region country complex" style="display: none;">Блок ВНЖ</h3>
                            <div class="col-12 form-group pt-3 region country complex" bis_skin_checked="1" style="display: none;">
                                <label for="vnj_title">{{ __('Заголовок блока ВНЖ') }}</label>
                                <input name="vnj_title" type="text" class="form-control" id="vnj_title" placeholder="{{ __('Вид на жительство в Турции') }}">
                                <label class="text-danger font-weight-normal" for="vnj_title" id="vnj_title_error"></label>
                            </div>

                            <div class="col-12 form-group pt-3 region country complex" bis_skin_checked="1" style="display: none;">
                                <label for="vnj_content">{{ __('Контент блока ВНЖ') }}</label>
                                <div>
                                    <textarea id="vnj_content" class="textarea" name="vnj_content">
                                        <p>Покупая квартиру в ЖК &laquo;Perge Collection: sky blue&raquo; вы не только приобретаете жилье в большом курортном городе с отличным климатом, которое можно сдавать в аренду, но и получаете более ценные преимущества, такие, как вид на жительство в Турции или даже гражданство.</p>
 <p>ВНЖ имеет ряд несомненных плюсов, вы можете круглогодично жить в стране, открыть свой бизнес, бесплатно пользоваться некоторыми государственными услугами, а также претендовать на турецкое гражданство уже через 5 лет после приобретения недвижимости.</p>
 <p>Турецкий паспорт позволит вам пользоваться всеми привилегиями этого государства, путешествовать в безвизовом режиме более чем по 110 странам, получить право открыть свое дело в США и Великобритании и многое другое.</p>
 <p>Процесс оформления проходит достаточно быстро и просто, а это значит, что, приобретая квартиру в нашем жилищном комплексе, вы инвестируете в свое будущее.</p>
                                    </textarea>
                                </div>
                                <label class="text-danger font-weight-normal" for="vnj_content" id="vnj_content_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 region country" style="display: none;">Блок с достопримечательностями</h3>
                            <div class="col-12 form-group pt-3 region country" bis_skin_checked="1" style="display: none;">
                                <label for="sight_title">{{ __('Заголовок') }}</label>
                                <input name="sight_title" type="text" class="form-control" id="sight_title" placeholder="{{ __('Достопримечательности Анталии') }}">
                                <label class="text-danger font-weight-normal" for="sight_title" id="sight_title_error"></label>
                            </div>

                            <div class="col-12 form-group pt-3 region country" bis_skin_checked="1" style="display: none;">
                                <label for="card">{{ __('Карточки с достопримечательностями') }}</label>
                                <div class="card">
                                    <div class="card-header" id="sight_cards_field">
                                    </div>
                                    <div class="card-body">
                                        <p class="btn btn-outline-primary accordion_add" data-type="sight_cards" id="sight_cards_add">{{ __('Добавить карточку') }}</p>
                                    </div>
                                </div>
                                <label class="text-danger font-weight-normal" for="sight_cards" id="sight_cards_error"></label>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-inverse-success btn-fw" id="landings_create_button">{{ __('Создать') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function initEditors() {
            tinymce.init({
                selector: '.textarea',
                plugins: 'a_tinymce_plugin',
                a_plugin_option: true,
                a_configuration_option: 400,
                plugins: 'advlist link image lists',
                plugins: 'code',
                toolbar: 'a11ycheck|language | undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent|code'
            });
        }

        $(document).ready(function () {
            tinyMCE.remove();
            initEditors();
        });

        $('#template_select').on('change', function() {
            var data_path = $(this).find('option:selected').attr('data-path');
            $('.form-group[data-select]').hide();
            $('.form-group:not(.unfilterable)').hide();
            $('.forms-sample').find('h3').hide();

            $('.form-group[data-select="'+data_path+'"]').show();
            $('.form-control[name="relation_id"]').removeAttr('name');
            $('.form-group[data-select="'+data_path+'"] select').attr('name', 'relation_id');
            $('.forms-sample').find('.'+data_path).show();
        });

        function displayUploadedImage(el) {
            var file = el.files[0];
            var reader = new FileReader();

            if(file) {
                reader.onload = function(e) {
                    $(el).siblings('.preview_image').find('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
                $(el).siblings('.preview_image').find('span').fadeIn();
            }
        }

        function closeUploadedImage(el) {
            var input = el.parentNode.nextSibling.nextSibling.nextSibling.nextSibling;
            input.value = null;
            el.style.display = "none";
            el.nextSibling.nextSibling.src = "";
        }

        // Добавление элемента в dom с правильным порядковым номером
        // Для корректной работы данной функции и целой логики - необходимо:
        // 1. Для кнопки, которая отвечает за добавление элемента присвоить аттрибут data-type со значением префикса, например main_lists
        // 2. Создать функцию get_префикс_accordion (пример, get_main_lists_accordion), где будет храниться dom-структура (вёрстка)
        // 3. Создать функцию check_префикс_accordions (пример, check_main_lists_accordions), где будет производиться проверка полей на корректность идентификатора

        $('.accordion_add').on('click', function () {
            let prefix = $(this).attr('data-type');
            let accordionCount = $('.'+prefix+'_accordion').length;

            $('#'+prefix+'_field').append(window["get_"+prefix+"_accordion"](accordionCount));
            tinyMCE.remove();
            initEditors();
        });

        // Удаление объекта по его порядковому номеру
        function delete_accordion(prefix, el) {
            document.getElementById(prefix+'_accordion'+el.dataset.identificator).remove();
            window["check_"+prefix+"_accordions"](0);
        }

        // Получаем структуру блока main_lists_accordion
        function get_main_lists_accordion(id) {
            return "<div class='main_lists_accordion col-sm-12 col-md-3' data-identificator='"+ id +"' id='main_lists_accordion" + id + "'>"+
                "<div class='card'>"+
                "<div class='card-header' id='main_lists_heading" + id + "'>"+
                "<h5 class='mb-0'>"+
                "<p class='btn btn-link' data-toggle='collapse' data-target='#main_lists_collapse" + id + "' aria-expanded='true' aria-controls='main_lists_collapse" + id + "'>"+
                "Список #" + id +
                "</p>"+
                "<input name='main_lists["+id+"][id]' type='hidden' value='"+id+"'>"+
                "</h5>"+
                "</div>"+
                "<div id='main_lists_collapse" + id + "' class='collapse show' aria-labelledby='main_lists_heading" + id + "' data-parent='#main_lists_accordion" + id + "'>"+
                "<div class='card-body'>"+
                "<div class='form-group' bis_skin_checked='1' style='display: block;'>"+
                "<div class='form-group' bis_skin_checked='1'>"+
                "<label for='main_lists_title"+id+"'>Заголовок</label>"+
                "<input name='main_lists["+id+"][title]' type='text' class='form-control' id='main_lists_title"+id+"' placeholder='310'>"+
                "</div>"+
                "<div class='form-group' bis_skin_checked='1'>"+
                "<label for='main_lists_content"+id+"'>Текст</label>"+
                "<input name='main_lists["+id+"][content]' type='text' class='form-control' id='main_lists_content"+id+"' placeholder='Солнечных дней в году'>"+
                "</div>"+
                "<p class='btn btn-outline-danger delete_main_lists_accordion' onclick='delete_accordion(\"main_lists\", this);' data-identificator='"+ id +"'>Удалить элемент списка</p>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>";
        }

        // Проверка и исправление порядкового номера каждого аккордиона main_lists
        function check_main_lists_accordions() {
            let prefix = 'main_lists';
            let accordions = document.querySelectorAll('.'+prefix+'_accordion');
            let accordionsCount = accordions.length;

            // Проверяем id и имена классов, для "выравнивания" id и имён классов по порядку и корректной работы элементов
            // id 1 4 5 8 -> id 0 1 2 3, для передачи в JSON-объект в будущем
            // ВАЖНО!!! все изменяемые поля должны содержать префикс например main_lists_collapse
            // а свойство name тегов input должны содержать имя префикса main_lists[i][имя поля]
            for(let i = 0; i < accordionsCount; i++) {
                // console.log('ident = '+accordions[i].dataset.identificator);
                // console.log('i = '+i);
                if (i != Number(accordions[i].dataset.identificator)) {
                    // console.log('- Не совпало -');

                    // accordions[i] нашли .accordion
                    // console.log(accordions[i]);
                    accordions[i].dataset.identificator = i;
                    accordions[i].id = prefix+"_accordion"+i;

                    // accordions[i].childNodes[0].childNodes[0] нашли .card-header
                    // console.log(accordions[i].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[0].id = prefix+"_heading"+i;

                    // console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);

                    // accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0] нашли .card-header
                    console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].dataset.target = "#"+prefix+"_collapse"+i;
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].ariaControls = prefix+"_collapse"+i; // ?
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].textContent  = "Объект #"+i;

                    // accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1] нашли input[type='hidden'] add_id
                    console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].name = prefix+"["+i+"][id]";
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].value = i;
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].id = prefix+"_add_id"+i;

                    // accordions[i].childNodes[0].childNodes[1] нашли .collapse
                    console.log(accordions[i].childNodes[0].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].id = prefix+"_collapse"+i;
                    accordions[i].childNodes[0].childNodes[1].ariaLabelledby = prefix+"_heading"+i;
                    accordions[i].childNodes[0].childNodes[1].dataset.parent = "#"+prefix+"_accordion"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[6] нашли .delete_accordion
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2].dataset.identificator = i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1] нашли add_building
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0].for = prefix+"_title"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].id = prefix+"_title"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].name = prefix+"["+i+"][title]";

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1] нашли add_price
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[0].for = prefix+"_content"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].id = prefix+"_content"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].name = prefix+"["+i+"][content]";
                }
            }
        }

        // Получаем структуру блока purchase_terms_accordion
        function get_purchase_terms_accordion(id) {
            return "<div class='purchase_terms_accordion col-sm-12 col-md-6' data-identificator='"+ id +"' id='purchase_terms_accordion" + id + "'>"+
                "<div class='card'>"+
                "<div class='card-header' id='purchase_terms_heading" + id + "'>"+
                "<h5 class='mb-0'>"+
                "<p class='btn btn-link' data-toggle='collapse' data-target='#purchase_terms_collapse" + id + "' aria-expanded='true' aria-controls='purchase_terms_collapse" + id + "'>"+
                "Карточка #" + id +
                "</p>"+
                "<input name='purchase_terms["+id+"][id]' type='hidden' value='"+id+"'>"+
                "</h5>"+
                "</div>"+
                "<div id='purchase_terms_collapse" + id + "' class='collapse show' aria-labelledby='purchase_terms_heading" + id + "' data-parent='#purchase_terms_accordion" + id + "'>"+
                "<div class='card-body'>"+
                "<div class='form-group' bis_skin_checked='1' style='display: block;'>"+
                "<div class='form-group' bis_skin_checked='1'>"+
                "<label for='purchase_terms_title"+id+"'>Заголовок</label>"+
                "<input name='purchase_terms["+id+"][title]' type='text' class='form-control' id='purchase_terms_title"+id+"' placeholder='310'>"+
                "</div>"+
                "<div class='form-group' bis_skin_checked='1'>"+
                    "<label for='purchase_terms_content"+id+"'>Текст</label>"+
                    "<div>"+
                        "<textarea id='purchase_terms' class='textarea' name='purchase_terms["+id+"][content]'></textarea>"+
                    "</div>"+
                "</div>"+
                "<p class='btn btn-outline-danger delete_purchase_terms_accordion' onclick='delete_accordion(\"purchase_terms\", this);' data-identificator='"+ id +"'>Удалить элемент списка</p>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>";
        }

        // Проверка и исправление порядкового номера каждого аккордиона purchase_terms
        function check_purchase_terms_accordions() {
            let prefix = 'purchase_terms';
            let accordions = document.querySelectorAll('.'+prefix+'_accordion');
            let accordionsCount = accordions.length;

            // Проверяем id и имена классов, для "выравнивания" id и имён классов по порядку и корректной работы элементов
            // id 1 4 5 8 -> id 0 1 2 3, для передачи в JSON-объект в будущем
            // ВАЖНО!!! все изменяемые поля должны содержать префикс например main_lists_collapse
            // а свойство name тегов input должны содержать имя префикса main_lists[i][имя поля]
            for(let i = 0; i < accordionsCount; i++) {
                // console.log('ident = '+accordions[i].dataset.identificator);
                // console.log('i = '+i);
                if (i != Number(accordions[i].dataset.identificator)) {
                    // console.log('- Не совпало -');

                    // accordions[i] нашли .accordion
                    // console.log(accordions[i]);
                    accordions[i].dataset.identificator = i;
                    accordions[i].id = prefix+"_accordion"+i;

                    // accordions[i].childNodes[0].childNodes[0] нашли .card-header
                    // console.log(accordions[i].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[0].id = prefix+"_heading"+i;

                    // console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);

                    // accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0] нашли .card-header
                    console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].dataset.target = "#"+prefix+"_collapse"+i;
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].ariaControls = prefix+"_collapse"+i; // ?
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].textContent  = "Карточка #"+i;

                    // accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1] нашли input[type='hidden'] add_id
                    console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].name = prefix+"["+i+"][id]";
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].value = i;
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].id = prefix+"_add_id"+i;

                    // accordions[i].childNodes[0].childNodes[1] нашли .collapse
                    console.log(accordions[i].childNodes[0].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].id = prefix+"_collapse"+i;
                    accordions[i].childNodes[0].childNodes[1].ariaLabelledby = prefix+"_heading"+i;
                    accordions[i].childNodes[0].childNodes[1].dataset.parent = "#"+prefix+"_accordion"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[6] нашли .delete_accordion
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2].dataset.identificator = i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1] нашли title
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0].for = prefix+"_title"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].id = prefix+"_title"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].name = prefix+"["+i+"][title]";

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1] нашли content
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[0].for = prefix+"_content"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].id = prefix+"_content"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].name = prefix+"["+i+"][content]";
                }
            }
        }

        // Получаем структуру блока about_description_accordion
        function get_about_description_accordion(id) {
            return "<div class='about_description_accordion col-12' data-identificator='"+ id +"' id='about_description_accordion" + id + "'>"+
                "<div class='card'>"+
                "<div class='card-header' id='about_description_heading" + id + "'>"+
                "<h5 class='mb-0'>"+
                "<p class='btn btn-link' data-toggle='collapse' data-target='#about_description_collapse" + id + "' aria-expanded='true' aria-controls='about_description_collapse" + id + "'>"+
                "Карточка #" + id +
                "</p>"+
                "<input name='about_description["+id+"][id]' type='hidden' value='"+id+"'>"+
                "</h5>"+
                "</div>"+
                "<div id='about_description_collapse" + id + "' class='collapse show' aria-labelledby='about_description_heading" + id + "' data-parent='#about_description_accordion" + id + "'>"+
                "<div class='card-body'>"+
                "<div class='form-group' bis_skin_checked='1' style='display: block;'>"+
                "<div class='form-group' bis_skin_checked='1'>"+
                    "<label for='about_description_title"+id+"'>Заголовок</label>"+
                    "<input name='about_description["+id+"][title]' type='text' class='form-control' id='about_description_title"+id+"' placeholder='Большая закрытая территория с двумя бассейнами'>"+
                "</div>"+
                "<div class='form-group' bis_skin_checked='1'>"+
                    "<label for='about_description_content"+id+"'>Текст</label>"+
                    "<div>"+
                        "<textarea id='about_description' class='textarea' name='about_description["+id+"][content]'></textarea>"+
                    "</div>"+
                "</div>"+
                "<div class='form-group'>\n" +
                    "<div>\n" +
                        "<div class='preview_image' style='display: inline-block; position: relative;'>\n" +
                            "<span onclick='closeUploadedImage(this);' class='preview_image-close' style='width: 25px; height: 25px; display: block; background: #fff; position: absolute; top: 35px; right: 10px; display: none'></span>\n" +
                            "<img class='py-3' src='' alt='' style='max-width: 300px; max-height: 300px;'>\n" +
                        "</div>\n" +
                        "<label class='d-block' for='about_description_photo'>Фотография карточки блока о ЖК</label>\n" +
                        "<input type='file' name='about_description["+id+"][photo]' onchange='displayUploadedImage(this);' class='form-control-file' id='about_description_photo'>\n" +
                    "</div>\n" +
                "</div>"+
                "<p class='btn btn-outline-danger delete_about_description_accordion' onclick='delete_accordion(\"about_description\", this);' data-identificator='"+ id +"'>Удалить элемент списка</p>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>";
        }

        // Проверка и исправление порядкового номера каждого аккордиона about_description
        function check_about_description_accordions() {
            let prefix = 'about_description';
            console.log(prefix);
            let accordions = document.querySelectorAll('.'+prefix+'_accordion');
            let accordionsCount = accordions.length;

            // Проверяем id и имена классов, для "выравнивания" id и имён классов по порядку и корректной работы элементов
            // id 1 4 5 8 -> id 0 1 2 3, для передачи в JSON-объект в будущем
            // ВАЖНО!!! все изменяемые поля должны содержать префикс например about_collapse
            // а свойство name тегов input должны содержать имя префикса about[i][имя поля]

            for(let i = 0; i < accordionsCount; i++) {
                // console.log('ident = '+accordions[i].dataset.identificator);
                // console.log('i = '+i);
                if (i != Number(accordions[i].dataset.identificator)) {
                    // console.log('- Не совпало -');

                    // accordions[i] нашли .accordion
                    console.log(accordions[i]);
                    accordions[i].dataset.identificator = i;
                    accordions[i].id = prefix+"_accordion"+i;

                    // accordions[i].childNodes[0].childNodes[0] нашли .card-header
                    console.log(accordions[i].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[0].id = prefix+"_heading"+i;

                    // console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);

                    // accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0] нашли .card-header
                    console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].dataset.target = "#"+prefix+"_collapse"+i;
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].ariaControls = prefix+"_collapse"+i; // ?
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].textContent  = "Карточка #"+i;

                    // accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1] нашли input[type='hidden'] add_id
                    console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].name = prefix+"["+i+"][id]";
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].value = i;
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].id = prefix+"_add_id"+i;

                    // accordions[i].childNodes[0].childNodes[1] нашли .collapse
                    console.log(accordions[i].childNodes[0].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].id = prefix+"_collapse"+i;
                    accordions[i].childNodes[0].childNodes[1].ariaLabelledby = prefix+"_heading"+i;
                    accordions[i].childNodes[0].childNodes[1].dataset.parent = "#"+prefix+"_accordion"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[6] нашли .delete_accordion
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[3]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[3].dataset.identificator = i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1] нашли title
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0].htmlFor = prefix+"_title"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].id = prefix+"_title"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].name = prefix+"["+i+"][title]";

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1] нашли content
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[0].htmlFor = prefix+"_content"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].id = prefix+"_content"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].name = prefix+"["+i+"][content]";

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1] нашли photo
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2].childNodes[1].childNodes[3].htmlFor = prefix+"_photo"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2].childNodes[1].childNodes[5].name = prefix+"["+i+"][photo]";
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2].childNodes[1].childNodes[5].id = prefix+"_content"+i;
                }
            }
        }

        // Получаем структуру блока sight_cards_accordion
        function get_sight_cards_accordion(id) {
            return "<div class='sight_cards_accordion col-12' data-identificator='"+ id +"' id='sight_cards_accordion" + id + "'>"+
                "<div class='card'>"+
                "<div class='card-header' id='sight_cards_heading" + id + "'>"+
                "<h5 class='mb-0'>"+
                "<p class='btn btn-link' data-toggle='collapse' data-target='#sight_cards_collapse" + id + "' aria-expanded='true' aria-controls='sight_cards_collapse" + id + "'>"+
                "Карточка #" + id +
                "</p>"+
                "<input name='sight_cards["+id+"][id]' type='hidden' value='"+id+"'>"+
                "</h5>"+
                "</div>"+
                "<div id='sight_cards_collapse" + id + "' class='collapse show' aria-labelledby='sight_cards_heading" + id + "' data-parent='#sight_cards_accordion" + id + "'>"+
                "<div class='card-body'>"+
                "<div class='form-group' bis_skin_checked='1' style='display: block;'>"+
                "<div class='form-group' bis_skin_checked='1'>"+
                    "<label for='sight_cards_title"+id+"'>Заголовок</label>"+
                    "<input name='sight_cards["+id+"][title]' type='text' class='form-control' id='sight_cards_title"+id+"' placeholder='Большая закрытая территория с двумя бассейнами'>"+
                "</div>"+
                "<div class='form-group' bis_skin_checked='1'>"+
                    "<label for='sight_cards_content"+id+"'>Текст</label>"+
                    "<div>"+
                        "<textarea id='main_content' class='textarea' name='sight_cards["+id+"][content]'></textarea>"+
                    "</div>"+
                "</div>"+
                "<div class='form-group'>\n" +
                    "<div>\n" +
                        "<div class='preview_image' style='display: inline-block; position: relative;'>\n" +
                            "<span onclick='closeUploadedImage(this);' class='preview_image-close' style='width: 25px; height: 25px; display: block; background: #fff; position: absolute; top: 35px; right: 10px; display: none'></span>\n" +
                            "<img class='py-3' src='' alt='' style='max-width: 300px; max-height: 300px;'>\n" +
                        "</div>\n" +
                        "<label class='d-block' for='sight_cards_photo'>Фотография достопримечательности</label>\n" +
                        "<input type='file' name='sight_cards["+id+"][photo]' onchange='displayUploadedImage(this);' class='form-control-file' id='sight_cards_photo'>\n" +
                    "</div>\n" +
                "</div>"+
                "<p class='btn btn-outline-danger delete_sight_cards_accordion' onclick='delete_accordion(\"sight_cards\", this);' data-identificator='"+ id +"'>Удалить элемент списка</p>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>";
        }

        // Проверка и исправление порядкового номера каждого аккордиона sight_cards
        function check_sight_cards_accordions() {
            let prefix = 'sight_cards';
            console.log(prefix);
            let accordions = document.querySelectorAll('.'+prefix+'_accordion');
            let accordionsCount = accordions.length;

            // Проверяем id и имена классов, для "выравнивания" id и имён классов по порядку и корректной работы элементов
            // id 1 4 5 8 -> id 0 1 2 3, для передачи в JSON-объект в будущем
            // ВАЖНО!!! все изменяемые поля должны содержать префикс например about_collapse
            // а свойство name тегов input должны содержать имя префикса about[i][имя поля]

            for(let i = 0; i < accordionsCount; i++) {
                // console.log('ident = '+accordions[i].dataset.identificator);
                // console.log('i = '+i);
                if (i != Number(accordions[i].dataset.identificator)) {
                    // console.log('- Не совпало -');

                    // accordions[i] нашли .accordion
                    // console.log(accordions[i]);
                    accordions[i].dataset.identificator = i;
                    accordions[i].id = prefix+"_accordion"+i;

                    // accordions[i].childNodes[0].childNodes[0] нашли .card-header
                    // console.log(accordions[i].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[0].id = prefix+"_heading"+i;

                    // console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);

                    // accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0] нашли .card-header
                    // console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].dataset.target = "#"+prefix+"_collapse"+i;
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].ariaControls = prefix+"_collapse"+i; // ?
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0].textContent  = "Карточка #"+i;

                    // accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1] нашли input[type='hidden'] add_id
                    // console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].name = prefix+"["+i+"][id]";
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].value = i;
                    accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[1].id = prefix+"_add_id"+i;

                    // accordions[i].childNodes[0].childNodes[1] нашли .collapse
                    // console.log(accordions[i].childNodes[0].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].id = prefix+"_collapse"+i;
                    accordions[i].childNodes[0].childNodes[1].ariaLabelledby = prefix+"_heading"+i;
                    accordions[i].childNodes[0].childNodes[1].dataset.parent = "#"+prefix+"_accordion"+i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[6] нашли .delete_accordion
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[3]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[3].dataset.identificator = i;

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1] нашли title
                    // console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0].htmlFor = prefix+"_title"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].id = prefix+"_title"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].name = prefix+"["+i+"][title]";

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1] нашли content
                    // console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[0].htmlFor = prefix+"_content"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].id = prefix+"_content"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].name = prefix+"["+i+"][content]";

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1] нашли photo
                    // console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2].childNodes[1].childNodes[3].htmlFor = prefix+"_photo"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2].childNodes[1].childNodes[5].name = prefix+"["+i+"][photo]";
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[2].childNodes[1].childNodes[5].id = prefix+"_content"+i;
                }
            }
        }

        // При "сабмите" формы...
        $('#create_landings_form').on('submit', function (e) {
            e.preventDefault();

            tinyMCE.remove();
            initEditors();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let formData = new FormData(this);

            for (const [key, value] of formData.entries()) {
                console.log(key, value);
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('panel.landings.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    alert("Success");
                    console.log(data);
                    window.location.href = "{{ route('panel.landings.index') }}";
                },
                error: function (reject) {
                    if( reject.status == 422 ) {
                        var errors = $.parseJSON(reject.responseText);
                        // console.log(errors);
                        $.each(errors.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });

                        alert("Error, correct specific fields!");
                    } else {
                        alert("Error "+reject.status);
                    }
                }
            });
        });
    </script>
@endsection
