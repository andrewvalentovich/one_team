@extends('panel.layouts.default')
@section('title')
    {{__("Редактирование параметров лендинга")}}
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
                    <h4 class="card-title">{{__("Редактирование параметров лендинга")}}</h4>
                    <form class="forms-sample" id="update_landings_form" action="{{ route('panel.landings.update', $landing->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="pl-0 py-3 row" bis_skin_checked="1">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group unfilterable" bis_skin_checked="1">
                                    <label for="subdomain">{{ __('Поддомен') }}</label>
                                    <input name="subdomain" type="text" class="form-control" value="{{ $landing->subdomain }}" id="subdomain" placeholder="{{ __('Поддомен') }}">
                                    <label class="text-danger font-weight-normal" for="subdomain" id="subdomain_error"></label>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group unfilterable" bis_skin_checked="1">
                                    <label for="template_select">{{ __('Шаблон сайта') }}</label>
                                    <div class="col-sm-12 px-0" bis_skin_checked="1">
                                        <select class="form-control" name="template_id" id="template_select" style="color: #e2e8f0">
                                            @foreach($templates as $template)
                                                <option value="{{ $template->id }}" data-path="{{ $template->path }}" {{ $landing->template->id === $template->id ? "selected" : "" }}>{{ $template->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="text-danger font-weight-normal" for="template_id" id="template_id_error"></label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 col-md-6" data-select="country" style="display: none;">
                                <label>{{ __('Выбор страны') }}</label>
                                <div>
                                    <select class="form-control" {{ $landing->template->path === "country" ? "name=relation_id" : "" }} style="color: #e2e8f0">
                                        <option value="">{{ __('Выбор страны') }}</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ $landing->relation_id === $country->id ? "selected" : "" }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="text-danger font-weight-normal" for="relation_id" id="relation_id" id="relation_id_error"></label>
                            </div>

                            <div class="form-group col-sm-12 col-md-6" data-select="region" style="display: none;">
                                <label>{{ __('Выбор региона') }}</label>
                                <div>
                                    <select class="form-control" {{ $landing->template->path === "region" ? "name=relation_id" : "" }} style="color: #e2e8f0">
                                        <option value="">{{ __('Выбор региона') }}</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ $landing->relation_id === $city->id ? "selected" : "" }}>{{ $city->name.", ".$city->country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="text-danger font-weight-normal" for="relation_id" id="relation_id_error"></label>
                            </div>

                            <div class="form-group col-sm-12 col-md-6" data-select="complex" style="display: none;">
                                <label>{{ __('Выбор ЖК') }}</label>
                                <div>
                                    <select class="form-control" {{ $landing->template->path === "complex" ? "name=relation_id" : "" }} style="color: #e2e8f0">
                                        <option value="">{{ __('Выбор ЖК') }}</option>
                                        @foreach($complexes as $complex)
                                            <option value="{{ $complex->id }}" {{ $landing->relation_id === $complex->id ? "selected" : "" }}>{{ $complex->id }} - {{ $complex->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="text-danger font-weight-normal" for="relation_id" id="relation_id_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 region country complex form-group" style="display: none;">
                                <div class="" bis_skin_checked="1">
                                    <label for="phone">{{ __('Номер телефона') }}</label>
                                    <input name="phone" type="text" class="form-control" id="phone" value="{{ $landing->phone }}" placeholder="{{ __('Номер телефона') }}">
                                    <label class="text-danger font-weight-normal" for="phone" id="phone_error"></label>
                                </div>
                            </div>

                            <h3 class="col-12 pt-5 region country complex" style="display: none;">Главный экран</h3>
                            <div class="col-12 form-group pt-3 complex" bis_skin_checked="1" style="display: none;">
                                <label for="main_location">{{ __('Локация/регион для главного блока') }}</label>
                                <input name="main_location" type="text" class="form-control" value="{{ $landing->main_location }}" id="main_location" placeholder="{{ __('Локация/регион для главного блока') }}">
                                <label class="text-danger font-weight-normal" for="main_location" id="main_location_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 form-group pt-3 region country complex" bis_skin_checked="1" style="display: none;">
                                <label for="main_title">{{ __('Заголовок главного блока') }}</label>
                                <input name="main_title" type="text" class="form-control" id="main_title" value="{{ $landing->main_title }}" placeholder="{{ __('Заголовок главного блока') }}">
                                <label class="text-danger font-weight-normal" for="main_title" id="main_title_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 form-group pt-3 complex" bis_skin_checked="1" style="display: none;">
                                <label for="main_subtitle">{{ __('Подзаголовок главного блока') }}</label>
                                <input name="main_subtitle" type="text" class="form-control" id="main_subtitle" value="{{ $landing->main_subtitle }}" placeholder="{{ __('Подзаголовок главного блока') }}">
                                <label class="text-danger font-weight-normal" for="main_subtitle" id="main_subtitle_error"></label>
                            </div>

                            <div class="col-12 form-group pt-3 region country complex" bis_skin_checked="1" style="display: none;">
                                <label for="main_content">{{ __('Контент главного блока') }}</label>
                                <div>
                                    <textarea id="main_content" class="textarea" name="main_content">{{ $landing->main_content }}</textarea>
                                </div>
                                <label class="text-danger font-weight-normal" for="main_content" id="main_content_error"></label>
                            </div>

                            <div class="col-12 form-group region country complex" style="display: none;">
                                <div>
                                    <div class="preview_image" style="display: inline-block; position: relative;">
                                        <span onclick="closeUploadedImage(this);" class="preview_image-close" style="{{ isset($landing->main_photo) ? "display: block" : "display: none" }}"></span>
                                        <img class="py-3" src="{{ asset($landing->main_photo ?? null) }}" alt="" style="max-width: 300px; max-height: 300px;">
                                    </div>
                                    <label class="d-block" for="main_photo">{{ __('Фотография фона главного блока') }}</label>
                                    <input type="file" name="main_photo" value="{{ $landing->main_photo }}" onchange="displayUploadedImage(this);" class="form-control-file" id="main_photo">
                                </div>
                                <label class="text-danger font-weight-normal" for="main_photo" id="main_photo_error"></label>
                            </div>

                            <div class="col-12 form-group pt-3 region country complex" bis_skin_checked="1" style="display: none;">
                                <label for="card">{{ __('Списки для главного блока') }}</label>
                                <div class="card">
                                    <div class="card-header row" style="gap: 30px 0;" id="main_lists_field">
                                        @if(!is_null(json_decode($landing->main_lists)))
                                            @foreach(json_decode($landing->main_lists) as $main_list)
                                                <div class="main_lists_accordion col-sm-6 col-md-3" data-identificator="{{ $loop->index }}" id="main_lists_accordion{{ $loop->index }}">
                                                    <div class="card">
                                                        <div class="card-header" id="main_lists_heading{{ $loop->index }}">
                                                            <h5 class="mb-0">
                                                                <p class="btn btn-link" data-toggle="collapse" data-target="#main_lists_collapse{{ $loop->index }}" aria-expanded="true" aria-controls="main_lists_collapse{{ $loop->index }}">
                                                                    Список #{{ $loop->index + 1 }}
                                                                </p>
                                                                <input name="main_lists[{{ $loop->index }}][id]" type="hidden" value="{{ $main_list->id }}">
                                                            </h5>
                                                        </div>
                                                        <div id="main_lists_collapse{{ $loop->index }}" class="collapse show" aria-labelledby="main_lists_heading{{ $loop->index }}" data-parent="#main_lists_accordion{{ $loop->index }}">
                                                            <div class="card-body">
                                                                <div class="form-group unfilterable" bis_skin_checked="1" style="display: block;">
                                                                    <div class="form-group unfilterable" bis_skin_checked="1">
                                                                        <label for="main_lists_title{{ $loop->index }}">Заголовок</label>
                                                                        <input name="main_lists[{{ $loop->index }}][title]" type="text" class="form-control" value="{{ $main_list->title ?? null }}" id="main_lists_title{{ $loop->index }}" placeholder="310">
                                                                    </div>
                                                                    <div class="form-group unfilterable" bis_skin_checked="1">
                                                                        <label for="main_lists_content{{ $loop->index }}">Контент</label>
                                                                        <input name="main_lists[{{ $loop->index }}][content]" type="text" class="form-control" value="{{ $main_list->content ?? null }}" id="main_lists_content{{ $loop->index }}" placeholder="Солнечных дней в году">
                                                                    </div>
                                                                    <p class="btn btn-outline-danger delete_main_lists_accordion" onclick="delete_accordion('main_lists', this);" data-identificator="{{ $loop->index }}">Удалить элемент списка</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <p class="btn btn-outline-primary accordion_add" data-type="main_lists">{{ __('Добавить список') }}</p>
                                    </div>
                                </div>
                                <label class="text-danger font-weight-normal" for="main_lists" id="main_lists_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 region country" style="display: none;">Блок с объектами</h3>
                            <div class="col-sm-12 col-md-6 form-group pt-3 region country" bis_skin_checked="1" style="display: none;">
                                <label for="objects_title">{{ __('Заголовок блока с объектами') }}</label>
                                <input name="objects_title" type="text" class="form-control" value="{{ $landing->objects_title ?? null }}" id="objects_title" placeholder="{{ __('Новостройки в Турции') }}">
                                <label class="text-danger font-weight-normal" for="objects_title" id="objects_title_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 complex" style="display: none;">Блок с описанием ЖК</h3>
                            <div class="col-sm-12 col-md-6 form-group pt-3 complex" bis_skin_checked="1" style="display: none;">
                                <label for="about_title">{{ __('Заголовок') }}</label>
                                <input name="about_title" type="text" class="form-control" value="{{ $landing->about_title ?? null }}" id="about_title" placeholder="{{ __('PERGE COLLECTION: SKY BLUE') }}">
                                <label class="text-danger font-weight-normal" for="about_title" id="about_title_error"></label>
                            </div>

                            <div class="col-sm-12 col-md-6 form-group pt-3 complex" bis_skin_checked="1" style="display: none;">
                                <label for="about_subtitle">{{ __('Подзаголовок') }}</label>
                                <input name="about_subtitle" type="text" class="form-control" value="{{ $landing->about_subtitle ?? null }}" id="about_subtitle" placeholder="{{ __('БИЗНЕС-КЛАСС НА БЕРЕГУ СРЕДИЗЕМНОГО МОРЯ') }}">
                                <label class="text-danger font-weight-normal" for="about_subtitle" id="about_subtitle_error"></label>
                            </div>

                            <div class="col-12 form-group pt-3 complex" bis_skin_checked="1" style="display: none;">
                                <label for="card">{{ __('Карточки с описанием ЖК') }}</label>
                                <div class="card">
                                    <div class="card-header" id="about_description_field">
                                        @if(!is_null(json_decode($landing->about_description)))
                                            @foreach(json_decode($landing->about_description) as $about_description)
                                                <div class="about_description_accordion" data-identificator="{{ $loop->index }}" id="about_description_accordion{{ $loop->index }}">
                                                    <div class="card">
                                                        <div class="card-header" id="about_description_heading{{ $loop->index }}">
                                                            <h5 class="mb-0">
                                                                <p class="btn btn-link" data-toggle="collapse" data-target="#about_description_collapse{{ $loop->index }}" aria-expanded="true" aria-controls="about_description_collapse{{ $loop->index }}">
                                                                    Карточка #{{ $loop->index + 1 }}
                                                                </p>
                                                                <input name="about_description[{{ $loop->index }}][id]" type="hidden" value="{{ $about_description->id }}">
                                                            </h5>
                                                        </div>
                                                        <div id="about_description_collapse{{ $loop->index }}" class="collapse show" aria-labelledby="about_description_heading{{ $loop->index }}" data-parent="#about_description_accordion{{ $loop->index }}">
                                                            <div class="card-body">
                                                                <div class="form-group unfilterable" bis_skin_checked="1" style="display: block;">
                                                                    <div class="form-group unfilterable" bis_skin_checked="1">
                                                                        <label for="about_description_title{{ $loop->index }}">{{ __('Заголовок') }}</label>
                                                                        <input name="about_description[{{ $loop->index }}][title]" type="text" value="{{ $about_description->title ?? null }}" class="form-control" id="about_description_title{{ $loop->index }}" placeholder="Большая закрытая территория с двумя бассейнами">
                                                                    </div>
                                                                    <div class="form-group unfilterable" bis_skin_checked="1">
                                                                        <label for="about_description_content{{ $loop->index }}">{{ __('Контент') }}</label>
                                                                        <div>
                                                                            <textarea class="textarea" name="about_description[{{ $loop->index }}][content]">{!! $about_description->content ?? null !!}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group unfilterable">
                                                                        <div>
                                                                            <div class="preview_image" style="display: inline-block; position: relative;">
                                                                                <span onclick="closeUploadedImage(this);" class="preview_image-close" style="{{ isset($about_description->photo) ? 'display:block' : 'display: none' }}"></span>
                                                                                <img class="py-3" src="{{ asset($about_description->photo ?? null) }}" alt="" style="max-width: 300px; max-height: 300px;">
                                                                            </div>
                                                                            <label class="d-block" for="about_description_photo">Фотография карточки блока о ЖК</label>
                                                                            <input type="file" name="about_description[{{ $loop->index }}][photo]" value="{{ $about_description->photo }}" onchange="displayUploadedImage(this);" class="form-control-file" id="about_description_photo">
                                                                        </div>
                                                                    </div>

                                                                    <p class="btn btn-outline-danger delete_about_description_accordion" onclick="delete_accordion('about_description', this);" data-identificator="{{ $loop->index }}">Удалить элемент списка</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
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
                                        <span onclick="closeUploadedImage(this);" class="preview_image-close" style="{{ isset($landing->territory) ? 'display: block;' : 'display: none;' }}"></span>
                                        <img class="py-3" src="{{ asset($landing->territory ?? null) }}" alt="" style="max-width: 300px; max-height: 300px;">
                                    </div>
                                    <label class="d-block" for="territory">{{ __('Фотография-план территории ЖК') }}</label>
                                    <input type="file" name="territory" value="{{ $landing->territory ?? null }}" onchange="displayUploadedImage(this);" class="form-control-file" id="territory">
                                </div>
                                <label class="text-danger font-weight-normal" for="territory" id="territory_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 region country complex" style="display: none;">Блок с картой</h3>
                            <div class="col-12 form-group pt-3 region country complex" style="display: none;">
                                <label for="map">{{ __('Вставьте скрипт с картой') }}</label>
                                <div>
                                    <textarea class="form-control" rows="10" id="map" name="map">{{ $landing->map ?? null }}</textarea>
                                </div>
                                <label class="text-danger font-weight-normal" for="map" id="map_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 region country complex" style="display: none;">Блок с условиями покупки</h3>
                            <div class="col-12 form-group pt-3 region country complex" bis_skin_checked="1" style="display: none;">
                                <label for="card">{{ __('Карточки с условиями покупки') }}</label>
                                <div class="card">
                                    <div class="card-header row" id="purchase_terms_field">
                                        @if(!is_null(json_decode($landing->purchase_terms)))
                                            @foreach(json_decode($landing->purchase_terms) as $purchase_terms)
                                                <div class="purchase_terms_accordion col-sm-12 col-md-6" data-identificator="{{ $loop->index }}" id="purchase_terms_accordion{{ $loop->index }}">
                                                    <div class="card">
                                                        <div class="card-header" id="purchase_terms_heading{{ $loop->index }}">
                                                            <h5 class="mb-0">
                                                                <p class="btn btn-link" data-toggle="collapse" data-target="#purchase_terms_collapse{{ $loop->index }}" aria-expanded="true" aria-controls="purchase_terms_collapse{{ $loop->index }}">
                                                                    Карточка #{{ $loop->index + 1 }}
                                                                </p>
                                                                <input name="purchase_terms[{{ $loop->index }}][id]" type="hidden" value="{{ $purchase_terms->id }}">
                                                            </h5>
                                                        </div>
                                                        <div id="purchase_terms_collapse{{ $loop->index }}" class="collapse show" aria-labelledby="purchase_terms_heading{{ $loop->index }}" data-parent="#purchase_terms_accordion{{ $loop->index }}">
                                                            <div class="card-body">
                                                                <div class="form-group unfilterable" bis_skin_checked="1" style="display: block;">
                                                                    <div class="form-group unfilterable" bis_skin_checked="1">
                                                                        <label for="purchase_terms_title{{ $loop->index }}">Заголовок</label>
                                                                        <input name="purchase_terms[{{ $loop->index }}][title]" type="text" value="{{ $purchase_terms->title ?? null }}" class="form-control" id="purchase_terms_title{{ $loop->index }}" placeholder="310">
                                                                    </div>
                                                                    <div class="form-group unfilterable" bis_skin_checked="1">
                                                                        <label for="purchase_terms_content{{ $loop->index }}">Текст</label>
                                                                        <div>
                                                                            <textarea class="textarea" name="purchase_terms[{{ $loop->index }}][content]">{{ $purchase_terms->content ?? null }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <p class="btn btn-outline-danger delete_purchase_terms_accordion" onclick="delete_accordion('purchase_terms', this);" data-identificator="{{ $loop->index }}">Удалить элемент списка</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
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
                                <input name="vnj_title" type="text" class="form-control" value="{{ $landing->vnj_title ?? null }}" id="vnj_title" placeholder="{{ __('Вид на жительство в Турции') }}">
                                <label class="text-danger font-weight-normal" for="vnj_title" id="vnj_title_error"></label>
                            </div>

                            <div class="col-12 form-group pt-3 region country complex" bis_skin_checked="1" style="display: none;">
                                <label for="vnj_content">{{ __('Контент блока ВНЖ') }}</label>
                                <div>
                                    <textarea id="vnj_content" class="textarea" name="vnj_content">{{ $landing->vnj_content ?? null }}</textarea>
                                </div>
                                <label class="text-danger font-weight-normal" for="vnj_content" id="vnj_content_error"></label>
                            </div>

                            <h3 class="col-12 pt-5 region country" style="display: none;">Блок с достопримечательностями</h3>
                            <div class="col-12 form-group pt-3 region country" bis_skin_checked="1" style="display: none;">
                                <label for="sight_title">{{ __('Заголовок') }}</label>
                                <input name="sight_title" type="text" class="form-control" value="{{ $landing->sight_title ?? null }}" id="sight_title" placeholder="{{ __('Достопримечательности Анталии') }}">
                                <label class="text-danger font-weight-normal" for="sight_title" id="sight_title_error"></label>
                            </div>

                            <div class="col-12 form-group pt-3 region country" bis_skin_checked="1" style="display: none;">
                                <label for="card">{{ __('Карточки с достопримечательностями') }}</label>
                                <div class="card">
                                    <div class="card-header" id="sight_cards_field">
                                        @if(!is_null(json_decode($landing->sight_cards)))
                                            @foreach(json_decode($landing->sight_cards) as $sight_card)
                                                <div class="sight_cards_accordion" data-identificator="{{ $loop->index }}" id="sight_cards_accordion{{ $loop->index }}">
                                                    <div class="card">
                                                        <div class="card-header" id="sight_cards_heading{{ $loop->index }}">
                                                            <h5 class="mb-0">
                                                                <p class="btn btn-link" data-toggle="collapse" data-target="#sight_cards_collapse{{ $loop->index }}" aria-expanded="true" aria-controls="sight_cards_collapse{{ $loop->index }}">
                                                                    Карточка #{{ $loop->index }}
                                                                </p>
                                                                <input name="sight_cards[{{ $loop->index }}][id]" type="hidden" value="{{ $sight_card->id }}">
                                                            </h5>
                                                        </div>
                                                        <div id="sight_cards_collapse{{ $loop->index }}" class="collapse show" aria-labelledby="sight_cards_heading{{ $loop->index }}" data-parent="#sight_cards_accordion{{ $loop->index }}">
                                                            <div class="card-body">
                                                                <div class="form-group unfilterable" bis_skin_checked="1" style="display: block;">
                                                                    <div class="form-group unfilterable" bis_skin_checked="1">
                                                                        <label for="sight_cards_title{{ $loop->index }}">Заголовок</label>
                                                                        <input name="sight_cards[{{ $loop->index }}][title]" type="text" class="form-control" value="{{ $sight_card->title ?? null }}" id="sight_cards_title{{ $loop->index }}" placeholder="Большая закрытая территория с двумя бассейнами">
                                                                    </div>
                                                                    <div class="form-group unfilterable" bis_skin_checked="1">
                                                                        <label for="sight_cards_content{{ $loop->index }}">Текст</label>
                                                                        <div>
                                                                            <textarea class="textarea" name="sight_cards[{{ $loop->index }}][content]">{!! $sight_card->content !!}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group unfilterable">
                                                                        <div>
                                                                            <div class="preview_image" style="display: inline-block; position: relative;">
                                                                                <span onclick="closeUploadedImage(this);" class="preview_image-close" style="{{ isset($sight_card->photo) ? 'display: block;' : 'display: none;' }}"></span>
                                                                                <img class="py-3" src="{{ asset($sight_card->photo) ?? null }}" alt="" style="max-width: 300px; max-height: 300px;">
                                                                            </div>
                                                                            <label class="d-block" for="sight_cards_photo">Фотография достопримечательности</label>
                                                                            <input type="file" name="sight_cards[{{ $loop->index }}][photo]" value="{{ $sight_card->photo ?? null }}" onchange="displayUploadedImage(this);" class="form-control-file" id="sight_cards_photo">
                                                                        </div>
                                                                    </div>

                                                                    <p class="btn btn-outline-danger delete_sight_cards_accordion" onclick="delete_accordion('sight_cards', this);" data-identificator="{{ $loop->index }}">Удалить элемент списка</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <p class="btn btn-outline-primary accordion_add" data-type="sight_cards" id="sight_cards_add">{{ __('Добавить карточку') }}</p>
                                    </div>
                                </div>
                                <label class="text-danger font-weight-normal" for="sight_cards" id="sight_cards_error"></label>
                            </div>
                        </div>
                    </form>
                    <div class="col-12">
                        <button id="submit-update-landings-form" type="submit" class="btn btn-inverse-success btn-fw">{{ __('Сохранить изменения') }}</button>
                        <form id="delete_landings_form-{{ $landing->id }}" style="display: none;" action="{{ route('panel.landings.destroy', $landing->id) }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                        <a class="btn btn-inverse-danger btn-fw ml-1" onclick="if(confirm('Вы уверены, что хотите удалить лендинг?')) document.getElementById('delete_landings_form-{{ $landing->id }}').submit(); return false;">
                            Удалить
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <style>
        /*.preview_image-close {*/
        /*    width: 25px;*/
        /*    height: 25px;*/
        /*    position: absolute;*/
        /*    top: 15px;*/
        /*    right: -6px;*/
        /*}*/
        /*.preview_image-close:before {*/
        /*    content: '\2715';*/
        /*    position: absolute;*/
        /*    width: 100%;*/
        /*    height: 100%;*/
        /*    top: 0;*/
        /*    right: 0;*/
        /*    color: #f30c0c;*/
        /*    font-size: large;*/
        /*    color: red;*/
        /*    font-weight: bold;*/
        /*}*/
    </style>
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

            // Показываем поля соответствующие выбранному шаблону
            var data_path = $('#template_select').find('option:selected').attr('data-path');
            console.log(data_path);
            $('.form-group[data-select]').hide();
            $('.form-group:not(.unfilterable)').hide();
            $('.forms-sample').find('h3').hide();
            $('.form-group[data-select="'+data_path+'"]').show();
            $('.form-control[name="relation_id"]').removeAttr('name');
            $('.form-group[data-select="'+data_path+'"] select').attr('name', 'relation_id');
            $('.forms-sample').find('.'+data_path).show();
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
            check_all_accordions();
        });

        // Удаление объекта по его порядковому номеру
        function delete_accordion(prefix, el) {
            document.getElementById(prefix+'_accordion'+el.dataset.identificator).remove();
            window["check_"+prefix+"_accordions"](0);
        }

        // Получаем структуру блока main_lists_accordion
        function get_main_lists_accordion(id) {
            return "<div class='main_lists_accordion col-sm-6 col-md-3' data-identificator='"+ id +"' id='main_lists_accordion" + id + "'>"+
                "<div class='card'>"+
                "<div class='card-header' id='main_lists_heading" + id + "'>"+
                "<h5 class='mb-0'>"+
                "<p class='btn btn-link' data-toggle='collapse' data-target='#main_lists_collapse" + id + "' aria-expanded='true' aria-controls='main_lists_collapse" + id + "'>"+
                "Список #" + (id + 1) +
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
                // if (i != Number(accordions[i].dataset.identificator)) {
                    // console.log('- Не совпало -');

                    // accordions[i] нашли .accordion
                    // console.log(accordions[i]);
                    accordions[i].dataset.identificator = i;
                    accordions[i].id = prefix+"_accordion"+i;

                    // accordions[i].childNodes[0].childNodes[0] нашли .card-header
                    // console.log(accordions[i].childNodes[0].childNodes[0]);
                    accordions[i].children[0].children[0].id = prefix+"_heading"+i;

                    // console.log(accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0]);

                    // accordions[i].childNodes[0].childNodes[0].childNodes[0].childNodes[0] нашли .card-header
                    console.log(accordions[i].children[0].children[0].children[0].children[0]);
                    accordions[i].children[0].children[0].children[0].children[0].dataset.target = "#"+prefix+"_collapse"+i;
                    accordions[i].children[0].children[0].children[0].children[0].ariaControls = prefix+"_collapse"+i; // ?
                    accordions[i].children[0].children[0].children[0].children[0].textContent  = "Объект #"+(i+1);

                    // accordions[i].children[0].children[0].children[0].children[1] нашли input[type='hidden'] add_id
                    console.log(accordions[i].children[0].children[0].children[0].children[1]);
                    accordions[i].children[0].children[0].children[0].children[1].name = prefix+"["+i+"][id]";
                    accordions[i].children[0].children[0].children[0].children[1].value = i;
                    accordions[i].children[0].children[0].children[0].children[1].id = prefix+"_add_id"+i;

                    // accordions[i].children[0].children[1] нашли .collapse
                    console.log(accordions[i].children[0].children[1]);
                    accordions[i].children[0].children[1].id = prefix+"_collapse"+i;
                    accordions[i].children[0].children[1].ariaLabelledby = prefix+"_heading"+i;
                    accordions[i].children[0].children[1].dataset.parent = "#"+prefix+"_accordion"+i;

                    // accordions[i].children[0].children[1].children[0].children[0].children[6] нашли .delete_accordion
                    console.log(accordions[i].children[0].children[1].children[0].children[0].children[2]);
                    accordions[i].children[0].children[1].children[0].children[0].children[2].dataset.identificator = i;

                    // accordions[i].children[0].children[1].children[0].children[0].children[0].children[1] нашли add_building
                    console.log(accordions[i].children[0].children[1].children[0].children[0].children[0].children[0]);
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[0].htmlFor = prefix+"_title"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[1].id = prefix+"_title"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[1].name = prefix+"["+i+"][title]";

                    // accordions[i].children[0].children[1].children[0].children[0].children[1].children[1] нашли add_price
                    console.log(accordions[i].children[0].children[1].children[0].children[0].children[1].children[1]);
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[0].htmlFor = prefix+"_content"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[1].id = prefix+"_content"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[1].name = prefix+"["+i+"][content]";
                // }
            }
        }

        // Получаем структуру блока purchase_terms_accordion
        function get_purchase_terms_accordion(id) {
            return "<div class='purchase_terms_accordion col-sm-12 col-md-6' data-identificator='"+ id +"' id='purchase_terms_accordion" + id + "'>"+
                "<div class='card'>"+
                "<div class='card-header' id='purchase_terms_heading" + id + "'>"+
                "<h5 class='mb-0'>"+
                "<p class='btn btn-link' data-toggle='collapse' data-target='#purchase_terms_collapse" + id + "' aria-expanded='true' aria-controls='purchase_terms_collapse" + id + "'>"+
                "Карточка #" + (id + 1) +
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
                // if (i != Number(accordions[i].dataset.identificator)) {
                    // console.log('- Не совпало -');

                    // accordions[i] нашли .accordion
                    // console.log(accordions[i]);
                    accordions[i].dataset.identificator = i;
                    accordions[i].id = prefix+"_accordion"+i;

                    // accordions[i].childNodes[0].childNodes[0] нашли .card-header
                    // console.log(accordions[i].childNodes[0].childNodes[0]);
                    accordions[i].children[0].children[0].id = prefix+"_heading"+i;

                    // console.log(accordions[i].children[0].children[0].children[0].children[0]);

                    // accordions[i].children[0].children[0].children[0].children[0] нашли .card-header
                    console.log(accordions[i].children[0].children[0].children[0].children[0]);
                    accordions[i].children[0].children[0].children[0].children[0].dataset.target = "#"+prefix+"_collapse"+i;
                    accordions[i].children[0].children[0].children[0].children[0].ariaControls = prefix+"_collapse"+i; // ?
                    accordions[i].children[0].children[0].children[0].children[0].textContent  = "Карточка #"+(i + 1);

                    // accordions[i].children[0].children[0].children[0].children[1] нашли input[type='hidden'] add_id
                    console.log(accordions[i].children[0].children[0].children[0].children[1]);
                    accordions[i].children[0].children[0].children[0].children[1].name = prefix+"["+i+"][id]";
                    accordions[i].children[0].children[0].children[0].children[1].value = i;
                    accordions[i].children[0].children[0].children[0].children[1].id = prefix+"_add_id"+i;

                    // accordions[i].children[0].children[1] нашли .collapse
                    console.log(accordions[i].children[0].children[1]);
                    accordions[i].children[0].children[1].id = prefix+"_collapse"+i;
                    accordions[i].children[0].children[1].ariaLabelledby = prefix+"_heading"+i;
                    accordions[i].children[0].children[1].dataset.parent = "#"+prefix+"_accordion"+i;

                    // accordions[i].children[0].children[1].children[0].children[0].children[6] нашли .delete_accordion
                    console.log(accordions[i].children[0].children[1].children[0].children[0].children[2]);
                    accordions[i].children[0].children[1].children[0].children[0].children[2].dataset.identificator = i;

                    // accordions[i].children[0].children[1].children[0].children[0].children[0].children[1] нашли title
                    console.log(accordions[i].children[0].children[1].children[0].children[0].children[0].children[0]);
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[0].htmlFor = prefix+"_title"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[1].id = prefix+"_title"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[1].name = prefix+"["+i+"][title]";

                    // accordions[i].children[0].children[1].children[0].children[0].children[1].children[1] нашли content
                    console.log(accordions[i].children[0].children[1].children[0].children[0].children[1].children[1]);
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[0].htmlFor = prefix+"_content"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[1].children[0].id = prefix+"_content"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[1].children[0].name = prefix+"["+i+"][content]";
                // }
            }
        }

        // Получаем структуру блока about_description_accordion
        function get_about_description_accordion(id) {
            return "<div class='about_description_accordion' data-identificator='"+ id +"' id='about_description_accordion" + id + "'>"+
                "<div class='card'>"+
                "<div class='card-header' id='about_description_heading" + id + "'>"+
                "<h5 class='mb-0'>"+
                "<p class='btn btn-link' data-toggle='collapse' data-target='#about_description_collapse" + id + "' aria-expanded='true' aria-controls='about_description_collapse" + id + "'>"+
                "Карточка #" + (id + 1) +
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
                "<span onclick='closeUploadedImage(this);' class='preview_image-close' style='display: none'></span>\n" +
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
            console.log(accordionsCount);

            // Проверяем id и имена классов, для "выравнивания" id и имён классов по порядку и корректной работы элементов
            // id 1 4 5 8 -> id 0 1 2 3, для передачи в JSON-объект в будущем
            // ВАЖНО!!! все изменяемые поля должны содержать префикс например about_collapse
            // а свойство name тегов input должны содержать имя префикса about[i][имя поля]

            for(let i = 0; i < accordionsCount; i++) {
                // console.log('ident = '+accordions[i].dataset.identificator);
                // console.log('i = '+i);
                // if (i != Number(accordions[i].dataset.identificator)) {
                    // console.log('- Не совпало -');

                    // accordions[i] нашли .accordion
                    console.log(accordions[i]);
                    accordions[i].dataset.identificator = i;
                    accordions[i].id = prefix+"_accordion"+i;

                    // accordions[i].childNodes[0].childNodes[0] нашли .card-header
                    console.log(accordions[i].children[0].children[0]);
                    accordions[i].children[0].children[0].id = prefix+"_heading"+i;

                    // console.log(accordions[i].children[0].children[0].children[0].children[0]);

                    // accordions[i].children[0].children[0].children[0].children[0] нашли .card-header
                    console.log(accordions[i].children[0].children[0].children[0].children[0]);
                    accordions[i].children[0].children[0].children[0].children[0].dataset.target = "#"+prefix+"_collapse"+i;
                    accordions[i].children[0].children[0].children[0].children[0].ariaControls = prefix+"_collapse"+i; // ?
                    accordions[i].children[0].children[0].children[0].children[0].textContent  = "Карточка #"+(i + 1);

                    // accordions[i].children[0].children[0].children[0].children[1] нашли input[type='hidden'] add_id
                    console.log(accordions[i].children[0].children[0].children[0].children[1]);
                    accordions[i].children[0].children[0].children[0].children[1].name = prefix+"["+i+"][id]";
                    accordions[i].children[0].children[0].children[0].children[1].value = i;
                    accordions[i].children[0].children[0].children[0].children[1].id = prefix+"_add_id"+i;

                    // accordions[i].children[0].children[1] нашли .collapse
                    console.log(accordions[i].children[0].children[1]);
                    accordions[i].children[0].children[1].id = prefix+"_collapse"+i;
                    accordions[i].children[0].children[1].ariaLabelledby = prefix+"_heading"+i;
                    accordions[i].children[0].children[1].dataset.parent = "#"+prefix+"_accordion"+i;

                    // accordions[i].children[0].children[1].children[0].children[0].children[6] нашли .delete_accordion
                    console.log(accordions[i].children[0].children[1].children[0].children[0].children[3]);
                    accordions[i].children[0].children[1].children[0].children[0].children[3].dataset.identificator = i;

                    // accordions[i].children[0].children[1].children[0].children[0].children[0].children[1] нашли title
                    console.log(accordions[i].children[0].children[1].children[0].children[0].children[0].children[0]);
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[0].htmlFor = prefix+"_title"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[1].id = prefix+"_title"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[1].name = prefix+"["+i+"][title]";

                    // accordions[i].children[0].children[1].children[0].children[0].children[1].children[1] нашли content
                    console.log(accordions[i].children[0].children[1].children[0].children[0].children[1].children[1].children[0]);
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[0].htmlFor = prefix+"_content"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[1].children[0].id = prefix+"_content"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[1].children[0].name = prefix+"["+i+"][content]";

                    // accordions[i].children[0].children[1].children[0].children[0].children[1].children[1] нашли photo
                    console.log(accordions[i].children[0].children[1].children[0].children[0].children[2].children[0].children[2]);
                    accordions[i].children[0].children[1].children[0].children[0].children[2].children[0].children[1].htmlFor = prefix+"_photo"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[2].children[0].children[2].name = prefix+"["+i+"][photo]";
                    accordions[i].children[0].children[1].children[0].children[0].children[2].children[0].children[2].id = prefix+"_content"+i;
                // }
            }
        }

        // Получаем структуру блока sight_cards_accordion
        function get_sight_cards_accordion(id) {
            return "<div class='sight_cards_accordion' data-identificator='"+ id +"' id='sight_cards_accordion" + id + "'>"+
                "<div class='card'>"+
                "<div class='card-header' id='sight_cards_heading" + id + "'>"+
                "<h5 class='mb-0'>"+
                "<p class='btn btn-link' data-toggle='collapse' data-target='#sight_cards_collapse" + id + "' aria-expanded='true' aria-controls='sight_cards_collapse" + id + "'>"+
                "Карточка #" + (id + 1) +
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
                "<span onclick='closeUploadedImage(this);' class='preview_image-close' style='display: none'></span>\n" +
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
                    accordions[i].children[0].children[0].id = prefix+"_heading"+i;

                    // console.log(accordions[i].children[0].children[0].children[0].children[0]);

                    // accordions[i].children[0].children[0].children[0].children[0] нашли .card-header
                    // console.log(accordions[i].children[0].children[0].children[0].children[0]);
                    accordions[i].children[0].children[0].children[0].children[0].dataset.target = "#"+prefix+"_collapse"+i;
                    accordions[i].children[0].children[0].children[0].children[0].ariaControls = prefix+"_collapse"+i; // ?
                    accordions[i].children[0].children[0].children[0].children[0].textContent  = "Карточка #"+(i + 1);

                    // accordions[i].children[0].children[0].children[0].children[1] нашли input[type='hidden'] add_id
                    // console.log(accordions[i].children[0].children[0].children[0].children[1]);
                    accordions[i].children[0].children[0].children[0].children[1].name = prefix+"["+i+"][id]";
                    accordions[i].children[0].children[0].children[0].children[1].value = i;
                    accordions[i].children[0].children[0].children[0].children[1].id = prefix+"_add_id"+i;

                    // accordions[i].children[0].children[1] нашли .collapse
                    // console.log(accordions[i].children[0].children[1]);
                    accordions[i].children[0].children[1].id = prefix+"_collapse"+i;
                    accordions[i].children[0].children[1].ariaLabelledby = prefix+"_heading"+i;
                    accordions[i].children[0].children[1].dataset.parent = "#"+prefix+"_accordion"+i;

                    // accordions[i].children[0].children[1].children[0].children[0].children[6] нашли .delete_accordion
                    console.log(accordions[i].children[0].children[1].children[0].children[0].children[3]);
                    accordions[i].children[0].children[1].children[0].children[0].children[3].dataset.identificator = i;

                    // accordions[i].children[0].children[1].children[0].children[0].children[0].children[1] нашли title
                    // console.log(accordions[i].children[0].children[1].children[0].children[0].children[0].children[0]);
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[0].htmlFor = prefix+"_title"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[1].id = prefix+"_title"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[0].children[1].name = prefix+"["+i+"][title]";

                    // accordions[i].children[0].children[1].children[0].children[0].children[1].children[1] нашли content
                    // console.log(accordions[i].children[0].children[1].children[0].children[0].children[1].children[1]);
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[0].htmlFor = prefix+"_content"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[1].id = prefix+"_content"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[1].children[1].name = prefix+"["+i+"][content]";

                    // accordions[i].children[0].children[1].children[0].children[0].children[1].children[1] нашли photo
                    // console.log(accordions[i].children[0].children[1].children[0].children[0].children[2].children[1]);
                    accordions[i].children[0].children[1].children[0].children[0].children[2].children[1].children[3].htmlFor = prefix+"_photo"+i;
                    accordions[i].children[0].children[1].children[0].children[0].children[2].children[1].children[5].name = prefix+"["+i+"][photo]";
                    accordions[i].children[0].children[1].children[0].children[0].children[2].children[1].children[5].id = prefix+"_content"+i;
                }
            }
        }

        $('#submit-update-landings-form').on('click', function () {
            $('#update_landings_form').submit();
        })

        // При "сабмите" формы...
        $('#update_landings_form').on('submit', function (e) {
            e.preventDefault();

            tinyMCE.remove();
            initEditors();

            check_main_lists_accordions();
            check_purchase_terms_accordions();
            check_about_description_accordions();
            check_sight_cards_accordions();

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
                url: "{{ route('panel.landings.update', $landing->id) }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    alert("Лендинг обновлён");
                    window.location.href = "{{ route('panel.landings.index') }}";
                },
                error: function (reject) {
                    if( reject.status == 422 ) {
                        var errors = $.parseJSON(reject.responseText);
                        // console.log(errors);
                        $.each(errors.errors, function (key, val) {
                            $("#" + key + "_error").text(val[0]);
                        });

                        alert("Ошибка! Заполните поля в соответствии с рекомендациями");
                    } else {
                        alert("Ошибка при обновлении лендинга! Статус ошибки - "+reject.status);
                    }
                }
            });
        });
    </script>
@endsection
