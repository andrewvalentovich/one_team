@extends('project.includes.layouts')

@section('header')
    @include('project.includes.header')
@endsection

@section('content')
    <!-- {!! json_decode($get->content) !!} -->
    <section class="about">
        <div class="about__content maxContainer">
            <div class="hello__title title">
                {{ __('Пресса') }}
            </div>
            <div class="about__preview">
                <p class="about__preview-text">
                    <b>Oneteam</b> {{ __('— лицензированное агентство недвижимости, практикующее нестандартный подход к решению задач. Большинство наших коллег работает «по старинке», пользуясь для ведения баз данных облачными сервисами, из-за чего страдает актуальность предложений: например, вам могут случайно «продать» квартиру в Турции, которая уже забронирована кем-то другим.') }}
                </p>
                <img class="about__preview-pic" src="{{asset('project/img/about-preview.png')}}" alt="about-company">
                <p class="about__text-desc desc desc_blue">
                    {{ __('Чтобы автоматизировать процесс продажи недвижимости, мы разработали собственный IT-продукт — цифровую платформу на основе искусственного интеллекта, которая определяет наиболее перспективные объекты на основе анализа рынков сбыта, предоставляя инвесторам возможность приобретать недвижимость, основываясь не на умозаключениях, а на аналитических выкладках алгоритма, обученного принимать непредвзятые решения.') }}
                </p>
            </div>
            <div class="about__text margin">
                <p>
                    {{ __('Цифровая платформа ведет учет находящихся на рынке домов и квартир в Турции, а также подбирает объекты в соответствии с клиентскими запросами, анализирует ликвидность и потребительские параметры, и наглядно представляет информацию о районе расположения и его инфраструктуре. В ее состав также входит CRM со сквозной аналитикой.') }}
                </p>
                <img src="{{asset('project/img/man.svg')}}" alt="human-image">
                <p>
                    {{ __('Используя возможности цифровой платформы, можно уточнить, сколько стоит недвижимость в Турции в пределах выбранного вами района, найти подходящую по метражу и характеристикам квартиру, проверить ее ликвидность и «чистоту», а также выяснить, находится ли она в сделке или на брони, и закрепить ее за собой… либо перейти к следующему варианту.') }}
                </p>
            </div>
{{--            <p class="about__text-desc desc desc_red">--}}
{{--                Чтобы автоматизировать процесс продажи недвижимости, мы разработали собственный IT-продукт — цифровую платформу на основе искусственного интеллекта, которая определяет наиболее перспективные объекты на основе анализа рынков сбыта, предоставляя инвесторам возможность приобретать недвижимость, основываясь не на умозаключениях, а на аналитических выкладках алгоритма, обученного принимать непредвзятые решения.--}}
{{--            </p>--}}
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
