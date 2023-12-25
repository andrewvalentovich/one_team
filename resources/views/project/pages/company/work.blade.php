@extends('project.includes.layouts')

@section('header')
    @include('project.includes.header')
@endsection

@section('seo')
<title>{{ __('Вакансии в сфере недвижимости в Турции: работа от агентства Oneteam') }}</title>
<meta name="description" content="{{ __('Ищете работу в сфере недвижимости в Турции? В агентстве Oneteam есть вакансии, которые могут вас заинтересовать.') }}" />
@endsection

@section('content')
    <!-- {!! json_decode($get->content) !!} -->
    <section class="about">
        <div class="about__content maxContainer">
            <div class="hello__title title">
                {{ __('Работа у нас') }}
            </div>
            <div class="about__preview">
                <p class="about__preview-text max">
                    {{ __('Самый современный из трендов — цифровизация — коснулся и нашей сферы деятельности, и в работе с недвижимостью с каждым годом все более востребованными становятся высокие технологии. Прежние методы ведения дел уже не работают, поэтому мы создаем новые, отвечающие требованиям сегодняшнего дня: в частности, на нас уже сейчас работает цифровая платформа с искусственным интеллектом, которая анализирует рынок и определяет наиболее ликвидные объекты недвижимости.') }}
                </p>
                <!-- <img class="about__preview-pic" src="{{asset('project/img/about-preview.png')}}" alt="о компании"> -->
                <p class="about__text-desc desc desc_blue">
                    {{ __('За счет внедрения новых технологий меняется сфера недвижимости, а вместе с ней развиваемся мы, и интенсивный рост обуславливает потребность Oneteam в энергичных и амбициозных людях, тех, кто хочет расти, кто готов не только улучшать имеющиеся навыки, но и приобретать новые.') }}
                </p>
            </div>
            <div class="about__text">
                <p style="max-width: none">
                    {{ __('Работа в агентстве недвижимости в Турции крайне перспективна, ведь этот рынок значительно расширился за последние годы и тяготеет к дальнейшему расширению в будущем. Oneteam приглашает стать вас частью команды, нацеленной на то, чтобы улучшать коммуникацию между участниками сделок с недвижимостью — риелторами, застройщиками, клиентами, — и облегчать для всех заинтересованных сторон протекание процесса купли-продажи жилых и коммерческих объектов.') }}
                    {{ __('В нашей компании открыты вакансии в сфере недвижимости в Турции, которые дают соискателям возможность работать в организации с хорошей репутацией, приобретать полезный профессиональный опыт и строить карьеру в одном из лучших агентств страны. Чтобы получить информацию о вакансиях агентства Oneteam и узнать больше о работе с недвижимостью в Турции, отправьте нам сообщение по форме обратной связи.') }}
                </p>
                <!-- <img src="{{asset('project/img/man.svg')}}" alt="картинка с человеком"> -->
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
    <script src="{{asset('project/js/app.js')}} "></script>
    <script src="{{asset('project/js/tel-input.js')}}"></script>
@endsection
