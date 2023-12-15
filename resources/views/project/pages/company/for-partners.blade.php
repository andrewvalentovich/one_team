@extends('project.includes.layouts')

@section('header')
    @include('project.includes.header')
@endsection

@section('seo')
<title>Ищем партнеров в Турции. Партнерство с банками и других организаций </title>
<meta name="description" content="Агентство Oneteam предлагает партнерство банкам и организациям различных сфер. Ищем партнеров, интересных покупателям недвижимости в Турции." />
@endsection

@section('content')
    <!-- {!! json_decode($get->content) !!} -->
    <section class="about">
        <div class="about__content maxContainer">
            <div class="hello__title title">
                Для партнёров
            </div>
            <div class="about__preview">
                <p class="about__preview-text">
                    Я уверен, что строить успешный бизнес в одиночку — невозможно, ведь предпринимательство развивается не в вакууме, а в окружении других участников рынка: в нашей сфере — сфере недвижимости — это другие агентства, банки, девелоперы, застройщики, подрядческие организации, а также клиенты. Выстраивая отношения со всеми ними, бизнес формирует свою репутацию, обогащается опытом, получает полезные инструменты для осуществления своей коммерческой деятельности и находит новые пути для роста. И если партнеры — достойные, то каждый из них вносит свой вклад в том числе и в развитие всей сферы деятельности.
                </p>
                <!-- <img class="about__preview-pic" src="{{asset('project/img/about-preview.png')}}" alt="о компании"> -->
                <p class="about__text-desc desc desc_blue">
                    Oneteam считает своей миссией вывод сделок с недвижимостью на совершенно новый уровень, что позволит существенно облегчить процедуру осуществления процессов купли-продажи объектов. В рамках этого мы уже разработали и успешно используем цифровую платформу на базе искусственного интеллекта, анализирующую рынок недвижимости и определяющую наиболее ликвидные объекты в пределах заданных параметров, и готовы поделиться своими наработками с другими агентствами, посредниками и риелторами в рамках нашей стратегии партнерства в Турции. 
                </p>
            </div>
            <div class="about__text">
                <p>
                    Покупка россиянами недвижимости в Турции за последние годы значительно участилась, и круг покупателей является довольно разнообразным, равно как и ассортимент предлагаемых в республике объектов. Чтобы удовлетворить потребности всех наших клиентов, мы формируем для них предложения «под ключ», которые включают все необходимые услуги по подбору недвижимости и осуществлению работ в рамках заключения сделки, а также предлагаем сопутствующие меры поддержки. 
                </p>
                <img src="{{asset('project/img/man.svg')}}" alt="картинка с человеком">
                <p>
                    Oneteam приглашает к сотрудничеству предприятия, предложения которых могут быть интересны покупателям турецкой недвижимости. И мы заинтересованы в том, чтобы клиент был максимально удовлетворен: ведь тогда он вернется снова и порекомендует нас другим. 
                </p>
            </div>
            <p class="about__text-desc desc desc_red">
                Мы привлекаем организации разнообразных профилей, не ограничиваясь агентствами, страховыми компаниями и банками партнерами в Турции. Агентства по прокату автомобилей и яхт, туристические компании, дизайн-студии, — каким бы ни был профиль вашей деятельности, мы с радостью рассмотрим вас в качестве нашего партнера, если ваши услуги актуальны для покупателей недвижимости и если вы готовы обеспечивать высокое качество сервиса.
            </p>
            <p class="about__text-desc desc desc_transparent" style="text-align: center; padding-top: 15px;">
                Напишите мне, и мы с вами обсудим наше будущее партнерство!
            </p>
        </div>
    </section>
@endsection


@section('footer')
    @include('project.includes.footer')
@endsection


@section('scripts')
    <script src="{{asset('project/js/app.js')}} "></script>
    <script src="{{asset('project/js/tel-input.js')}}"></script>
@endsection
