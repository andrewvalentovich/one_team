@extends('project.includes.layouts')

@section('header')
    @include('project.includes.header')
@endsection

@section('content')
    <!-- {!! json_decode($get->content) !!} -->
    <section class="about">
        <div class="about__content maxContainer">
            <div class="hello__title title">
                О проекте
            </div>
            <div class="about__preview">  
                <p class="about__preview-text">
                    <b>Oneteam</b> — лицензированное агентство недвижимости, практикующее нестандартный подход к решению задач. Большинство наших коллег работает «по старинке», пользуясь для ведения баз данных облачными сервисами, из-за чего страдает актуальность предложений: например, вам могут случайно «продать» квартиру в Турции, которая уже забронирована кем-то другим.
                </p>
                <img class="about__preview-pic" src="{{asset('project/img/about-preview.png')}}" alt="о компании">
                <p class="about__text-desc desc desc_blue">
                    Чтобы автоматизировать процесс продажи недвижимости, мы разработали собственный IT-продукт — цифровую платформу на основе искусственного интеллекта, которая определяет наиболее перспективные объекты на основе анализа рынков сбыта, предоставляя инвесторам возможность приобретать недвижимость, основываясь не на умозаключениях, а на аналитических выкладках алгоритма, обученного принимать непредвзятые решения.
                </p>
            </div>
            <div class="about__text">  
                <p>
                    Цифровая платформа ведет учет находящихся на рынке домов и квартир в Турции, а также подбирает объекты в соответствии с клиентскими запросами, анализирует ликвидность и потребительские параметры, и наглядно представляет информацию о районе расположения и его инфраструктуре. В ее состав также входит CRM со сквозной аналитикой.
                </p>
                <img src="{{asset('project/img/man.svg')}}" alt="картинка с человеком">
                <p>
                    Используя возможности цифровой платформы, можно уточнить, сколько стоит недвижимость в Турции в пределах выбранного вами района, найти подходящую по метражу и характеристикам квартиру, проверить ее ликвидность и «чистоту», а также выяснить, находится ли она в сделке или на брони, и закрепить ее за собой… либо перейти к следующему варианту.
                </p>
            </div>
            <p class="about__text-desc desc desc_red">
                Чтобы автоматизировать процесс продажи недвижимости, мы разработали собственный IT-продукт — цифровую платформу на основе искусственного интеллекта, которая определяет наиболее перспективные объекты на основе анализа рынков сбыта, предоставляя инвесторам возможность приобретать недвижимость, основываясь не на умозаключениях, а на аналитических выкладках алгоритма, обученного принимать непредвзятые решения.
            </p>
        </div>
    </section>
    @include('project.includes.advantages')
    <div class="questions-w">
        <section class="questions">
            <div class="questions__content">
                <div class="questions__pic">
                    <img src="{{asset('project/img/questions-index.png')}}" alt="">
                </div>
                <div class="questions__form-w">
                    <form class="questions__form form-fio-phone">
                        <p class="questions__title">
                            Остались вопросы?
                        </p>
                        <p class="questions__subtitle">
                            Оставьте заявку и мы Вам перезвоним
                        </p>
                        <label class="field name input-wrapper" bis_skin_checked="1">
                            <span class="text">
                                ФИО
                            </span>
                            <input type="text" value="" placeholder="Иванов Алексей Петрович" name="fio">
                        </label>
                        <div class="contact__form-phone input-wrapper">
                            <span class="text">
                                {{__('Номер телефона')}}
                            </span>
                            <input class="selector-list-phone" id="phone" name="phone">
                        </div>
                        <label class="contact__form-politic">
                            <input class="contact__form-politic-checkbox contact__form-checkbox " type="checkbox" id="contact__form-politic" checked="">
                            <div class="contact__form-custom-checkbox one_check"></div>
                            <div class="contact__form-checkbox-text">
                                Ознакомлен с <span>политикой конфеденциальности</span>
                            </div>
                        </label>
                        <label class="contact__form-data">
                            <input class="contact__form-data-checkbox contact__form-checkbox" type="checkbox" id="contact__form-data">
                            <div class="contact__form-custom-checkbox two_check"></div>
                            <div class="contact__form-checkbox-text">
                                Согласен на обработку <span>персональных данных</span>
                            </div>
                        </label>
                        <button type="submit" class="btn btn_blue">
                            Отправить заявку
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('footer')
    @include('project.includes.footer')
@endsection


@section('scripts')
    <script src="{{asset('project/js/app.js')}} "></script>
    <script src="{{asset('project/js/tel-input.js')}}"></script>
@endsection