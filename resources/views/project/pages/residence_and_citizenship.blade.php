@extends('project.includes.layouts')

<?php $title = 'Oneteam / ' . __('ВНЖ и Гражданство') ?>
@section('header')
    @include('project.includes.header')
@endsection

@section('seo')
<title>{{ __('Гражданство Турции за инвестиции в недвижимость. ВНЖ за покупку квартир') }}</title>
<meta name="description" content="{{ __('Советы от Oneteam, которые помогут получить ВНЖ и гражданство в Турции. Узнайте все о натурализации через инвестиции в недвижимость и покупку квартир.') }}" />
@endsection

@section('content')
<section class="about">
    <div class="about__content maxContainer">
        <div class="hello__title title">
            {{ __('ВНЖ и гражданство') }}
        </div>
        <!-- <div class="about__preview">
            <p class="about__preview-text">
                За последние пять лет мы стали свидетелями настоящего бума на рынке турецкой недвижимости, и немалую роль в этом играет привлечение иностранного капитала. Инвестируют в сельское хозяйство, промышленность, туризм, но самым востребованным направлением инвестирования была и остается сфера недвижимости.
            </p>
            <img class="about__preview-pic" src="{{asset('project/img/about-preview.png')}}" alt="о компании">
        </div> -->
        <p class="about__text-desc desc desc_transparent" style="margin-bottom: 20px;">
            {{ __('Турция является одной из самых популярных для переезда стран, и вызвано это простотой процедуры получения вида на жительство, а впоследствии — и гражданства. О том, как получить турецкий паспорт за покупку недвижимости, расскажет наш сотрудник Марина Новикова, которая вот уже 6 лет помогает россиянам натурализоваться в стране через приобретение жилых (и коммерческих) объектов.') }}
            {{ __('Вид на жительство в Турецкой республике называется «икамет» и имеет следующие особенности:') }}
        </p>
        <ul>
            <li>
            •	{{ __('Предоставляет право проживать в стране самому покупателю недвижимости, а также членам его семьи;') }}
            </li>
            <li>
            •	{{ __('Оформлять ВНЖ в Турции можно сразу после завершения сделки, и весь процесс занимает около трех-четырех месяцев;') }}
            </li>
            <li>
            •	{{ __('Получить икамет за покупку недвижимости можно не во всех районах: выдача ВНЖ приостановлена в локациях, где иностранцев более 25% от общего объема;') }}
            </li>
            <li>
            •	{{ __('ВНЖ в Турецкой республике дается только за покупку недвижимости на определенную сумму, которая зависит от выбранного покупателем города. К примеру, в небольшом населенном пункте стоимость подходящих для получения икамет объектов составляет минимум 50 000$, в более крупных же может доходить до 75 000%.') }}
            </li>
        </ul>
        <div class="vnj">
            <div class="vnj__text">
                <h2>
                    Как получить ВНЖ за покупку недвижимости?
                </h2>
                <ul>
                    <li>
                    •	Приобрести квартиру в Турции или дом для собственного проживания;
                    </li>
                    <li>
                    •	Купить недвижимость в Турции для осуществления коммерческой деятельности.
                    </li>
                </ul>
            </div>
            <div class="vnj__form">
                <div class="vnj__form-text">
                    <div class="vnj__form-title">
                        Получите консультацию специалиста
                    </div>
                    <button class="vnj__form-btn btn btn_blue" popup-name="main-form-popup">
                        Заполнить форму
                    </button>
                </div>
                <div class="vnj__form-consul">
                    <img src="{{asset('project/img/woman1.webp')}}" alt="консультант">
                </div>
            </div>
        </div>
        <h2>
            {{ __('Какие документы нужны для получения турецкого ВНЖ?') }}
        </h2>
        <ul>
            <li>
            •	{{ __('Заявление: заполняется на портале Миграционной службы;') }}
            </li>
            <li>
            •	{{ __('Загранпаспорт покупателя: оригинал и заверенная нотариусом (обязательно турецким!) копия;') }}
            </li>
            <li>
            •	{{ __('Справка о доходах: выписка из банка, которая свидетельствует о наличии у иностранца средств для проживания в Турецкой республике;') }}
            </li>
            <li>
            •	{{ __('Справка об отсутствии судимости: оригинал и копия с переводом, заверенная турецким нотариусом;') }}
            </li>
            <li>
            •   {{ __('TAPU — документ о праве собственности: оригинал и копия (без заверения);') }}
            </li>
            <li>
            •	{{ __('Отчет экспертизы: составляется независимым экспертом и подтверждает стоимость приобретенного объекта;') }}
            </li>
            <li>
            •	{{ __('Чек об уплате госпошлины: ее размер зависит от страны прибытия и срока оформления ВНЖ;') }}
            </li>
            <li>
            •	{{ __('Sigorta — страховой медицинский полис: выдается местными страховыми организациями;') }}
            </li>
            <li>
            •	{{ __('Фотографии: 4 цветных, размером 3,5*4,5 см.') }}
            </li>
        </ul>
        <div class="residence">
            <div class="residence__text">
                <h2>
                    Как получить гражданство при покупке недвижимости?
                </h2>
                <p class="about__text-desc desc desc_transparent" style="margin-bottom: 20px;">
                    Обычно здесь не обходится без предварительного получения икамет — вида на жительство, и натурализоваться можно после пяти лет официального проживания в республике на основании ВНЖ. Но есть и другой вариант, и подходит он инвесторам, готовым вложиться в покупку объектов недвижимости оценочной стоимостью от 400 000$ и более. На указанную сумму можно приобрести:
                </p>
                <ul>
                    <li>
                    •	Дома или квартиры на первичном рынке либо в старом фонде;
                    </li>
                    <li>
                    •	Коммерческую недвижимость (офисы, склады, магазины, в том числе и на разных стадиях строительства);
                    </li>
                    <li>
                    •	Земельные участки площадью до 30 Га, предназначенные для коммерческой либо жилой застройки.
                    </li>
                </ul>
            </div>
            <div class="residence__form">
                <div class="residence__form-text">
                    <div class="residence__form-title">
                        Подбор объекта для получения ВНЖ
                    </div>
                    <button class="residence__form-btn btn btn_blue" popup-name="main-form-popup">
                        Заполнить форму
                    </button>
                </div>
                <div class="residence__form-consul">
                    <img src="{{asset('project/img/questions-index.webp')}}" alt="">
                </div>
            </div>
        </div>
        <p class="about__text-desc desc desc_transparent" style="margin-bottom: 20px;">
            {{ __('Для получения гражданства Турции за недвижимость потребуются следующие документы:') }}
        </p>
        <ul>
            <li>
            •	{{ __('Договор купли-продажи;') }}
            </li>
            <li>
            •	{{ __('TAPU — свидетельство о праве собственности;') }}
            </li>
            <li>
            •	{{ __('Разрешение на строительство либо план развития, если покупатель инвестирует в земельные участки;') }}
            </li>
            <li>
            •	{{ __('Справка об исполнении финансовых обязательств от Турецкого кадастрового управления;') }}
            </li>
            <li>
            •	{{ __('Оплата госпошлины.') }}
            </li>
        </ul>
        <div class='about__text'>
            <p class="about__text-desc desc desc_transparent" style="max-width: none">
                Также потребуются личные документы покупателя и членов его семьи (фотографии, заявления, паспорта, свидетельства о рождении и о заключении брака, справка о составе семьи, свидетельства о несудимости).
                Система получения гражданства и ВНЖ в Турции за инвестиции при покупке недвижимости может показаться достаточно сложной, но никаких трудностей не возникнет, если вы воспользуетесь помощью специалистов агентства Oneteam. Наша поддержка не заканчивается после оформления сделки купли-продажи: мы останемся рядом с вами и после того, как вы станете обладателем турецкой недвижимости, и поможем вам получить ВНЖ или гражданство в Турецкой Республике — быстро, легко и с гарантированным результатом.
            </p>
        </div>
    </div>
</section>
@include('project.includes.advantages')
@include('project.includes.form-main')
@endsection


@section('footer')
    @include('project.includes.footer')
@endsection
@section('scripts')
    <script src="{{asset('project/js/tel-input.js')}}"></script>
@endsection
