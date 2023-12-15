<div class="header-w">
    <div class="header-m">
        <div class="header-m__content">
            <div class="header-m__list">
                <div class="header-m__item header-m__langs">
                    @foreach($locales as $locale)
                    <div class="header-m__langs-item">
                        <a style="display: flex;" href="{{route('setLocale', $locale->code)}}">
                        <div class="header-m__langs-title">
                            {{ $locale->code }}
                        </div>
                        <div class="header-m__langs-img">
                            <img style="width: 24px;height: 18px;" src="{{ asset(isset($locale->icon) ? $locale->icon_path : null)  }}" alt="{{ $locale->code }}">
                        </div>
                        </a>
                    </div>
                    @endforeach
{{--                    <div class="header-m__langs-item">--}}
{{--                        <a style="display: flex;" href="{{route('setLocale','en')}}">--}}
{{--                        <div class="header-m__langs-title">--}}
{{--                            EN--}}
{{--                        </div>--}}
{{--                        <div class="header-m__langs-img">--}}
{{--                            <img src="{{asset('project/img/countries/usa.png')}}" alt="usa">--}}
{{--                        </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="header-m__langs-item active">--}}
{{--                        <a style="display: flex;" href="{{route('setLocale','ru')}}">--}}
{{--                            <div class="header-m__langs-title">--}}
{{--                                RU--}}
{{--                            </div>--}}
{{--                            <div class="header-m__langs-img">--}}
{{--                                <img src="{{asset('project/img/countries/ru.png')}}" alt="ru">--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="header-m__langs-item">--}}
{{--                        <a style="display: flex;" href="{{route('setLocale','tr')}}">--}}
{{--                            <div class="header-m__langs-title">--}}
{{--                                TR--}}
{{--                            </div>--}}
{{--                            <div class="header-m__langs-img">--}}
{{--                                <img src="{{asset('project/img/countries/tr.png')}}" alt="tr">--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="header-m__langs-item">--}}
{{--                        <a style="display: flex;" href="{{route('setLocale','de')}}">--}}
{{--                            <div class="header-m__langs-title">--}}
{{--                                DE--}}
{{--                            </div>--}}
{{--                            <div class="header-m__langs-img">--}}
{{--                                <img src="{{asset('project/img/countries/gr.png')}}" alt="tr">--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="header-m__langs-item">--}}
{{--                        <a style="display: flex;" href="{{route('setLocale','ar')}}">--}}
{{--                            <div class="header-m__langs-title">--}}
{{--                                AR--}}
{{--                            </div>--}}
{{--                            <div class="header-m__langs-img">--}}
{{--                                <img src="{{asset('project/img/countries/ar.png')}}" alt="tr">--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>
                <div class="header-m__item header-m__buy header-m__item-btn">
                    <div class="header-m__item-text">
                        {{__('Купить') }}
                    </div>
                    <div class="header-m__aboute-list">
                        <div class="header-m__aboute-content">
                            <a href="{{ route('realty', ['categories' => 'buy']) }}">
                                {{__('Жилая')}}
                            </a>
                            <a href="{{ route('realty', ['categories' => 'commercial/buy']) }}">
                                {{__('Коммерческая')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-m__item header-m__buy header-m__item-btn">
                    <div class="header-m__item-text">
                        {{__('Снять') }}
                    </div>
                    <div class="header-m__aboute-list">
                        <div class="header-m__aboute-content">
                            <a href="{{ route('realty', ['categories' => 'rent']) }}">
                                {{__('Жилая')}}
                            </a>
                            <a href="{{ route('realty', ['categories' => 'commercial/rent']) }}">
                                {{__('Коммерческая')}}
                            </a>
                        </div>
                    </div>
                </div>
{{--                <a href="{{ route('realty', ['categories' => 'rent']) }}" class="header-m__item">--}}
{{--                    <div class="header-m__item-text">--}}
{{--                       {{__('Снять')}}--}}
{{--                    </div>--}}
{{--                </a>--}}
                <a href="{{ route('investments') }}" class="header-m__item">
                    <div class="header-m__item-text">
                        {{__('Инвестиции')}}
                    </div>
                </a>
                <a href="{{route('residence_and_citizenship')}}" class="header-m__item">
                    <div class="header-m__item-text">
                        {{__('ВНЖ и Гражданство')}}
                    </div>
                </a>
                <a href="{{route('installment_plan')}}" class="header-m__item">
                    <div class="header-m__item-text">
                        {{__('Рассрочка')}}
                    </div>
                </a>
                <div class="header-m__item header-m__item-btn header-m__aboute ">
                    <div class="header-m__item-text">
                        {{__('О компании')}}
                    </div>
                    <?php $company_pages = \App\Models\CompanySelect::orderby('status' , 'asc')->orderby('updated_at', 'desc')->get(); ?>
                    <div class="header-m__aboute-list">
                        <div class="header-m__aboute-content">
                            @foreach($company_pages  as $pages)
                                <a href="{{ route('about', $pages->slug) }}">
                                    <div class="header-m__aboute-item">
                                        {{__($pages->name)}}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a href="{{route('contacts')}}" class="header-m__item">
                    <div class="header-m__item-text">
                        {{__('Контакты')}}
                    </div>
                </a>
            </div>
        </div>
    </div>
    <header class ="header header_1200">
        <div class="header__top">
            <!-- <div class="header__top-lang">
                <div class="header__top-lang-item">

                    {{ strtoupper(app()->getLocale())}}
                </div>
                <div class="header__lang-list-dropdown">
                    <div class="header__lang-list">
                        <div class="header__lang-list-item">
                            <a style="display: flex;" href="{{route('setLocale','en')}}">
                                <div class="header__lang-text">
                                EN
                            </div>

                            <div class="header__lang-img">
                                <img src="{{asset('project/img/countries/us.png')}}" alt="us">
                            </div>
                            </a>
                        </div>
                        <div class="header__lang-list-item">
                            <a style="display: flex;" href="{{route('setLocale','ru')}}">
                            <div class="header__lang-text">
                                RU
                            </div>
                            <div class="header__lang-img">
                                <img src="{{asset('project/img/countries/ru.png')}}" alt="ru">
                            </div>
                            </a>
                        </div>
                        <div class="header__lang-list-item">
                            <a style="display: flex;" href="{{route('setLocale','tr')}}">
                            <div class="header__lang-text">
                                TR
                            </div>
                            <div class="header__lang-img">
                                <img src="{{asset('project/img/countries/tr.png')}}" alt="tr">
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="header__top-phone-menu">
                <div id="nav-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <a href="{{route('home_page')}}" class="header__top-logo">
                <img src="{{asset('project/img/svg/new_logo.svg')}}" alt="logo">
            </a>
            <div class="header__top-favorites">
                <div class="header__top-favorites-img">
                    <a href="{{route('my_favorites')}}"><img src="{{asset('project/img/svg/favorites-2.svg')}}" alt="favorites"></a>
                </div>

                <div class="header__top-favorites-value"  @if($fav_count == 0) style="display: none" @endif>
                    {{ isset($fav_count) ? $fav_count : "" }}
                </div>
            </div>
        </div>
        <div class="header__nav container">
            <div class="header__nav-list">
                <div class="header__nav-item">
                    <a href="#" class="header__nav-title header__nav-buy ">
                        {{__('Купить')}}
                    </a>
                    <div class="header__nav-item-dropdown header__buy-dropdown">
                        <div class="header__buy-list header__dropdown-list">
                            <a href="{{ route('realty', ['categories' => 'buy']) }}" class="header__list-item header__buy-list-item">
                                {{__('Жилая')}}
                            </a>
                            <a href="{{ route('realty', ['categories' => 'commercial/buy']) }}" class="header__list-item header__buy-list-item">
                                {{__('Коммерческая')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header__nav-item">
                    <a href="#" class="header__nav-title header__nav-rent ">
                        {{__('Снять')}}
                    </a>
                    <div class="header__nav-item-dropdown header__rent-dropdown">
                        <div class="header__rent-list header__dropdown-list">
                            <a href="{{ route('realty', ['categories' => 'rent']) }}" class="header__list-item header__rent-list-item">
                                {{__('Жилая')}}
                            </a>
                            <a href="{{ route('realty', ['categories' => 'commercial/rent']) }}" class="header__list-item header__rent-list-item">
                                {{__('Коммерческая')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header__nav-item">
                    <a href="{{route('investments')}}" class="header__nav-title">
                        {{__('Инвестиции')}}
                    </a>
                </div>
                <div class="header__nav-item">
                    <a href="{{route('residence_and_citizenship')}}" class="header__nav-title">
                        {{__('ВНЖ и Гражданство')}}
                    </a>
                </div>
            </div>
            <a href="{{route('home_page')}}" class="header__top-logo">
                <img src="{{asset('project/img/svg/new_logo.svg')}}" alt="logo">
             </a>
            <div class="header-right-menu">
                <div class="header__nav-list">
                    <div class="header__nav-item">
                        <a href="{{route('installment_plan')}}" class="header__nav-title">
                            {{__('Рассрочка')}}
                        </a>
                    </div>
                    <div class="header__nav-item">
                        <div class="header__nav-title header__nav-about">
                            {{__('О компании')}}
                        </div>
                        <div class="header__nav-item-dropdown header__about-dropdown">
                            <div class="header__about-list header__dropdown-list">
                                @foreach($company_pages as $pages)
                                    <a href="{{ route('about', $pages->slug) }}" class="header__list-item header__about-list-item">
                                        {{__($pages->name)}}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="header__nav-item">
                        <a href="{{route('contacts')}}" class="header__nav-title">
                            {{__('Контакты')}}
                        </a>
                        </d>
                    </div>
                </div>
                <div class="header__nav-action">
                    <div class="header__top-lang">
                        <div class="header__top-lang-item">

                            {{ strtoupper(app()->getLocale())}}
                        </div>
                        <div class="header__lang-list-dropdown">
                            <div class="header__lang-list">
                                @foreach($locales as $locale)
                                <div class="header__lang-list-item">
                                    <a style="display: flex;" href="{{route('setLocale', $locale->code)}}">
                                        <div class="header__lang-text">
                                            {{ $locale->code }}
                                        </div>
                                        <div class="header__lang-img">
                                            <img style="width: 24px; height: 18px;" src="{{ asset(isset($locale->icon) ? $locale->icon_path : null) }}" alt="{{ $locale->code }}">
                                        </div>
                                    </a>
                                </div>
                                @endforeach
{{--                                <div class="header__lang-list-item">--}}
{{--                                    <a style="display: flex;" href="{{route('setLocale','en')}}">--}}
{{--                                        <div class="header__lang-text">--}}
{{--                                            EN--}}
{{--                                        </div>--}}
{{--                                        <div class="header__lang-img">--}}
{{--                                            <img src="{{asset('project/img/countries/us.png')}}" alt="en">--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="header__lang-list-item">--}}
{{--                                    <a style="display: flex;" href="{{route('setLocale','ru')}}">--}}
{{--                                    <div class="header__lang-text">--}}
{{--                                        RU--}}
{{--                                    </div>--}}
{{--                                    <div class="header__lang-img">--}}
{{--                                        <img src="{{asset('project/img/countries/ru.png')}}" alt="ru">--}}
{{--                                    </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="header__lang-list-item">--}}
{{--                                    <a style="display: flex;" href="{{route('setLocale','tr')}}">--}}
{{--                                    <div class="header__lang-text">--}}
{{--                                        TR--}}
{{--                                    </div>--}}
{{--                                    <div class="header__lang-img">--}}
{{--                                        <img src="{{asset('project/img/countries/tr.png')}}" alt="tr">--}}
{{--                                    </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="header__lang-list-item">--}}
{{--                                    <a style="display: flex;" href="{{route('setLocale','de')}}">--}}
{{--                                    <div class="header__lang-text">--}}
{{--                                        DE--}}
{{--                                    </div>--}}
{{--                                    <div class="header__lang-img">--}}
{{--                                        <img src="{{asset('project/img/countries/gr.png')}}" alt="tr">--}}
{{--                                    </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="header__top-favorites">
                        <div class="header__top-favorites-img">
                            <a href="{{route('my_favorites')}}"><img src="{{asset('project/img/svg/favorites-2.svg')}}" alt="favorites"></a>
                        </div>

                        <div class="header__top-favorites-value"  @if($fav_count == 0) style="display: none" @endif>
                            {{ isset($fav_count) ? $fav_count : "" }}
                        </div>
                    </div>
                </div>
            </div>
    </header>
</div>
