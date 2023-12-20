@extends('project.includes.layouts')

@section('header')
    @include('project.includes.header')
@endsection

@section('content')
    <!-- {!! json_decode($get->content) !!} -->
    <section class="about">
        <div class="about__content maxContainer">
            <div class="hello__title title">
                Отзывы
            </div>
            <div class="about__preview">
                <div style="width:100%; max-width: 560px;height:800px;overflow:hidden;position:relative; margin: 0 auto 20px;">
                    <iframe style="width:100%;height:100%;border:1px solid #e6e6e6;border-radius:8px;box-sizing:border-box" src="https://yandex.ru/maps-reviews-widget/63917211618?comments"></iframe>
                    <a href="https://yandex.ru/maps/org/oneteam_in_aat/63917211618/" target="_blank" style="box-sizing:border-box;text-decoration:none;color:#b3b3b3;font-size:10px;font-family:YS Text,sans-serif;padding:0 20px;position:absolute;bottom:8px;width:100%;text-align:center;left:0;overflow:hidden;text-overflow:ellipsis;display:block;max-height:14px;white-space:nowrap;padding:0 16px;box-sizing:border-box">
                        Oneteam İnşaat на карте Антальи — Яндекс Карты
                    </a>
                </div>
                <review-lab data-widgetid="657c2d7290604f4f280fe74f"></review-lab>
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
    <script src="https://app.reviewlab.ru/widget/index-es2015.js" defer></script>
    <script src="{{asset('project/js/app.js')}} "></script>
    <script src="{{asset('project/js/tel-input.js')}}"></script>
@endsection

<style>
    .widget__src--logo {
        display: none !important;
    }
    .ngucarousel {
        height: fit-content !important;
    }
    .ngucarousel-items {
        height: auto !important;
    }
</style>