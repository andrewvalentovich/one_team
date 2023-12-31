@extends('project.includes.layouts')
@section('header')
    @include('project.includes.header')
@endsection
@section('content')
    <section class="country-map">
        <div class="country-map__content">
            <div id="map-country">
            </div>
        </div>
    </section>
    <section class="realty container">
        <div class="realty__title title">
          {{__('Недвижимость')}}
            @if(app()->getLocale() == 'ru')
                @if($country->locale_fields->where('locale.code', app()->getLocale())->first()->name == 'Турция')в Турции @endif
                @if($country->locale_fields->where('locale.code', app()->getLocale())->first()->name == 'Северный Кипр')на Северном Кипре @endif
            @else
                {{__('в')}} {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}
            @endif
        </div>
        <div class="realty__subtitle">
          {{__('Всего')}}  {{ numbers_graduation($country->product_country->count()) }}
        </div>
        @if(isset($country->cities[0]))
            <!-- 9 блоков -->
            @if(count($country->cities) >= 8)
            <div class="realty__content" style="display:flex !important">
                <div class="realty__left-col">
                    <div class="realty__left-col_1">
                        <div class="realty__item realty__item_b" >
                            <div class="realty__img_b">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">{{ $country->cities[0]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                        <div class="realty__left-col_1-footer">
                            <div class="realty__item realty__item_s">
                                <div class="realty__img_s">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}">  <img  src="{{asset("uploads/".$country->cities[1]->photo)}}" alt="antalya"></a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">{{ $country->cities[1]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                            <div class="realty__item realty__item_s">
                                <div class="realty__img_s">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}">  <img src="{{asset("uploads/".$country->cities[2]->photo)}}" alt="antalya"></a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">{{ $country->cities[2]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__left-col_2" >
                        <div class="realty__left-col_2-top" >
                            <div class="realty__item realty__item_s" >
                                <div class="realty__img_s">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}">      <img  src="{{asset('uploads/'.$country->cities[3]->photo)}}" alt="{{$country->cities[3]->name}}"></a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}" style="color: white">{{ $country->cities[3]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[3]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                            <div class="realty__item realty__item_s" >
                                <div class="realty__img_s">
                                    <a href="{{ route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}">
                                        <img src="{{asset('uploads/'.$country->cities[4]->photo)}}" alt="{{$country->cities[4]->name}}">
                                    </a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}" style="color: white">{{ $country->cities[4]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[4]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="realty__item realty__item_m" >
                            <div class="realty__img_m">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                            </div>
                            <div class="realty__img_m realty__img_mob">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}" style="color: white">{{ $country->cities[5]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}" style="color: white">      {{numbers_graduation($country->cities[5]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__right-col">
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[6]->slug])}}">    <img src="{{asset('uploads/'.$country->cities[6]->photo)}}" alt="{{$country->cities[6]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[6]->slug])}}" style="color: white">{{ $country->cities[6]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[6]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[6]->product_city->count())}}  </a>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[7]->slug])}}">  <img src="{{asset('uploads/'.$country->cities[7]->photo)}}" alt="{{$country->cities[7]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[7]->slug])}}" style="color: white">{{ $country->cities[7]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[7]->slug])}}" style="color: white">  {{numbers_graduation($country->cities[7]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug])}}">  <img  src="{{ asset('uploads/' . $country->photo ?? null) }}" alt="All-Turkey"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{ route('realty', ['categories' => $country->slug]) }}" style="color: white"> @if(stripos($country->name, " ") !== false){{ __('Весь') }}@else{{__('Вся')}}@endif {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{ route('realty', ['categories' => $country->slug]) }}" style="color: white">      {{numbers_graduation($country->product_country->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- 8 блоков -->
            @if(count($country->cities) == 7)
            <div class="realty__content">
                <div class="realty__left-col">
                    <div class="realty__left-col_1">
                        <div class="realty__item realty__item_b" >
                            <div class="realty__img_b">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">{{ $country->cities[0]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                        <div class="realty__left-col_1-footer">
                            <div class="realty__item realty__item_s">
                                <div class="realty__img_s">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}">  <img  src="{{asset("uploads/".$country->cities[1]->photo)}}" alt="antalya"></a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">{{ $country->cities[1]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                            <div class="realty__item realty__item_s">
                                <div class="realty__img_s">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}">  <img src="{{asset("uploads/".$country->cities[2]->photo)}}" alt="antalya"></a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">{{ $country->cities[2]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__left-col_2" >
                        <div class="realty__left-col_2-top" >
                            <div class="realty__item realty__item_s" >
                                <div class="realty__img_s">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}">      <img  src="{{asset('uploads/'.$country->cities[3]->photo)}}" alt="{{$country->cities[3]->name}}"></a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}" style="color: white">{{ $country->cities[3]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[3]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                            <div class="realty__item realty__item_s" >
                                <div class="realty__img_s">
                                    <a href="{{ route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}">
                                        <img src="{{asset('uploads/'.$country->cities[4]->photo)}}" alt="{{$country->cities[4]->name}}">
                                    </a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}" style="color: white">{{ $country->cities[4]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[4]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="realty__item realty__item_m" >
                            <div class="realty__img_m">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                            </div>
                            <div class="realty__img_m realty__img_mob">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}" style="color: white">{{ $country->cities[5]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}" style="color: white">      {{numbers_graduation($country->cities[5]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__right-col">
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[6]->slug])}}">    <img src="{{asset('uploads/'.$country->cities[6]->photo)}}" alt="{{$country->cities[6]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[6]->slug])}}" style="color: white">{{ $country->cities[6]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[6]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[6]->product_city->count())}}  </a>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug])}}">  <img  src="{{ asset('uploads/' . $country->photo ?? null) }}" alt="All-Turkey"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white"> @if(stripos($country->name, " ") !== false){{ __('Весь') }}@else{{__('Вся')}}@endif {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- 7 блоков -->
            @if(count($country->cities) == 6)
            <div class="realty__content">
                <div class="realty__left-col">
                    <div class="realty__left-col_1">
                        <div class="realty__item realty__item_b" >
                            <div class="realty__img_b">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">{{ $country->cities[0]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                        <div class="realty__left-col_1-footer">
                            <div class="realty__item realty__item_s">
                                <div class="realty__img_s">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}">  <img  src="{{asset("uploads/".$country->cities[1]->photo)}}" alt="antalya"></a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">{{ $country->cities[1]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                            <div class="realty__item realty__item_s">
                                <div class="realty__img_s">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}">  <img src="{{asset("uploads/".$country->cities[2]->photo)}}" alt="antalya"></a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">{{ $country->cities[2]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__left-col_2" >
                        <div class="realty__left-col_2-top" >
                            <div class="realty__item realty__item_s" >
                                <div class="realty__img_s">
                                    <a href="{{ route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}">
                                        <img src="{{asset('uploads/'.$country->cities[4]->photo)}}" alt="{{$country->cities[4]->name}}">
                                    </a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}" style="color: white">{{ $country->cities[4]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[4]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="realty__item realty__item_m" >
                            <div class="realty__img_m">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                            </div>
                            <div class="realty__img_m realty__img_mob">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}" style="color: white">{{ $country->cities[5]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[5]->slug])}}" style="color: white">      {{numbers_graduation($country->cities[5]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__right-col">
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[6]->slug])}}">    <img src="{{asset('uploads/'.$country->cities[6]->photo)}}" alt="{{$country->cities[6]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[6]->slug])}}" style="color: white">{{ $country->cities[6]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[6]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[6]->product_city->count())}}  </a>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_s">
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug])}}">  <img  src="{{ asset('uploads/' . $country->photo ?? null) }}" alt="All-Turkey"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white"> @if(stripos($country->name, " ") !== false){{ __('Весь') }}@else{{__('Вся')}}@endif {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- 6 блоков -->
            @if(count($country->cities) == 5)
            <div class="realty__content">
                <div class="realty__left-col">
                    <div class="realty__left-col_1">
                        <div class="realty__item realty__item_b" >
                            <div class="realty__img_b" style="padding-bottom: 65%">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}"><img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">{{ $country->cities[0]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                        <div class="realty__left-col_1-footer">
                            <div class="realty__item realty__item_s">
                                <div class="realty__img_s">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}">  <img  src="{{asset("uploads/".$country->cities[1]->photo)}}" alt="antalya"></a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">{{ $country->cities[1]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__left-col_2" >
                        <div class="realty__left-col_2-top" >
                            <div class="realty__item realty__item_s" >
                                <div class="realty__img_s">
                                    <a href="{{ route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}">
                                        <img src="{{asset('uploads/'.$country->cities[2]->photo)}}" alt="{{$country->cities[2]->name}}">
                                    </a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">{{ $country->cities[2]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="realty__item realty__item_m" >
                            <div class="realty__img_m">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[3]->photo)}}" alt="{{$country->cities[3]->name}}"> </a>
                            </div>
                            <div class="realty__img_m realty__img_mob">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[3]->photo)}}" alt="{{$country->cities[3]->name}}"> </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}" style="color: white">{{ $country->cities[3]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}" style="color: white">      {{numbers_graduation($country->cities[3]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__right-col">
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}">    <img src="{{asset('uploads/'.$country->cities[4]->photo)}}" alt="{{$country->cities[4]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}" style="color: white">      {{ $country->cities[4]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[4]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[4]->product_city->count())}}  </a>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug])}}">  <img  src="{{ asset('uploads/' . $country->photo ?? null) }}" alt="All-Turkey"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white"> @if(stripos($country->name, " ") !== false){{ __('Весь') }}@else{{__('Вся')}}@endif {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- 5 блоков -->
            @if(count($country->cities) == 4)
            <div class="realty__content">
                <div class="realty__left-col">
                    <div class="realty__left-col_1">
                        <div class="realty__item realty__item_b" >
                            <div class="realty__img_b">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">{{ $country->cities[0]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__left-col_2" >
                        <div class="realty__left-col_2-top" >
                            <div class="realty__item realty__item_s" >
                                <div class="realty__img_s">
                                    <a href="{{ route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}">
                                        <img src="{{asset('uploads/'.$country->cities[1]->photo)}}" alt="{{$country->cities[1]->name}}">
                                    </a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">{{ $country->cities[1]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="realty__item realty__item_m" >
                            <div class="realty__img_m">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[2]->photo)}}" alt="{{$country->cities[2]->name}}"> </a>
                            </div>
                            <div class="realty__img_m realty__img_mob">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[2]->photo)}}" alt="{{$country->cities[2]->name}}"> </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">{{ $country->cities[2]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">      {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__right-col">
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}">    <img src="{{asset('uploads/'.$country->cities[3]->photo)}}" alt="{{$country->cities[3]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}" style="color: white">{{ $country->cities[3]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[3]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[3]->product_city->count())}}  </a>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug])}}">  <img  src="{{ asset('uploads/' . $country->photo ?? null) }}" alt="All-Turkey"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white"> @if(stripos($country->name, " ") !== false){{ __('Весь') }}@else{{__('Вся')}}@endif {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- 4 блоков -->
            @if(count($country->cities) == 3)
            <div class="realty__content">
                <div class="realty__left-col">
                    <div class="realty__left-col_1">
                        <div class="realty__item realty__item_b" >
                            <div class="realty__img_b">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">{{ $country->cities[0]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__left-col_2" >
                        <div class="realty__left-col_2-top" >
                            <div class="realty__item realty__item_s" >
                                <div class="realty__img_s">
                                    <a href="{{ route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}">
                                        <img src="{{asset('uploads/'.$country->cities[1]->photo)}}" alt="{{$country->cities[1]->name}}">
                                    </a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">{{ $country->cities[1]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="realty__item realty__item_m" >
                            <div class="realty__img_m">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[2]->photo)}}" alt="{{$country->cities[2]->name}}"> </a>
                            </div>
                            <div class="realty__img_m realty__img_mob">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}">     <img src="{{asset('uploads/'.$country->cities[2]->photo)}}" alt="{{$country->cities[2]->name}}"> </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">{{ $country->cities[2]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[2]->slug])}}" style="color: white">      {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__right-col">
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug])}}"><img src="{{ asset('uploads/' . $country->photo ?? null) }}" alt="All-Turkey"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white">@if(stripos($country->name, " ") !== false){{ __('Весь') }}@else{{__('Вся')}}@endif {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white"> {{numbers_graduation($country->product_country->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- 3 блоков -->
            @if(count($country->cities) == 2)
            <div class="realty__content">
                <div class="realty__left-col">
                    <div class="realty__left-col_1">
                        <div class="realty__item realty__item_b" >
                            <div class="realty__img_b">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">{{ $country->cities[0]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__left-col_2" >
                        <div class="realty__left-col_2-top" >
                            <div class="realty__item realty__item_s" >
                                <div class="realty__img_s">
                                    <a href="{{ route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}">
                                        <img src="{{asset('uploads/'.$country->cities[1]->photo)}}" alt="{{$country->cities[1]->name}}">
                                    </a>
                                </div>
                                <div class="realty__item-text">
                                    <div class="realty__item-text-title">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">{{ $country->cities[1]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                    </div>
                                    <div class="realty__item-text-subtitle">
                                        <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[1]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__right-col">
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug])}}">  <img  src="{{ asset('uploads/' . $country->photo ?? null) }}" alt="All-Turkey"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white"> @if(stripos($country->name, " ") !== false){{ __('Весь') }}@else{{__('Вся')}}@endif {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- 2 блоков -->
            @if(count($country->cities) == 1)
            <div class="realty__content">
                <div class="realty__left-col" style="flex: 1 0 calc(50% - 10px)">
                    <div class="realty__left-col_1">
                        <div class="realty__item realty__item_b" >
                            <div class="realty__img_b">
                                <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">{{ $country->cities[0]->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug . '/' . $country->cities[0]->slug])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__right-col" style="flex: 1 0 calc(50% - 10px)">
                    <div class="realty__item realty__item_s" >
                        <div class="realty__img_s">
                            <a href="{{route('realty', ['categories' => $country->slug])}}">  <img  src="{{ asset('uploads/' . $country->photo ?? null) }}" alt="All-Turkey"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white"> @if(stripos($country->name, " ") !== false){{ __('Весь') }}@else{{__('Вся')}}@endif {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @else
            <!-- 1 блоков -->
            @if(count($country->cities) < 1)
            <div class="realty__content">
                <div class="realty__left-col">
                    <div class="realty__left-col_1">
                        <div class="realty__item realty__item_b" >
                            <div class="realty__img_b">
                                <a href="{{route('realty', ['categories' => $country->slug])}}">  <img  src="{{ asset('uploads/' . $country->photo ?? null) }}" alt="All-Turkey"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white">@if(stripos($country->name, " ") !== false){{ __('Весь') }}@else{{__('Вся')}}@endif {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}</a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('realty', ['categories' => $country->slug])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endif
    </section>
    <div class="catalog-w catalog-w_lite">
        <section class="catalog">
            <div class="catalog__content">
                <div class="catalog__text-w">
                    <div class="catalog__text-bg">

                    </div>
                    <div class="catalog__text">
                        <div class="catalog__text-body">
                            <a href="{{route('home_page')}}" class="catalog__logo">
                                <img src="{{asset('project/img/svg/new_logo.svg')}}" alt="logo">
                            </a>
                            <p class="catalog__title">
                                {{ __('Каталог строящихся проектов на побережье средиземного моря') }}
                            </p>
                            <p class="catalog__subtitle">
                                {{ __('Работаем без комиссии для покупателя по ценам напрямую от застройщика') }}
                            </p>
                            <img class="catalog__pic" src="{{asset('project/img/catalog-index.webp')}}" alt="">
                            <div class="catalog__pdf">
                                <svg width="49" height="59" viewBox="0 0 49 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8967 37.9589C11.8967 36.979 11.2168 36.3947 10.0172 36.3947C9.52737 36.3947 9.19562 36.4431 9.02209 36.4893L9.02209 39.633C9.22756 39.6793 9.48013 39.6947 9.82828 39.6947C11.1069 39.6947 11.8967 39.0487 11.8967 37.9589Z" fill="white"/>
                                    <path d="M19.3227 36.4276C18.7855 36.4276 18.4384 36.474 18.233 36.5221L18.233 43.4845C18.4385 43.5328 18.7702 43.5328 19.0702 43.5328C21.2495 43.5482 22.6708 42.3486 22.6708 39.8067C22.6862 37.5963 21.3911 36.4276 19.3227 36.4276Z" fill="white"/>
                                    <path d="M33.1201 2.1935e-07L9.42321 6.24088e-08C5.96132 3.94811e-08 3.14372 2.81956 3.14372 6.27949L3.14372 29.4999L2.53039 29.4999C1.13316 29.4999 -2.02872e-07 30.632 -2.12134e-07 32.0305L-3.13768e-07 47.3763C-3.23029e-07 48.7747 1.13304 49.9066 2.53039 49.9066L3.14372 49.9066L3.14372 52.7205C3.14372 56.1842 5.96132 59 9.4232 59L41.7565 59C45.2162 59 48.0342 56.1841 48.0342 52.7205L48.0342 14.8619L33.1201 2.1935e-07ZM6.63828 34.7998C7.37985 34.6745 8.42221 34.5801 9.89079 34.5801C11.3749 34.5801 12.4327 34.8634 13.1434 35.4324C13.8223 35.9686 14.2805 36.8537 14.2805 37.8953C14.2805 38.9367 13.9333 39.8221 13.3016 40.4218C12.48 41.1952 11.265 41.5424 9.84367 41.5424C9.52734 41.5424 9.24381 41.5267 9.02207 41.496L9.02207 45.3013L6.63828 45.3013L6.63828 34.7998ZM41.7565 55.1544L9.42321 55.1544C8.08275 55.1544 6.9912 54.0628 6.9912 52.7205L6.9912 49.9066L37.1325 49.9066C38.53 49.9066 39.663 48.7747 39.663 47.3763L39.663 32.0305C39.663 30.632 38.53 29.4999 37.1325 29.4999L6.9912 29.4999L6.9912 6.27949C6.9912 4.94099 8.08287 3.84944 9.42321 3.84944L31.6813 3.82619L31.6813 12.0536C31.6813 14.4567 33.6312 16.4084 36.0362 16.4084L44.0958 16.3853L44.1865 52.7204C44.1865 54.0628 43.0969 55.1544 41.7565 55.1544ZM15.8176 45.253L15.8176 34.7998C16.7017 34.6591 17.8541 34.5801 19.0702 34.5801C21.0913 34.5801 22.4019 34.9426 23.4289 35.7159C24.534 36.5375 25.2282 37.8471 25.2282 39.7274C25.2282 41.764 24.4866 43.17 23.4596 44.0378C22.339 44.9693 20.6333 45.411 18.5494 45.411C17.3015 45.411 16.4173 45.332 15.8176 45.253ZM33.0508 39.0641L33.0508 41.0216L29.2291 41.0216L29.2291 45.3013L26.8135 45.3013L26.8135 34.6591L33.3188 34.6591L33.3188 36.632L29.2291 36.632L29.2291 39.0641L33.0508 39.0641Z" fill="white"/>
                                </svg>
                            </div>
                        </div>
                        <div class="catalog__text-footer">
                            {{ __('Все актуальные предложения от застройщиков') }}
                        </div>
                    </div>
                </div>
                <div class="catalog__info">
                    <p class="catalog__info-title">
                        {{ __('Получить каталог, если нет времени на поиски') }}
                    </p>
                    <p class="catalog__info-subtitle">
                        {{ __('Вы получите') }}:
                    </p>
                    <ul class="catalog__info-list">
                        <li>
                            <div class="catalog__info-circle">
                                1
                            </div>
                            <p>
                                {{ __('Проекты от') }} <span>{{ __('надежных застройщиков') }}</span>
                            </p>
                        </li>
                        <li>
                            <div class="catalog__info-circle">
                                2
                            </div>
                            <p>
                                {{ __('Цены и сроки сдачи') }} <span>{{ __('жилищных комплексов') }}</span>
                            </p>
                        </li>
                        <li>
                            <div class="catalog__info-circle">
                                3
                            </div>
                            <p>
                                <span>{{ __('Площади и планировки') }}</span>
                            </p>
                        </li>
                        <li>
                            <div class="catalog__info-circle">
                                4
                            </div>
                            <p>
                                <span>{{ __('Инфраструктура и месторасположение') }}</span>
                            </p>
                        </li>
                    </ul>
                    <button class="catalog__btn-get btn_white" popup-name="main-form-popup" reachgoal="catalog">
                        {{ __('Получить каталог') }}
                    </button>
                </div>
            </div>
        </section>
    </div>
        <!-- @if(!is_null($country->locale_fields->where('locale.code', app()->getLocale())->first()))
            {!! $country->locale_fields->where('locale.code', app()->getLocale())->first()->div !!}
        @endif -->
<section class="citizenship container">
    <div class="citizenship__title title">Гражданство</div>
    <div class="citizenship__subtitle">Мы предлагаем готовые стратегии инвестирования в зарубежную недвижимость</div>
    <div class="citizenship__content">
        <div class="citizenship__content-items">
            <div class="citizenship__content-item">
                <div class="citizenship__item-img citizenship__item-dollar">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="79px" height="51px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 2.93 1.89" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Слой_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                        <polygon class="fil0 str0" points="2.3,0.63 2.3,1.82 0.07,1.82 0.07,0.63 "></polygon>
                        <polyline class="fil0 str1" points="0.3,0.41 2.53,0.41 2.53,1.52 "></polyline>
                        <polyline class="fil0 str1" points="0.48,0.22 2.71,0.22 2.71,1.34 "></polyline>
                        <polyline class="fil0 str1" points="0.67,0.04 2.9,0.04 2.9,1.15 "></polyline>
                        <g id="_2529166579488">
                        <path class="fil0 str2" d="M1.01 1.35l0 0.1 0.25 0c0.07,0 0.13,-0.05 0.13,-0.11 0,-0.06 -0.06,-0.11 -0.13,-0.11l-0.14 0c-0.08,0 -0.14,-0.05 -0.14,-0.12 0,-0.06 0.06,-0.11 0.14,-0.11l0.25 0 0 0.1"></path>
                        <line class="fil0 str2" x1="1.2" y1="1" x2="1.2" y2="0.82"></line>
                        <line class="fil0 str2" x1="1.2" y1="1.63" x2="1.2" y2="1.45"></line>
                        </g>
                        </g>
                    </svg>
                </div>
                <div class="citizenship__item-text">
                    <div class="citizenship__item-title">400 000$</div>
                    <div class="citizenship__item-subtitle">Минимальные инвестиции</div>
                </div>
            </div>
            <div class="citizenship__content-item">
                <div class="citizenship__item-img citizenship__item-limitation">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="74px" height="58px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 2.96 2.32" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Слой_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                        <polygon class="fil0 str0" points="2.48,0.64 2.48,2.24 0.08,2.24 0.08,0.64 "></polygon>
                        <polyline class="fil0 str1" points="0.32,0.4 2.72,0.4 2.72,2 "></polyline>
                        <path class="fil0 str1" d="M1.84 0.84l0 -0.84m-1.12 0.84l0 -0.84"></path>
                        <line class="fil0 str1" x1="2" y1="1.19" x2="0.56" y2="1.19"></line>
                        <line class="fil0 str1" x1="0.72" y1="1.43" x2="0.56" y2="1.43"></line>
                        <line class="fil0 str1" x1="1.04" y1="1.43" x2="0.88" y2="1.43"></line>
                        <line class="fil0 str1" x1="1.36" y1="1.43" x2="1.2" y2="1.43"></line>
                        <line class="fil0 str1" x1="1.68" y1="1.43" x2="1.52" y2="1.43"></line>
                        <line class="fil0 str1" x1="2" y1="1.43" x2="1.84" y2="1.43"></line>
                        <line class="fil0 str1" x1="0.72" y1="1.63" x2="0.56" y2="1.63"></line>
                        <line class="fil0 str1" x1="1.04" y1="1.63" x2="0.88" y2="1.63"></line>
                        <line class="fil0 str1" x1="1.36" y1="1.63" x2="1.2" y2="1.63"></line>
                        <line class="fil0 str1" x1="1.68" y1="1.63" x2="1.52" y2="1.63"></line>
                        <line class="fil0 str1" x1="2" y1="1.63" x2="1.84" y2="1.63"></line>
                        <line class="fil0 str1" x1="0.72" y1="1.83" x2="0.56" y2="1.83"></line>
                        <line class="fil0 str1" x1="1.04" y1="1.83" x2="0.88" y2="1.83"></line>
                        <line class="fil0 str1" x1="1.36" y1="1.83" x2="1.2" y2="1.83"></line>
                        <line class="fil0 str1" x1="1.68" y1="1.83" x2="1.52" y2="1.83"></line>
                        <line class="fil0 str1" x1="2" y1="1.83" x2="1.84" y2="1.83"></line>
                        <polyline class="fil0 str1" points="0.52,0.2 2.92,0.2 2.92,1.8 "></polyline>
                        </g>
                    </svg>
                </div>
                <div class="citizenship__item-text">
                    <div class="citizenship__item-title">3-6 мес.</div>
                    <div class="citizenship__item-subtitle">Срок оформления</div>
                </div>
            </div>
            <div class="citizenship__content-item">
                <div class="citizenship__item-img citizenship__item-return">
                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="79px" height="59px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 4.79 3.61" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Слой_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                        <g id="_1267802140304">
                        <path class="fil0 str0" d="M1.7 2.21l0 0.16 0.41 0c0.12,0 0.22,-0.08 0.22,-0.18 0,-0.1 -0.1,-0.19 -0.22,-0.19l-0.24 0c-0.11,0 -0.21,-0.08 -0.21,-0.18 0,-0.1 0.1,-0.18 0.21,-0.18l0.42 0 0 0.16"></path>
                        <line class="fil0 str0" x1="2.02" y1="1.64" x2="2.02" y2="1.34"></line>
                        <line class="fil0 str0" x1="2.02" y1="2.67" x2="2.02" y2="2.37"></line>
                        </g>
                        <line class="fil0 str1" x1="0.17" y1="1.03" x2="3.82" y2="1.03"></line>
                        <polyline class="fil0 str1" points="0.72,0.49 0.17,1.03 0.72,1.58 "></polyline>
                        <line class="fil0 str1" x1="3.82" y1="2.98" x2="0.17" y2="2.98"></line>
                        <polyline class="fil0 str1" points="3.27,3.52 3.82,2.98 3.27,2.43 "></polyline>
                        <polyline class="fil0 str2" points="0.96,0.67 4.12,0.67 4.12,2.49 "></polyline>
                        <polyline class="fil0 str2" points="0.9,0.36 4.42,0.36 4.42,2.19 "></polyline>
                        <polyline class="fil0 str2" points="1.08,0.06 4.73,0.06 4.73,1.88 "></polyline>
                        </g>
                    </svg>
                </div>
                <div class="citizenship__item-text">
                    <div class="citizenship__item-title">3 года</div>
                    <div class="citizenship__item-subtitle">Срок возврата инвестиций</div>
                </div>
            </div>
        </div>
    </div>
    <div class="citizenship__footer">
        <a href="{{route('residence_and_citizenship')}}" class="citizenship__btn citizenship__btn-pink btn_blue">
            Узнать больше
        </a>
    </div>
</section>
    <script src="{{ asset('project/js/url_functions.js') }}"></script>
    <script>
        searchBarGetParameters();
    </script>

    @include('project.includes.objects-carousel', ['title' => $citizenship_for_invesment, 'products' => $citizenship_product, 'get_footer_link' => $get_footer_link])
    @include('project.includes.modal-object')

@endsection
@section('footer')
    @include('project.includes.footer')
@endsection
@section('scripts')
    <script>
        // Валюта
        var currency = {
            "eur": `&nbsp;€`,
            "usd": `&nbsp;$`,
            "gbp": `&nbsp;₤`,
            "try": `&nbsp;<span class="lira">₺</span>`,
            "rub": `&nbsp;₽`
        }
        var square_m = {
            "en": `sq.m`,
            "de": `qm`,
            "tr": `metrekare`,
            "ru": `кв.м`
        }
        var current_locale = `{{ app()->getLocale() }}`;

        // $(".place__currency-item").on("click", function() {
        //     var rate = $(this).attr('data-exchange');
        //     var place_price_el = $('.place-w.active').find('.place__price-value');
        //     var place_square_el = $('.place-w.active').find('.place__square');
        //     var kompleks_layout_price_el = $('.place-w.active').find('.kompleks__layout-price');
        //     kompleks_layout_price_el.children('span').removeClass('active');
        //     kompleks_layout_price_el.find(`span[data-exchange="${rate}"]`).addClass('active');
        //     kompleks_layout_price_el.find(`span[data-exchange="${rate}"]`).addClass('lira');

        //     var kompleks_layout_price_meter_el = $('.place-w.active').find('.kompleks__layout-price-meter');
        //     kompleks_layout_price_meter_el.children('span').removeClass('active');
        //     kompleks_layout_price_meter_el.find(`span[data-exchange="${rate}"]`).addClass('active');


        //     place_price_el.html(place_price_el.attr('data-price-'+rate) + currency[rate]);
        //     place_square_el.html(place_square_el.attr('data-price-'+rate) + currency[rate]);
        //     // kompleks_layout_price_el.html(kompleks_layout_price_el.attr('data-price-'+rate) + currency[rate]);
        //     // kompleks_layout_price_meter_el.html(kompleks_layout_price_meter_el.attr('data-price-'+rate) + currency[rate] + " / " + square_m[current_locale]);
        // });




        // let locations = [

        // ];




        let obect =  "<?php echo __('объектов')?>";




        (async() => {

            "use strict";


            function e(e) {

                for (let t = 0; t < e.length; t++) e[t].classList.remove("active");

                e = 0

            }

            window.addEventListener("resize", (function(e) {

            })), document.querySelectorAll(".place-w").length && window.innerWidth <= 540 && window.addEventListener("resize", (function(e) {

                document.querySelectorAll("#map_city").length && (window.innerWidth > 1003 && document.querySelector(".city__content").classList.remove("city_map"), window.innerWidth <= 1003 && (document.querySelector("#map_city").style.height = "100%"), window.innerWidth > 1003 && (document.querySelector(".city-col").classList.add("active"), document.querySelector(".map_city__btn-changer").classList.remove("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")), window.innerWidth > 1199 && (document.querySelector("#map_city").style.height = window.innerHeight - 18 - 161 + "px"), window.innerWidth <= 1199 && window.innerWidth > 1003 && (document.querySelector("#map_city").style.height = window.innerHeight - 88 - 60 + "px"))

            })), document.querySelector(".header__top-phone-menu").onclick = function() {

                document.querySelector(".header-m").classList.toggle("active"), document.querySelector("#nav-icon").classList.toggle("open"), document.querySelector(".header-w").classList.add("fixed"), document.querySelector(".header-m").classList.contains("active") || document.querySelector(".place-w").classList.contains("active") || document.querySelector(".header-w").classList.remove("fixed")

            }

            let t = document.querySelectorAll(".header-m__langs-item");

            for (let o = 0; o < t.length; o++) t[o].addEventListener("click", (function(c) {

                e(t), t[o].classList.add("active")

            }));

            let o = document.querySelectorAll(".index-map__button");

            for (let t = 0; t < o.length; t++) o[t].addEventListener("click", (function(c) {

                e(o), o[t].classList.add("active")

            }));

            let c, l = document.querySelectorAll(".contact__top-item");

            for (let t = 0; t < l.length; t++) l[t].addEventListener("click", (function(o) {

                e(l), l[t].classList.add("active")

            }));

            document.querySelectorAll(".contact__form-phone-country").length && (document.querySelector(".contact__form-phone-country").onclick = function() {

                this.classList.toggle("active"), document.querySelector(".contact__phone-dropdown").classList.toggle("active")

            })

            const swiperObject = new Swiper(".objects__swiper", {
                slidesPerView: 4,
                spaceBetween: 20,
                pagination: {
                    el: ".objects__pagination",
                    clickable: !0,
                },
                navigation: {
                    nextEl: ".objects__next",
                    prevEl: ".objects__prev"
                },
                on: {
                    init: function () {
                        // swiperObject.update()
                    },
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    900: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    1199: {
                        slidesPerView: 4,
                        spaceBetween: 20
                    }
                }

            })

            document.querySelectorAll(".search-nav__rooms-title").length && (document.querySelector(".search-nav__rooms-title").onclick = function() {

            document.querySelector(".search-nav__rooms").classList.toggle("active"), document.querySelector(".search-nav__rooms-dropdown").classList.toggle("active")

            }), document.querySelectorAll(".search-nav__more-title").length && (document.querySelector(".search-nav__more-title").onclick = function() {

                window.innerWidth > 899 && (document.querySelector(".search-nav__more").classList.toggle("active"), document.querySelector(".search-nav__more-dropdown").classList.toggle("active")), window.innerWidth <= 899 && document.querySelector(".search-w").classList.toggle("active")

            }), document.querySelectorAll(".search-w__close").length && (document.querySelector(".search-w__close").onclick = function() {

                window.innerWidth <= 899 && document.querySelector(".search-w").classList.remove("active")

            });

            let n = document.querySelectorAll(".search-nav__rooms-dropdown-bedrooms-button");

            for (let t = 0; t < n.length; t++) n[t].addEventListener("click", (function(o) {

                e(n), n[t].classList.add("active")

            }));

            let i = document.querySelectorAll(".search-nav__rooms-dropdown-bathrooms-button");

            for (let t = 0; t < i.length; t++) i[t].addEventListener("click", (function(o) {

                e(i), i[t].classList.add("active")

            }));

            let a = document.querySelectorAll(".search-nav__view-button");

            for (let t = 0; t < a.length; t++) a[t].addEventListener("click", (function(o) {

                e(a), a[t].classList.add("active")

            }));

            let s = document.querySelectorAll(".search-nav__sea-button");

            for (let t = 0; t < s.length; t++) s[t].addEventListener("click", (function(o) {

                e(s), s[t].classList.add("active")

            }));

            document.querySelectorAll(".search-nav__types-title").length && (document.querySelector(".search-nav__types-title").onclick = function() {

                document.querySelector(".search-nav__types").classList.toggle("active"), document.querySelector(".search-nav__types-dropdown").classList.toggle("active")

            }), document.querySelectorAll(".search-nav__price-title").length && (document.querySelector(".search-nav__price-title").onclick = function() {

                document.querySelector(".search-nav__price").classList.toggle("active"), document.querySelector(".search-nav__price-dropdown").classList.toggle("active")

            });

            let r = document.querySelectorAll(".search-nav__price-currency-item");

            // for (let t = 0; t < s.length; t++) r[t].addEventListener("click", (function(o) {

            //     e(r), r[t].classList.add("active")

            // }));

            let d = document.querySelectorAll(".search-nav__list-item-title"),

                u = document.querySelectorAll(".search-nav__item-dropdown");



            function m() {

                for (let e = 0; e < u.length - 1; e++) u[e].style.zIndex = 5

            }

            for (let e = 0; e < d.length - 1; e++) d[e].addEventListener("click", (function(t) {

                m(), u[e].style.zIndex = 6

            }));

            document.querySelectorAll(".search-nav__price-title").length && (document.querySelector(".search-nav__price-title").onclick = function() {

                document.querySelector(".search-nav__price").classList.toggle("active"), document.querySelector(".search-nav__price-dropdown").classList.toggle("active")

            }), document.querySelector(".city-col__filter") && (document.querySelector(".city-col__filter").onclick = function() {

                this.classList.toggle("active"), document.querySelector(".city-col__filter-list").classList.toggle("active")

            }), document.querySelector(".favorites__top-filter") && (document.querySelector(".favorites__top-filter").onclick = function() {

                this.classList.toggle("active"), document.querySelector(".favorites__top-filter-list").classList.toggle("active")

            }), document.querySelector(".place__btns-call-preview") && (document.querySelector(".place__btns-call-preview").onclick = function() {

                document.querySelector(".place__btns-call-list").classList.toggle("active")

            }), document.querySelector(".place__btns-call-preview") && (document.querySelector(".place-w").onscroll = function() {

                window.innerWidth < 640 && (document.querySelector(".place-w").scrollTop > 620 ? document.querySelector(".place__btns").style.position = "fixed" : document.querySelector(".place__btns").style.position = "static")

            }, window.addEventListener("resize", (function(e) {

                window.innerWidth >= 640 && (document.querySelector(".place__btns").style.position = "static")

            })));

            let _ = document.querySelectorAll(".favorites__list-item"),

                y = document.querySelectorAll(".favorites__item-exit");

            for (let e = 0; e < y.length; e++) y[e].addEventListener("click", (function(t) {

                _[e].style.display = "none"

            }));

            let v = document.querySelectorAll(".favorites__pages-item");

            for (let t = 0; t < v.length; t++) v[t].addEventListener("click", (function(o) {

                e(v), v[t].classList.add("active")

            }));

            let p = document.querySelectorAll(".city-col__btn");

            for (let t = 0; t < p.length; t++) p[t].addEventListener("click", (function(o) {

                e(p), p[t].classList.add("active")

            }));

            let h = document.querySelectorAll(".favorite-item-btn");

            for (let e = 0; e < h.length; e++) h[e].addEventListener("click", (function(t) {

                h[e].classList.toggle("active")

            }));

            let f = document.querySelectorAll(".objects__slide-favorites");

            for (let e = 0; e < f.length; e++) f[e].addEventListener("click", (function(t) {

                f[e].classList.toggle("active")

            }));

            let w = document.querySelectorAll(".city-col__bottom-number");

            for (let t = 0; t < w.length; t++) w[t].addEventListener("click", (function(o) {

                e(w), w[t].classList.add("active")

            }));

            document.querySelector(".city-col__btn-changer") && (document.querySelector(".city-col__btn-changer").onclick = function() {

                C.destroy(), P(1 / 0), C.container.fitToViewport(), this.classList.remove("active"), document.querySelector(".city-col").classList.remove("active"), document.querySelector(".map_city__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.add("map_city_active"), document.querySelector(".city__content").classList.add("city_map")

            }), document.querySelector(".map_city__btn-changer") && (document.querySelector(".map_city__btn-changer").onclick = function() {

                this.classList.remove("active"), document.querySelector(".city-col").classList.add("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")

            }), document.querySelectorAll(".place__currency-preview").length && (document.querySelector(".place__currency-preview").onclick = function() {

                document.querySelector(".place__currency").classList.toggle("active")

            }), window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed"), window.addEventListener("resize", (function(e) {

                window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed"), window.innerWidth <= 1003 && document.querySelectorAll(".city").length && document.body.classList.remove("scroll_fixed")

            }));

            let g = document.querySelectorAll(".city-col__item"),

                b = document.querySelector(".place-w");

            for (let e = 0; e < g.length; e++) g[e].addEventListener("click", (function(e) {

                e.target.classList.contains("favorite-item-btn") || (document.body.classList.add("scroll_fixed"), document.querySelector(".header-w").classList.add("fixed"), b.classList.add("active"))

            }));

            document.querySelectorAll(".place__exit").length && (document.querySelector(".place__exit").onclick = function() {

                document.querySelector(".place-w").classList.remove("active"), document.body.classList.remove("scroll_fixed"), document.querySelector(".header-w").classList.remove("fixed")

            }),
             new Swiper(".place__swiper", {

                slidesPerView: 2,

                spaceBetween: 4,

                navigation: {

                    nextEl: ".place__next",

                    prevEl: ".place__prev"

                },

                pagination: {

                    el: ".place__pagination",

                    type: "custom",

                    renderCustom: function(e, t, o) {

                        return t + " из " + o

                    }

                },

                breakpoints: {

                    0: {

                        slidesPerView: 1

                    },

                    540: {

                        slidesPerView: 2

                    }

                }

            }), new Swiper(".scheme__swiper", {

                slidesPerView: 1,

                navigation: {

                    nextEl: ".scheme__next",

                    prevEl: ".scheme__prev"

                },

                breakpoints: {

                    0: {

                        slidesPerView: 1

                    },

                    540: {

                        slidesPerView: 2

                    },

                    767: {

                        slidesPerView: 1

                    }

                }

            });

            let S = document.querySelectorAll(".place__collage-item_clickable"),

                L = document.querySelectorAll(".place__slide_clickable"),

                q = document.querySelector(".place__slider_p"),

                k = document.querySelector(".place__slider_p-exit"),

                x = document.querySelector(".place-popup-collage"),

                A = document.querySelector(".place-popup-collage__exit");

            if (S.length)

                for (let e = 0; e < S.length; e++) S[e].addEventListener("click", (function(t) {
                     q.classList.add("active")
                }));

            if (L.length)

                for (let e = 0; e < L.length; e++) L[e].addEventListener("click", (function(e) {

                    x.classList.add("active")

                }));

            var C, E;





            function P(e) {

                document.querySelectorAll("#map_city").length && ymaps.ready((function() {

                    C = new ymaps.Map("map_city", {

                        center: [{{ $country->lat .','.$country->long }}],

                        zoom: 6,

                        controls: [],

                        behaviors: ["default", "scrollZoom"]

                    }, {

                        searchControlProvider: "yandex#search"

                    });

                    var t = ymaps.templateLayoutFactory.createClass('<div class="popover top"><a class="close" href="#">&times;</a><div class="arrow"></div><div class="popover-inner">$[[options.contentLayout observeSize minWidth=235 maxWidth=235 maxHeight=350]]</div></div>', {

                            build: function() {

                                this.constructor.superclass.build.call(this), this._$element = $(".popover", this.getParentElement()), this.applyElementOffset(), this._$element.find(".close").on("click", $.proxy(this.onCloseClick, this))

                            },

                            clear: function() {

                                this._$element.find(".close").off("click"), this.constructor.superclass.clear.call(this)

                            },

                            onSublayoutSizeChange: function() {

                                t.superclass.onSublayoutSizeChange.apply(this, arguments), this._isElement(this._$element) && (this.applyElementOffset(), this.events.fire("shapechange"))

                            },

                            applyElementOffset: function() {

                                this._$element.css({

                                    left: -this._$element[0].offsetWidth / 2,

                                    top: -(this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight)

                                })

                            },

                            onCloseClick: function(e) {

                                e.preventDefault(), this.events.fire("userclose")

                            },

                            getShape: function() {

                                if (!this._isElement(this._$element)) return t.superclass.getShape.call(this);

                                var e = this._$element.position();

                                return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([

                                    [e.left, e.top],

                                    [e.left + this._$element[0].offsetWidth, e.top + this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight]

                                ]))

                            },

                            _isElement: function(e) {

                                return e && e[0] && e.find(".arrow")[0]

                            }

                        }),

                        o = ymaps.templateLayoutFactory.createClass('<div class="placemark"></div>', {

                            build: function() {

                                o.superclass.build.call(this);

                                var e = this.getParentElement().getElementsByClassName("placemark")[0],

                                    t = this.isActive ? 60 : 34,

                                    c = {

                                        type: "Circle",

                                        coordinates: [0, 0],

                                        radius: t / 2

                                    },

                                    l = {

                                        type: "Circle",

                                        coordinates: [0, -30],

                                        radius: t / 2

                                    };

                                this.getData().options.set("shape", this.isActive ? l : c), document.addEventListener("click", (function(e) {

                                    if ((e.target.classList.contains("ymaps-2-1-79-balloon__close-button") || e.target.classList.contains("ymaps-2-1-79-user-selection-none")) && window.innerWidth <= 1003) {

                                        var t = document.querySelectorAll(".placemark");

                                        for (let e = 0; e < t.length; e++) t[e].classList.remove("active")

                                    }

                                })), this.inited || (this.inited = !0, this.isActive = !1, this.getData().geoObject.events.add("click", (function(t) {

                                    var o = document.querySelectorAll(".placemark");

                                    if (e.classList.contains("active")) e.classList.remove("active");

                                    else {

                                        for (let e = 0; e < o.length; e++) o[e].classList.remove("active");

                                        e.classList.add("active")

                                    }

                                }), this))

                            }

                        }),

                        c = ymaps.templateLayoutFactory.createClass('<div class="ballon-city__content">$[properties.balloonContent]</div>'),

                        l = window.myPlacemark = new ymaps.Placemark([40.93824, 29.26059], {

                            balloonContent: ['<div class="balloon-city"><div class="balloon-city__text"><div class="balloon-city__price">$250 000</div><div class="balloon-city__rooms">2 спал, 1 ван</div><div class="balloon-city__rooms_m">2 010 кв.м  <span>|</span>  2 спальни  <span>|</span>  1 ванна</div><div class="balloon-city__address">Balbey, 431. Sk. No:4, 07040 Muratpaşa</div><div class="balloon-city__square">1 250 кв.м</div></div><div class="balloon-city__img"> <img src="./img/favorites-2.png"></div></div>'].join("")

                        }, {

                            balloonPanelMaxMapArea: e,

                            balloonShadow: !1,

                            balloonLayout: t,

                            iconLayout: o,

                            balloonContentLayout: c,

                            hideIconOnBalloonOpen: !1,

                            balloonOffset: [-100, -80]

                        }),

                        n = window.myPlacemark = new ymaps.Placemark([38.227547, 27.22873], {

                            balloonContent: ['<div class="balloon-city"><div class="balloon-city__text"><div class="balloon-city__price">$250 000</div><div class="balloon-city__rooms">2 спал, 1 ван</div><div class="balloon-city__rooms_m">2 010 кв.м  <span>|</span>  2 спальни  <span>|</span>  1 ванна</div><div class="balloon-city__address">Balbey, 431. Sk. No:4, 07040 Muratpaşa</div><div class="balloon-city__square">1 250 кв.м</div></div><div class="balloon-city__img"> <img src="./img/favorites-2.png"></div></div>'].join("")

                        }, {

                            balloonPanelMaxMapArea: e,

                            balloonShadow: !1,

                            balloonLayout: t,

                            iconLayout: o,

                            balloonContentLayout: c,

                            hideIconOnBalloonOpen: !1,

                            balloonOffset: [-100, -80]

                        }),

                        i = window.myPlacemark = new ymaps.Placemark([37.256168, 28.286126], {

                            balloonContent: ['<div class="balloon-city"><div class="balloon-city__text"><div class="balloon-city__price">$250 000</div><div class="balloon-city__rooms">2 спал, 1 ван</div><div class="balloon-city__rooms_m">2 010 кв.м  <span>|</span>  2 спальни  <span>|</span>  1 ванна</div><div class="balloon-city__address">Balbey, 431. Sk. No:4, 07040 Muratpaşa</div><div class="balloon-city__square">1 250 кв.м</div></div><div class="balloon-city__img"> <img src="./img/favorites-2.png"></div></div>'].join("")

                        }, {

                            balloonPanelMaxMapArea: e,

                            balloonShadow: !1,

                            balloonLayout: t,

                            iconLayout: o,

                            balloonContentLayout: c,

                            hideIconOnBalloonOpen: !1,

                            balloonOffset: [-100, -80]

                        }),

                        a = window.myPlacemark = new ymaps.Placemark([36.35589, 29.26059], {

                            balloonContent: ['<div class="balloon-city"><div class="balloon-city__text"><div class="balloon-city__price">$250 000</div><div class="balloon-city__rooms">2 спал, 1 ван</div><div class="balloon-city__rooms_m">2 010 кв.м  <span>|</span>  2 спальни  <span>|</span>  1 ванна</div><div class="balloon-city__address">Balbey, 431. Sk. No:4, 07040 Muratpaşa</div><div class="balloon-city__square">1 250 кв.м</div></div><div class="balloon-city__img"> <img src="./img/favorites-2.png"></div></div>'].join("")

                        }, {

                            balloonPanelMaxMapArea: e,

                            balloonShadow: !1,

                            balloonLayout: t,

                            iconLayout: o,

                            balloonContentLayout: c,

                            hideIconOnBalloonOpen: !1,

                            balloonOffset: [-100, -80]

                        }),

                        s = window.myPlacemark = new ymaps.Placemark([36.923977, 30.711918], {

                            balloonContent: ['<div class="balloon-city"><div class="balloon-city__text"><div class="balloon-city__price">$250 000</div><div class="balloon-city__rooms">2 спал, 1 ван</div><div class="balloon-city__rooms_m">2 010 кв.м  <span>|</span>  2 спальни  <span>|</span>  1 ванна</div><div class="balloon-city__address">Balbey, 431. Sk. No:4, 07040 Muratpaşa</div><div class="balloon-city__square">1 250 кв.м</div></div><div class="balloon-city__img"> <img src="./img/favorites-2.png"></div></div>'].join("")

                        }, {

                            balloonPanelMaxMapArea: e,

                            balloonShadow: !1,

                            balloonLayout: t,

                            iconLayout: o,

                            balloonContentLayout: c,

                            hideIconOnBalloonOpen: !1,

                            balloonOffset: [-100, -80]

                        });

                    C.geoObjects.events, C.behaviors.disable("scrollZoom"), C.geoObjects.add(l).add(n).add(i).add(a).add(s)

                }))

            }

            L.length && (k.onclick = function() {

                q.classList.remove("active"), c.destroy(!0, !0)

            }), L.length && (A.onclick = function() {

                x.classList.remove("active")

            }), L.length && window.addEventListener("resize", (function(e) {

                window.innerWidth <= 766 && q.classList.contains("active") && (x.classList.add("active"), q.classList.remove("active")), window.innerWidth > 766 && x.classList.contains("active") && (x.classList.remove("active"), q.classList.add("active"))

            })), P(E = window.innerWidth > 1003 ? 0 : 1 / 0), window.addEventListener("resize", (function(e) {

                this.document.querySelectorAll(".city-col__item").length && (window.innerWidth > 1003 && 0 == E && (C.destroy(), P(0), E = 1 / 0), window.innerWidth <= 1003 && E == 1 / 0 && (C.destroy(), P(1 / 0), E = 0))

            }))
        })();
    </script>

</script>

<script>
    let ids = {{ $country->id }};

window.country = {
    lat: {{ $country->lat }},
    long: {{ $country->long }},
};

getData('{{ app()->getLocale() }}', ids);
</script>
<script src="{{asset('project/js/tel-input.js')}}"></script>
@endsection
