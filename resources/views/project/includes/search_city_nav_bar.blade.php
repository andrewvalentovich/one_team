

<?php $filter = \App\Models\Peculiarities::all() ?>



@if(isset($country->id))

    <?php  $id = $country->id ?>

    @else

    <?php $id = 1;  ?>

    @endif

<style>

    .search-nav__list-item {

        flex: 1;

        position: relative;

    }

    @media (max-width: 899px) {

        .dropdown {

            display: none;

        }



    }

    .dropdown.active .search-nav__item-dropdown {

        display: block;

    }

    /*.search-nav__item-dropdown {*/

    /*    padding: 26px 20px 29px 29px;*/

    /*    width: 250px;*/

    /*    border-radius: 0px 5px 5px 5px;*/

    /*}*/

    /*.search-nav__list-item-title.search-nav__find-title {*/

    /*    line-height: 10px;*/

    /*}*/

</style>



<div class="search-nav-w">

    <form action="{{ route('city', $id) }}" class="header_search" method="get">

        @if(isset($_GET['ot_zastroishika']))

            <input type="hidden" name="ot_zastroishika" value="{{$_GET['ot_zastroishika']}}">

            @endif

            @if(isset($_GET['sale_or_rent']))

                <input type="hidden" name="type" value="{{$_GET['sale_or_rent']}}">

            @endif

            @if(isset($_GET['orderby']))

                <input type="hidden" name="orderby" value="{{$_GET['orderby']}}">

            @endif

    <div class ="search-nav container">

        <div class="search-nav__list">

                <?php $get_citys = \App\Models\CountryAndCity::find(17);
                $get_city = \App\Models\CountryAndCity::where('parent_id', $get_citys->parent_id)->get();

            ?>



            <input type="hidden" name="city_id" value="{{$get_citys->id}}">

            <div class="search-nav__list-item  search-nav__list-item_b search-nav__list-item_arrow dropdown other-element" data_id="country">

                <div class="search-nav__list-item-title dropdown__title">
                    @if(app()->getLocale() == 'en') <?php $get_citys->name = $get_citys->name_en ?> @elseif(app()->getLocale() == 'tr') <?php $get_citys->name = $get_citys->name_tr ?> @endif
                    {{$get_citys->name}}

                </div>

                <div class="search-nav__item-dropdown  " style="   padding: 26px 20px 29px 29px;

        width: 250px;

        border-radius: 0px 5px 5px 5px;">

                    <div class="search-nav__types-list">

                        @foreach($get_city as $city )

                        <div data_id="{{$city->id}}" class="city search-nav__types-item dropdown__selector other-element">


                            @if(app()->getLocale() == 'en') <?php $city->name = $city->name_en ?> @elseif(app()->getLocale() == 'tr') <?php $city->name = $city->name_tr ?> @endif

                            {{ $city->name}}

                        </div>

                            @endforeach

                    </div>
                    <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Слой_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                            <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                            <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                        </g>
                    </svg>

                </div>

            </div>

            <div class="search-nav__list-item search-nav__types search-nav__list-item_b search-nav__list-item_arrow" data_id="type" >

                <div class="search-nav__list-item-title search-nav__types-title type_select">



                    @if(isset($_GET['type']) && $_GET['type'] != '')

                        {{\App\Models\Peculiarities::where('id', $_GET['type'])->first()->name}}

                        @else



{{--                        Все типы--}}
                        {{__('Все типы')}}

                    @endif

                </div>

                <div class="search-nav__item-dropdown search-nav__types-dropdown closert_div_parent">

                    <div class="search-nav__types-list">

                        @foreach($filter->where('type', 'Типы') as $type)

                        <div data_id="{{$type->id}}"  class="search-nav__types-item type closert_div">

                         {{__($type->name)}}

                        </div>

                            @endforeach

                    </div>
                    <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Слой_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                            <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                            <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                        </g>
                    </svg>
                </div>

            </div>

            <div class="search-nav__list-item search-nav__price search-nav__list-item_b search-nav__list-item_arrow " data_id="price">

                <div class="search-nav__list-item-title search-nav__price-title">

                    {{__('Цена')}}

                </div>

                <div class="search-nav__item-dropdown search-nav__price-dropdown">
                    <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Слой_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                            <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                            <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                        </g>
                    </svg>
                    <div class="search-nav__price-dropdown-title">

                        {{__('Цена')}}

                    </div>

                    <div class="search-nav__price-filter">

                        <div class="search-nav__price-filter-price">

                            <input class="search-nav__price-min search-nav__price-item" min="0" type="number" placeholder="{{__('от')}}" name="min_price" @if(isset($_GET['min_price'])) value="{{$_GET['min_price']}}"  @endif>

                            <div class="search-nav__price-beetwen">

                                -

                            </div>

                            <input class="search-nav__price-max search-nav__price-item" min="0" type="number" placeholder="{{__('до')}}" name="max_price" @if(isset($_GET['max_price'])) value="{{$_GET['max_price']}}" @endif>

                        </div>



                        @if(isset( $_GET['currency_type']) && $_GET['currency_type'] == '')

                            <input type="hidden" name="currency_type" value="{{$_GET['currency_type']}}">

                        @endif

                        <div class="search-nav__price-filter-currency">

                            @if(!isset($_GET['currency_type']) || $_GET['currency_type'] == 'euro' || $_GET['currency_type'] == '')

                            <div class="search-nav__price-currency-item active currency_type" currency_type="euro">

                                @else

                                    <div class="search-nav__price-currency-item currency_type" currency_type="euro">

                                    @endif

                                €

                            </div>

                                    @if(isset($_GET['currency_type']) &&$_GET['currency_type'] == 'rub')

                            <div class="search-nav__price-currency-item currency_type active" currency_type="rub">

                                @else

                                    <div class="search-nav__price-currency-item currency_type" currency_type="rub">

                                    @endif

                                ₽

                            </div>

                            @if(isset($_GET['currency_type']) &&  $_GET['currency_type'] == 'lira')

                            <div class="search-nav__price-currency-item currency_type active" currency_type="lira">

                                @else

                                    <div class="search-nav__price-currency-item currency_type" currency_type="lira">

                                    @endif

                                ₤

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="search-nav__list-item search-nav__rooms search-nav__list-item_b search-nav__list-item_arrow" data_id="spalni">

                <div class="search-nav__list-item-title search-nav__rooms-title">

                   {{__('Спальни')}}, {{__('Ванные')}}

                </div>

                <div class="search-nav__item-dropdown search-nav__rooms-dropdown">
                    <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Слой_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                            <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                            <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                        </g>
                    </svg>
                    <div class="search-nav__dropdown-content search-nav__rooms-dropdown-content">

                        <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">

                            <div class="search-nav__rooms-dropdown-title">

                                {{__('Спальни')}}

                            </div>

                            <input type="hidden" name="spalni_id" value="@if(isset($_GET['spalni_id'])) {{$_GET['spalni_id'] }} @endif">

                            <div class="search-nav__rooms-dropdown-bedrooms-buttons">

                                <?php $i = 0 ?>

                                @foreach($filter->where('type','Спальни') as $spalni)

                                    <?php $i++ ?>

                                <div data_id="{{$spalni->id}}" class="spalni search-nav__rooms-dropdown-bedrooms-button @if(!isset($_GET['spalni_id']) && $i == 1 || isset($_GET['spalni_id']) && $_GET['spalni_id'] == $spalni->id )   active @endif" >

                                 {{__($spalni->name) }}

                                </div>

                                @endforeach



                            </div>

                        </div>

                        <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">

                            <div class="search-nav__rooms-dropdown-title">

                                {{__('Ванные')}}
{{--                                Ванные--}}

                            </div>

                            <input type="hidden" name="vannie_id" value="@if(isset($_GET['vannie_id'])) {{$_GET['vannie_id']}} @endif" >

                            <div class="search-nav__rooms-dropdown-bathrooms-buttons">

                                <?php $a =0; ?>

                                @foreach($filter->where('type','Ванные') as $vannie)

                                    <?php $a++ ?>

                                <div data_id="{{$vannie->id}}" class="vannie search-nav__rooms-dropdown-bathrooms-button @if(!isset($_GET['vannie_id']) && $a == 1 || isset($_GET['vannie_id']) && $_GET['vannie_id'] == $vannie->id ) active @endif">

                                   {{__($vannie->name) }}

                                </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="search-nav__list-item search-nav__more search-nav__list-item_b " data_id="more">
                <div class="search-nav__list-item-title search-nav__more-title">


                    {{__('Еще')}}

                </div>

                <div class="search-nav__item-dropdown search-nav__more-dropdown ">
                    <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Слой_x0020_1">
                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                            <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                            <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                        </g>
                    </svg>
                    <div class="search-nav__dropdown-item">

                        <div class="more-dropdown__title">

                          {{__('Особенности')}}

                        </div>

                        <div class="more-dropdown__peculiarities-list">

                            <?php $ch= 0 ?>

                            @foreach($filter->where('type', 'Особенности') as $osobenosti)

                            <div class="more-dropdown__peculiarities-item">

                                <label class="more-dropdown__peculiarities">

                                    <input name="osobenost[{{$osobenosti->id}}]" data_id="{{$osobenosti->id}}" class="more-dropdown__peculiarities-tv-checkbox more-dropdown__peculiarities-checkbox" type="checkbox"

                                   @if(isset($_GET['osobenost']))

                                    @foreach($_GET['osobenost'] as $key => $value)

                                            @if($key == $osobenosti->id)

                                                checked

                                           @endif

                                        @endforeach

                                            @endif

                                    >

                                    <div class="more-dropdown-custom-checkbox"></div>

                                    <div class="more-dropdown-checkbox-text">

                                        {{__($osobenosti->name)}}

                                    </div>

                                </label>

                            </div>

                            @endforeach

                        </div>

                    </div>

                    <div class="search-nav__dropdown-item more-dropdown__view">

                        <div class="more-dropdown__title">

                        {{__('Вид')}}

                        </div>

                        <div class="more-dropdown__view-item">



                            <input type="hidden" name="vid_id" value="@if(isset($_GET['vid_id'])) {{$_GET['vid_id']}} @endif">

                            @foreach($filter->where('type','Вид') as $vid)

                                @if(isset($_GET['vid_id']) && $_GET['vid_id'] == $vid->id)

                            <div data_id="{{$vid->id}}" class="vid search-nav__dropdown-button search-nav__view-button active">

                                @else

                                    <div data_id="{{$vid->id}}" class="vid search-nav__dropdown-button search-nav__view-button">

                                    @endif

                               {{__($vid->name)}}

                            </div>

                            @endforeach

                        </div>

                    </div>

                    <div class="search-nav__dropdown-item more-dropdown__sea">

                        <div class="more-dropdown__title">

                          {{__('До моря')}}

                        </div>

                        <div class="more-dropdown__sea-item">

                            <input type="hidden" name="do_more_id" value="@if(isset($_GET['do_more_id'])){{$_GET['do_more_id']}}@endif">

                            @foreach($filter->where('type','До моря') as $do_more)

                                @if(isset($_GET['do_more_id']) && $_GET['do_more_id'] == $do_more->id)

                            <div data_id="{{$do_more->id}}" class="do_more search-nav__dropdown-button search-nav__sea-button active">

                                @else

                                    <div data_id="{{$do_more->id}}" class="do_more search-nav__dropdown-button search-nav__sea-button">

                                    @endif

                              {{__($do_more->name)}}

                            </div>

                            @endforeach



                        </div>

                    </div>

                    <div class="search-nav__dropdown-item more-dropdown__square">

                        <div class="more-dropdown__title">

                           {{__('Площади (кв.м)')}}

                        </div>

                        <div class="more-dropdown__square-item">

                            <input placeholder="{{__('Общая')}}" name="all_size" value="@if(isset($_GET['all_size'])){{trim($_GET['all_size'], ' ') }}@endif">

                            <input placeholder="{{__('Дом')}}" name="home_size" value="@if(isset($_GET['home_size'])){{trim($_GET['home_size'], ' ')}}@endif">

                        </div>

                    </div>

                </div>

            </div>

            <div class="search-nav__list-item search-nav__find search-nav__list-item_b form_button">

                <div class="search-nav__list-item-title search-nav__find-title">

                    {{__('Найти')}}

                </div>

                <svg class="search-nav__icon"  xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="59px" height="59px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"

                     viewBox="0 0 1.61 1.61"

                     xmlns:xlink="http://www.w3.org/1999/xlink">

                        <g id="Слой_x0020_1">

                            <metadata id="CorelCorpID_0Corel-Layer"/>

                            <circle class="fil0 str0" cx="0.67" cy="0.67" r="0.6"/>

                            <line class="fil0 str0" x1="1.09" y1="1.09" x2="1.56" y2= "1.56" />

                        </g>

                </svg>

            </div>

        </div>

    </div>

    </form>

</div>



<div class="search-w">

    <svg class="search-w__close" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"

         viewBox="0 0 0.37 0.37"

         xmlns:xlink="http://www.w3.org/1999/xlink">

        <g id="Слой_x0020_1">

            <metadata id="CorelCorpID_0Corel-Layer"/>

            <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2= "0.02" />

            <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2= "0.02" />

        </g>

    </svg>

    <form action="{{ route('real_estate.index') }}" class="header_search_two" method="get"/>

    @if(isset($_GET['ot_zastroishika']))

        <input type="hidden" name="ot_zastroishika" value="{{$_GET['ot_zastroishika']}}">

    @endif

    @if(isset($_GET['orderby']))

        <input type="hidden" name="orderby" value="{{$_GET['orderby']}}">

    @endif

    <div class="search">

        <div class="search__content">



            <div class="search__filter">

                <div class="search__filter-item search__filter-types">

                    <div class="search__filter-title">

                        {{__('Тип недвижимости')}}


                    </div>

                    <div class="search__filter-types-list">

                        @foreach($filter->where('type', 'Типы') as $type)

                            @if(isset($_GET['type']) && $_GET['type'] == $type->id)

                                <div data_id="{{$type->id}}" class="search__filter-types-item type" style="    background: #508cfa; color: white;">

                                    @else

                                        <div data_id="{{$type->id}}" class="search__filter-types-item type">

                                            @endif

                                            {{__($type->name)}}

                                        </div>

                                        @endforeach

                    </div>

                </div>

                <div class="search__filter-item search__filter-price">

                    <div class="search-nav__price-dropdown-title">

                        {{__('Цена')}}

                    </div>

                    <div class="search-nav__price-filter">

                        <div class="search-nav__price-filter-price">

                            <input class="search-nav__price-min search-nav__price-item" min="0" type="number" placeholder="{{__('от')}}" name="min_price" @if(isset($_GET['min_price'])) value="{{$_GET['min_price']}}" @endif>

                            <div class="search-nav__price-beetwen">

                                -

                            </div>

                            <input class="search-nav__price-max search-nav__price-item" min="0" type="number" placeholder="{{__('до')}}" name="max_price" @if(isset($_GET['max_price'])) value="{{$_GET['max_price']}}" @endif>

                        </div>



                        @if(isset( $_GET['currency_type']) && $_GET['currency_type'] == '')

                            <input type="hidden" name="currency_type" value="{{$_GET['currency_type']}}">

                        @endif

                        <div class="search-nav__price-filter-currency">

                            @if(!isset($_GET['currency_type']) || $_GET['currency_type'] == 'euro' || $_GET['currency_type'] == '')

                                <div class="search-nav__price-currency-item active currency_type" currency_type="euro">

                                    @else

                                        <div class="search-nav__price-currency-item currency_type" currency_type="euro">

                                            @endif

                                            €

                                        </div>

                                        @if(isset($_GET['currency_type']) &&$_GET['currency_type'] == 'rub')

                                            <div class="search-nav__price-currency-item currency_type active" currency_type="rub">

                                                @else

                                                    <div class="search-nav__price-currency-item currency_type" currency_type="rub">

                                                        @endif

                                                        ₽

                                                    </div>

                                                    @if(isset($_GET['currency_type']) &&  $_GET['currency_type'] == 'lira')

                                                        <div class="search-nav__price-currency-item currency_type active" currency_type="lira">

                                                            @else

                                                                <div class="search-nav__price-currency-item currency_type" currency_type="lira">

                                                                    @endif

                                ₤

                            </div>

                        </div>

                    </div>

                </div>

                <div class="search__filter-item search__filter-rooms">

                    <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">

                        <div class="search-nav__rooms-dropdown-title">

                            {{__('Спальни')}}


                        </div>

                        <div class="search-nav__rooms-dropdown-bedrooms-buttons">

                            <input type="hidden" name="spalni_id" value="@if(isset($_GET['spalni_id'])){{$_GET['spalni_id']}}  @endif">

                            <?php $i = 0?>

                            @foreach($filter->where('type','Спальни') as $spalni)

                            <?php $i++ ?>

                                    <div data_id="{{$spalni->id}}" class="search-nav__rooms-dropdown-bedrooms-button @if($i == 1) active @endif " >

                             {{__($spalni->name)}}

                            </div>

                            @endforeach



                                <?php $i = 0?>

                        </div>

                    </div>

                    <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">

                        <div class="search-nav__rooms-dropdown-title">
                            {{__('Ванные')}}
                        </div>

                        <div class="search-nav__rooms-dropdown-bathrooms-buttons">

                            <input type="hidden" name="vannie_id" value="@if(isset($_GET['vannie_id'])) {{$_GET['vannie_id']}} @endif" >

                            <?php $a = 0 ?>

                            @foreach($filter->where('type','Ванные') as $vannie)

                                <?php $a++ ?>

                            <div data_id="{{$vannie->id}}" class="vannie search-nav__rooms-dropdown-bathrooms-button @if(!isset($_GET['vannie_id']) && $a == 1 || isset($_GET['vannie_id']) && $_GET['vannie_id'] == $vannie->id ) active @endif">

                                {{__($vannie->name)}}

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                <div class="search__filter-item search__filter-more">

                    <div class="more-dropdown__title">

                        {{__('Особенности')}}


                    </div>

                    <?php $i=0 ?>

                    <div class="more-dropdown__peculiarities-list">

                        @foreach($filter->where('type','Особенности') as $osobenosti)

                            <?php $i++ ?>

                        <div class="more-dropdown__peculiarities-item">

                            <label class="more-dropdown__peculiarities">



                                <input name="osobenost[{{$osobenosti->id}}]" data_id="{{$osobenosti->id}}"  class="more-dropdown__peculiarities-tv-checkbox more-dropdown__peculiarities-checkbox" type="checkbox"

                                       @if(isset($_GET['osobenost']))

                                       @foreach($_GET['osobenost'] as $key => $value)

                                       @if($key == $osobenosti->id)

                                       checked

                                        @endif

                                        @endforeach

                                        @endif

                                >

                                <div class="more-dropdown-custom-checkbox"></div>

                                <div class="more-dropdown-checkbox-text">

                                    {{__($osobenosti->name)}}

                                </div>

                            </label>

                        </div>

                            @endforeach

                    </div>

                </div>

                <div class="search__filter-item search__filter-view">

                    <div class="more-dropdown__title">

                        {{__('Вид')}}


                    </div>

                    <div class="more-dropdown__view-item">

                        <input type="hidden" name="vid_id" value="@if(isset($_GET['vid_id'])){{$_GET['vid_id']}}@endif">

                        @foreach($filter->where('type','Вид') as $vid)

                            @if(isset($_GET['vid_id'] )&& $_GET['vid_id'] == $vid->id)

                        <div data_id="{{$vid->id}}" class="vid search-nav__dropdown-button search-nav__view-button active">

                            @else

                                <div data_id="{{$vid->id}}" class="vid search-nav__dropdown-button search-nav__view-button">

                                @endif

                            {{__($vid->name)}}

                        </div>

                        @endforeach

                    </div>

                </div>

                <div class="search__filter-item search__filter-sea">

                    <div class="more-dropdown__title">

                        {{__('До моря')}}


                    </div>

                    <div class="more-dropdown__sea-item">

                        <input type="hidden" name="do_more_id" value="@if(isset($_GET['do_more_id'])){{$_GET['do_more_id']}} @endif">



                        @foreach($filter->where('type','До моря') as $do_more)

                            @if(isset($_GET['do_more_id']) && $_GET['do_more_id'] == $do_more->id)

                        <div data_id="{{$do_more->id}}" class="do_more search-nav__dropdown-button search-nav__sea-button active">

                            @else

                                <div data_id="{{$do_more->id}}" class="do_more search-nav__dropdown-button search-nav__sea-button">

                                @endif

                            {{__($do_more->name)}}

                        </div>

                        @endforeach

                    </div>

                </div>

                <div class="search__filter-item">

                    <div class="search__filter-square">

                        <div class="search__filter-square-content">

                            <div class="search__filter-square-title">

                                {{__('Площади (кв.м)')}}


                            </div>

                            <div class="search__filter-square-item">

                                <input class="search__filter-square-general" placeholder="{{__('Общая')}}" name="all_size" value="@if(isset($_GET['all_size'])){{$_GET['all_size']}}@endif">

                                <input class="search__filter-square-plot" placeholder="{{__('Дом')}}" name="home_size" value="@if(isset($_GET['home_size'])){{$_GET['home_size']}}@endif">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="search__filter-bottom form_button">

            <div class="search__filter-bottom-btn">

                {{__('Найти')}}

            </div>

        </div>

    </div>

    </form>

</div>







<script>





    $('.search-w__close').click(function () {

        $('.search-nav__list-item_b').removeClass('active');

        $('.search-nav__more-dropdown').removeClass('active');



    });





        // $('body').click(function() {

        //     $('.search-nav__list-item').removeClass('active');

        //     $('.search-nav__list-item').children().removeClass('active');

        // });





    // $(document).ready(function() {

    //

    //     let country = false;

    //     let type = false;

    //     let price = false;

    //     let spalni = false;

    //     let more = false;

    //     $('.search-nav__list-item_arrow').click(function() {

    //         alert(1);

    //         // country = !country;

    //

    //         var clickedElement = $(this);

    //         if (clickedElement.attr('data_id') == 'country' ){

    //             if(country){

    //                 country = false;

    //             }else {

    //                 country = true;

    //                 type = false;

    //                 price = false;

    //                 spalni = false;

    //                 more = false;

    //             }

    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');

    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');

    //         }

    //         if (clickedElement.attr('data_id') == 'price' ){

    //             if(price){

    //                 price = false;

    //             }else {

    //                 price = true;

    //                 type = false;

    //                 country = false;

    //                 spalni = false;

    //                 more = false;

    //             }

    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');

    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');

    //         }

    //         if (clickedElement.attr('data_id') == 'type' ){

    //             if(type){

    //                 type = false;

    //             }else {

    //                 type = true;

    //                 country = false;

    //                 price = false;

    //                 spalni = false;

    //                 more = false;

    //             }

    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');

    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');

    //         }

    //         if (clickedElement.attr('data_id') == 'spalni' ){

    //             if(spalni){

    //                 spalni = false;

    //             }else {

    //                 spalni = true;

    //                 country = false;

    //                 price = false;

    //                 type = false;

    //                 more = false;

    //             }

    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');

    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');

    //         }

    //

    //

    //         if (clickedElement.attr('data_id') == 'more' ){

    //             if(more){

    //                 more = false;

    //             }else {

    //                 more = true;

    //                 country = false;

    //                 price = false;

    //                 type = false;

    //                 spalni = false;

    //             }

    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');

    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');

    //         }

    //

    //

    //

    //

    //

    //         if (country || price || type || spalni || more){

    //             clickedElement.addClass('active');

    //             clickedElement.children('.search-nav__item-dropdown, .search-nav__types-dropdown').addClass('active');

    //         }  else {

    //

    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');

    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');

    //

    //         }

    //     });

    // });

    //open dropdown

    if(document.querySelectorAll('.dropdown').length) {



        const dropdownTitle = document.querySelectorAll('.dropdown__title')

        for(let i = 0; i < dropdownTitle.length; i++) {

            dropdownTitle[i].onclick = function(e) {

                const dropwdown = dropdownTitle[i].closest('.dropdown')

                dropwdown.classList.toggle('active')

            }

        }





        const dropdownSelector = document.querySelectorAll('.dropdown__selector')

        for(let i = 0; i < dropdownSelector.length; i++) {

            dropdownSelector[i].onclick = function(e) {

                const dropwdown = dropdownSelector[i].closest('.dropdown')

                const dropdownTitle = dropwdown.querySelector('.dropdown__title')

                dropdownTitle.innerHTML = this.innerHTML

                dropwdown.classList.toggle('active')

            }

        }

    }



    $(".search-nav__price-currency-item").each(function(index) {



        $(this).on("click", function() {

            $(".search-nav__price-currency-item").removeClass("active");

            $(this).addClass("active");

        });

    });



    <?php  if(isset($_GET['type'])){

        $type_select = $_GET['type'];

        }else{$type_select = null;} ?>

        let type =[<?php echo $type_select ?>];





        $('.type').click(function(){



            var id = $(this).attr('data_id');



            type = [];

            type.push(id)

            $(this).closest('.search-nav__types-dropdown').removeClass('active');

            $(this).closest('.search-nav__list-item').removeClass('active');



            var html = $(this).html();

            $('.type_select').html(html);

        });





        let currency_type = [];

        $('.currency_type').click(function(){



            var currency_type_value = $(this).attr('currency_type');

            currency_type = [];

            currency_type.push(currency_type_value)



        });



        $('.spalni').click(function () {



            var spalni_id = $(this).attr('data_id');

            $('input[name="spalni_id"]').val(spalni_id);

        })

        $('.vannie').click(function () {



            var vannie_id = $(this).attr('data_id');

            $('input[name="vannie_id"]').val(vannie_id);

        })

        $('.vid').click(function () {



            var vid = $(this).attr('data_id');

            $('input[name="vid_id"]').val(vid);

        });



        $('.do_more').click(function () {



            var do_more = $(this).attr('data_id');

            $('input[name="do_more_id"]').val(do_more);

        });

        $('.country').click(function () {



            var country = $(this).attr('data_id');

            $('input[name="country_id"]').val(country);

        });

        $('.city').click(function () {



            var city = $(this).attr('data_id');

            $('input[name="city_id"]').val(' ')

            $('input[name="city_id"]').val(city);

        });





        $('.form_button').click(function () {





            var hiddenInput = $('<input>').attr({

                type: 'hidden',

                name: 'type',

                value: type.join(',')

            });



            var hiddenInput2 = $('<input>').attr({

                type: 'hidden',

                name: 'currency_type',

                value: currency_type.join(',')

            });





            $('.header_search').append(hiddenInput);

            $('.header_search2').append(hiddenInput);

            $('.header_search').append(hiddenInput2);

            $('.header_search2').append(hiddenInput2);

            $(this).closest('form').submit();

        })

        $('.form_button').click(function () {





            var hiddenInput = $('<input>').attr({

                type: 'hidden',

                name: 'type',

                value: type.join(',')

            });



            var hiddenInput2 = $('<input>').attr({

                type: 'hidden',

                name: 'currency_type',

                value: currency_type.join(',')

            });





            $('.header_search').append(hiddenInput);

            $('.header_search2').append(hiddenInput);

            $('.header_search').append(hiddenInput2);

            $('.header_search2').append(hiddenInput2);

            $(this).closest('form').submit();

        })







    $(document).ready(function() {



        $(".search__filter-types-item").on("click", function() {

            // Remove existing inline style

            $(".search__filter-types-item").css({

                "background": "",

                "color": ""

            });



            // Add new style

            $(this).css({

                "background":"#508cfa",

                "color": "white"

            });

        });

    });
    $(document).ready(function() {
        $(".close-dropdown").each(function() {
            $(this).on("click", function(event) {
                event.stopPropagation();
                const searchItem = $(this).closest(".search-nav__list-item");
                const dropDown = searchItem.find('.search-nav__item-dropdown');
                searchItem.removeClass('active');
                dropDown.removeClass('active');
            });
        });
    });
</script>
