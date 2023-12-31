@extends('project.includes.layouts')

@section('header')
    @include('project.includes.header')
@endsection

@section('seo')
<title>{{ __('Стоимость недорогой недвижимости у моря в Турции: цены в рублях') }}</title>
<meta name="description" content="{{ __('Ищете недорогую недвижимость в Алании, Бурсе и других регионах у моря? На сайте Oneteam вы найдете актуальные цены на дома и квартиры в Турции. Торопитесь: стоимость будет только расти.') }}" />
@endsection

@section('content')
    <!-- {!! json_decode($get->content) !!} -->
    <section class="about">
        <div class="about__content maxContainer">
            <div class="hello__title title">
                {{ __('История') }}
            </div>
            <div class="about__preview">
                <p class="about__preview-text max">
                    <b class="inline">{{ __('Агентство Oneteam') }}</b> {{ __('выросло из маркетинговой IT-компании, специализирующейся на разработке высокотехнологичных продуктов для автоматизации бизнес-процессов, и представляет собой удачный симбиоз современных цифровых решений и приемов маркетинга. Не будучи ограниченными одной сферой применения разрабатываемых продуктов, мы пробовали себя в разных направлениях, пока наконец не остановились на рынке недвижимости.') }}
                </p>
                <p class="about__text-desc desc desc_blue" style="margin-bottom: 20px;">
                    {{ __('В Турции на тот момент наметились признаки грядущего повышения спроса на строящиеся объекты, чему способствовало и смягчение законодательства, и повышение интереса к Республике со стороны инвесторов. Поэтому Oneteam сфокусировалось на рынке недвижимости в Турции: недорогой — сначала, и лишь спустя некоторое время мы расширили спектр наших интересов на сегменты медиум и премиум.') }}
                </p>
                <p class="about__text-desc desc desc_red">
                    {{ __('С этим решением мы не прогадали, ведь недвижимость в Турции (у моря в первую очередь) показывает стабильный ежегодный ценовой прирост. Растут цены на недвижимость в Турции в рублях, в евро, в долларе, так как удорожание превышает девальвацию лиры. Инвестирование можно уверенно считать высокодоходным, так как в среднем стоимость недвижимости в Турции повышается на 15-25% в год, а в Алании и Бурсе эти цифры еще выше.') }}
                </p>
            </div>
            <div class="about__text margin">
                <p>
                    {{ __('Разработав цифровую платформу с возможностями автоматизации процесса продажи недвижимости и аналитики, мы опробовали ее на рынке недорогой недвижимости Турции — в Анталии. По истечению тестового периода стало ясно, что IT-решение идеально справляется со сбором и структурированием информации, и значительно упрощает как работу риелтора, так и процесс подбора недвижимости для непосредственно самого клиента.') }}
                </p>
                <img src="{{asset('project/img/man.svg')}}" alt="human-image">
                <p>
                    {{ __('После Анталии мы запустили CRM на других региональных рынках, и везде она показала успешные результаты, облегчая взаимодействие с базами данных, исследуя потребительские свойства объектов недвижимости и определяя наиболее релевантные клиентским запросам варианты.') }}
                </p>
            </div>
            <p class="about__text-desc desc desc_blue">
                {{ __('На сегодняшний день готовится запуск CRM в новом регионе, в котором мы уже работаем как агентство недвижимости, — в Северном Кипре, а в самых ближайших планах — запуск в таких локациях, как Катар, Объединенные Арабские Эмираты и Черногория.') }}
            </p>
        </div>
    </section>
@include('project.includes.advantages')
@include('project.includes.form-main')
@endsection


@section('footer')
    @include('project.includes.footer')
@endsection


@section('scripts')
    <script src="{{asset('project/js/app.js')}} "></script>
    <script src="{{asset('project/js/tel-input.js')}}"></script>
@endsection
