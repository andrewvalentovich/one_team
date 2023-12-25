@extends('project.includes.layouts')
<?php $title = 'Oneteam / ' . __('Контакты') ?>
@section('header')
    @include('project.includes.header')
@endsection

<style>
    /*.popular-locations__item:nth-last-child(-n+6){*/
    /*    display: block !important;*/
    /*}*/
    .popular-locations__item{
        align-items: center;
    }

</style>

@section('content')
    <!-- <?php echo json_decode($get->content )  ?> -->
    <div class="about">
        <div class="hello__title title">
            {{ __('Контакты') }}
        </div>
        <div class="contacts maxContainer">
            <ul class="contacts__list">
                <div class="contacts__subtitle">
                    {{ __('Контакты') }}:
                </div>
                <li>
                    <a href="tel:+74951067579">+74951067579</a>
                    <span>
                        {{ __('Москва') }}
                    </span>
                </li>
                <li>
                    <a href="tel:+998712051677">+998712051677</a>
                    <span>
                        {{ __('Узбекистан') }}
                    </span>
                </li>
                <li>
                    <a href="tel:+77172727498">+77172727498</a>
                    <span>
                        {{ __('Казахстан') }}
                    </span>
                </li>
                <li>
                    <a href="tel:+447478215412">+447478215412</a>
                    <span>
                        {{ __('Лондон') }}
                    </span>
                </li>
            </ul>
            <ul class="contacts__list">
                <div class="contacts__subtitle">
                    {{ __('Адрес') }}:
                </div>
                <li>
                    <span>
                        {{ __('Анталья, Коньяалты, Торос, улица 815, 1') }}
                    </span>
                </li>
            </ul>
            <iframe class="contacts__map" src="https://yandex.ru/map-widget/v1/?um=constructor%3A2e01e76fb81817ab7abc5adae305c6ccc877665e78da5ea6ab8abbedc7d5cae0&amp;source=constructor" frameborder="0"></iframe>
        </div>
    </div>
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
