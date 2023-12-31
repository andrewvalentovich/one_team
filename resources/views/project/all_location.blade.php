@extends('project.includes.layouts')

@section('header')
    @include('project.includes.header')
@endsection



@section('content')

    <section class="locations">
        <div class="locations__title title">
{{--            Все локации--}}
            {{__('Все') }} {{__('локации')}}
        </div>
        <div class="locations__subtitle">
            {{$count}} {{ __('локаций') }}
        </div>
        <div class="locations__content">

            @foreach($metric as $met)
                <div class="locations__list">
                    <div class="locations__list-title title">
                        {{__($met->name)}}
                    </div>
                    <div class="locations__items">
                        @php
                            $countries = $met->country->sortByDesc(function($country) {
                                return $country->product_country->count();
                            });
                        @endphp
                        @foreach($countries as $country)
                            @if(count($country->product_country) > 0)
                               <div class="locations__item">
                                    <div class="locations__item-img">
                                        <a href="{{ route('countries', $country->slug) }}">     <img style="max-width: 26px;" src="{{asset("uploads/$country->flag")}}" alt="hungary"> </a>
                                    </div>
                                    <div class="locations__item-title">
                                        <a href="{{ route('countries', $country->slug) }}">
                                            {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}
                                            <span>{{$country->product_country->count()}}</span> </a>
                                    </div>
                                </div>
                            @else
                                <div class="locations__item">
                                    <div class="locations__item-img">
                                        <span><img style="max-width: 26px;" src="{{asset("uploads/$country->flag")}}" alt="hungary"></span>
                                    </div>
                                    <div class="locations__item-title">
                                        <p href="{{route('countries', $country->slug) }}">
                                            {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}
                                            <span>({{ __('скоро открытие') }})</span> </p>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('footer')
    @include('project.includes.footer')
@endsection
