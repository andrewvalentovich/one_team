@extends('project.includes.layouts')

@section('header')
    @include('project.includes.header')
@endsection

@section('seo')
<title>Сайт поиска недвижимости в Турции, которому можно доверять</title>
<meta name="description" content="Oneteam — сайт и цифровая платформа интеллектуального поиска и подбора недвижимости в Турции. Проверка юридической чистоты объектов и сопровождение сделок." />
@endsection

@section('content')
    <!-- {!! json_decode($get->content) !!} -->
    <section class="about">
        <div class="about__content maxContainer">
            <div class="hello__title title">
                Миссия
            </div>
            <div class="about__preview">
                <p class="about__preview-text">
                    Миссия  <b class="inline">Oneteam</b> заключается в том, чтобы облегчить процесс купли-продажи турецкой недвижимости для всех участников процесса: застройщиков, агентств, конечных потребителей. Для этого мы создали цифровую платформу — сайт поиска недвижимости в Турции, оснащенный искусственным интеллектом и способный на основе анализа потребностей подбирать самые релевантные результаты.
                </p>
            </div>
            <div class="about__text">
                <p>
                    Несмотря на то, что Турецкая Республика — вполне современная страна, здесь все еще сильны «личные связи», и многие решения принимаются на их основе. Мы считаем своей задачей минимизировать этот фактор и сделать так, чтобы все клиенты могли рассчитывать на честные и максимально выгодные условия приобретения недвижимости, а юридическая чистота объектов перешла в разряд нормы. 
                </p>
                <img src="{{asset('project/img/man.svg')}}" alt="картинка с человеком">
                <p>
                    Наш сайт недвижимости в Турции предназначен для того, чтобы наладить четкий и прямой контакт между застройщиком и потребителем, и исключить из него всех посредников, кроме специализированных агентств, тем самым сократив цепочку взаимодействия и сделав процедуру поиска недвижимости в Турции более простой, процесс приобретения — открытым, а его условия — «прозрачными».
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
    <script src="{{asset('project/js/app.js')}} "></script>
    <script src="{{asset('project/js/tel-input.js')}}"></script>
@endsection
