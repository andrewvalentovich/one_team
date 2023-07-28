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
            {{$count}} локаций
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
                           <div class="locations__item">

                                <div class="locations__item-img">
                                    <a href="{{route('country',$country->id )}}">     <img style="max-width: 26px;" src="{{asset("uploads/$country->photo")}}" alt="hungary"> </a>
                                </div>
                                <div class="locations__item-title">
                                    @if(app()->getLocale() == 'en') <?php $country->name = $country->name_en ?> @elseif(app()->getLocale() == 'tr') <?php $country->name = $country->name_tr ?>  @endif
                                    <a href="{{route('country',$country->id )}}">    {{$country->name}}
                                        <span>{{$country->product_country->count()}}</span> </a>
                                </div>

                            </div>

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
