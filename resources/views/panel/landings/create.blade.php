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

                        <div class="col-md-6 pl-0 py-3" bis_skin_checked="1">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="form-group" bis_skin_checked="1">
                                <label for="subdomain">{{ __('Поддомен') }}</label>
                                <input name="subdomain" type="text" class="form-control" id="subdomain" placeholder="{{ __('Поддомен') }}">
                            </div>
                            @error('subdomain')
                                <label class="text-danger font-weight-normal" for="subdomain">{{ $message }}</label>
                            @enderror

                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-12 col-form-label">{{ __('Шаблон сайта') }}</label>
                                <div class="col-sm-12" bis_skin_checked="1">
                                    <select class="form-control" name="template_id" style="color: #e2e8f0">
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}">{{ $template->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('template_id')
                                    <label class="text-danger font-weight-normal" for="template_id">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-12 col-form-label">{{ __('Параметры') }}</label>
                                <div class="col-sm-12" bis_skin_checked="1">
                                    <select class="form-control" name="template_id" style="color: #e2e8f0">
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}">{{ $template->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('template_id')
                                    <label class="text-danger font-weight-normal" for="template_id">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="phone">{{ __('Номер телефона') }}</label>
                                <input name="phone" type="text" class="form-control" id="phone" placeholder="{{ __('Номер телефона') }}">
                                @error('phone')
                                    <label class="text-danger font-weight-normal" for="phone">{{ $message }}</label>
                                @enderror
                            </div>

                            <h3 class="pt-3">Главный экран</h3>
                            <div class="form-group pt-3" bis_skin_checked="1">
                                <label for="main_title">{{ __('Заголовок главного блока') }}</label>
                                <div>
                                    <textarea id="main_title" class="textarea" name="main_title">{!! __('Заголовок главного блока') !!}</textarea>
                                </div>
                                @error('main_title')
                                    <label class="text-danger font-weight-normal" for="main_title">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group pt-3" bis_skin_checked="1">
                                <label for="main_content">{{ __('Контент главного блока') }}</label>
                                <div>
                                    <textarea id="main_content" class="textarea" name="main_content">{!! __('Контент главного блока') !!}</textarea>
                                </div>
                                @error('main_content')
                                    <label class="text-danger font-weight-normal" for="main_content">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group pt-3">
                                <div>
                                    <label for="main_photo">{{ __('Фотография фона главного блока') }}</label>
                                    <input type="file" class="form-control-file" id="main_photo">
                                </div>
                                @error('main_content')
                                    <label class="text-danger font-weight-normal" for="main_content">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group pt-3" bis_skin_checked="1">
                                <label for="card">{{ __('Списки для главного блока') }}</label>
                                <div class="card">
                                    <div class="card-header" id="main_lists_field">
                                    </div>
                                    <div class="card-body">
                                        <p class="btn btn-outline-primary" id="main_lists_add">Добавить список</p>
                                    </div>
                                </div>
                            </div>

                            <h3 class="pt-3">Блок с объектами</h3>
                            <div class="form-group pt-3" bis_skin_checked="1">
                                <label for="objects_title">{{ __('Заголовок блока с объектами') }}</label>
                                <input name="objects_title" type="text" class="form-control" id="objects_title" placeholder="{{ __('Новостройки в Турции') }}">
                                @error('objects_title')
                                <label class="text-danger font-weight-normal" for="objects_title">{{ $message }}</label>
                                @enderror
                            </div>

                            <h3 class="pt-3">Блок с описанием ЖК</h3>
                            <div class="form-group pt-3" bis_skin_checked="1">
                                <label for="about_title">{{ __('Заголовок') }}</label>
                                <input name="about_title" type="text" class="form-control" id="about_title" placeholder="{{ __('PERGE COLLECTION: SKY BLUE') }}">
                                @error('about_title')
                                <label class="text-danger font-weight-normal" for="about_title">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group pt-3" bis_skin_checked="1">
                                <label for="about_subtitle">{{ __('Подзаголовок') }}</label>
                                <input name="about_subtitle" type="text" class="form-control" id="about_subtitle" placeholder="{{ __('БИЗНЕС-КЛАСС НА БЕРЕГУ СРЕДИЗЕМНОГО МОРЯ') }}">
                                @error('about_subtitle')
                                <label class="text-danger font-weight-normal" for="about_subtitle">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group pt-3" bis_skin_checked="1">
                                <label for="card">{{ __('Карточки с описанием ЖК') }}</label>
                                <div class="card">
                                    <div class="card-header" id="about_field">
                                    </div>
                                    <div class="card-body">
                                        <p class="btn btn-outline-primary" id="about_add">Добавить карточку</p>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-inverse-success btn-fw" id="landings_create_button">{{ __('Создать') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                selector: '.textarea',
                plugins: 'a_tinymce_plugin',
                a_plugin_option: true,
                a_configuration_option: 400,
                plugins: 'advlist link image lists',
                plugins: 'code',
                toolbar: 'a11ycheck|language | undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent|code'
            });
        });

        // Get Accordion
        function getMainListsAccordion(id) {
            return "<div class='main_lists_accordion' data-identificator='"+ id +"' id='main_lists_accordion" + id + "'>"+
                "<div class='card'>"+
                "<div class='card-header' id='main_lists_heading" + id + "'>"+
                "<h5 class='mb-0'>"+
                "<p class='btn btn-link' data-toggle='collapse' data-target='#main_lists_collapse" + id + "' aria-expanded='true' aria-controls='main_lists_collapse" + id + "'>"+
                "Объект #" + id +
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
                "<p class='btn btn-outline-danger delete_main_lists_accordion' onclick='delete_main_lists_accordion(this);' data-identificator='"+ id +"'>Удалить элемент списка</p>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>";
        }

        // objects_module
        $('#main_lists_add').on('click', function () {
            let accordionCount = $('.main_lists_accordion').length;
            $('#main_lists_field').append(getMainListsAccordion(accordionCount));
        });

        // Delete Accordion
        function delete_main_lists_accordion(el) {
            document.getElementById('main_lists_accordion'+el.dataset.identificator).remove();
            checkAccordions('main_lists');
        }

        // Check Accordions count
        function checkAccordions(prefix) {
            let accordions = document.querySelectorAll('.'+prefix+'_accordion');
            let accordionsCount = accordions.length;

            console.log("==== checkAccordions start ====");
            // console.log("accordionsCount = "+accordionsCount);

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
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].id = "m"+prefix+"_title"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].name = prefix+"["+i+"][title]";

                    // accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1] нашли add_price
                    console.log(accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1]);
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[0].for = prefix+"_content"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].id = prefix+"_content"+i;
                    accordions[i].childNodes[0].childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[1].name = prefix+"["+i+"][content]";
                }
            }

            console.log("==== checkAccordions end ====");
        }

        $('#create_landings_form').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            // Display the key/value pairs

            for (var pair of formData.entries()) {
                console.log(pair[0]+ ' => ' + pair[1]);
            }
        });

        $('#main_lists_field').append(window["getMainListsAccordion"](0));
    </script>
@endsection
