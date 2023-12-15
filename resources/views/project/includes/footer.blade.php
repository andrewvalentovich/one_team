<div class="footer-w">
    <footer class="footer footer_full container">
        <div class="footer__top">
            <a href="{{route('home_page')}}" class="footer__logo">
                <img src="{{asset('project/img/svg/new_logo.svg')}}" alt="logo">
            </a>
        </div>
        <?php $company_pages = \App\Models\CompanySelect::orderby('status' , 'asc')->orderby('updated_at', 'desc')->get(); ?>
        <div class="footer__nav">
            <div class="footer__nav-list">
                @foreach($company_pages as $pages)
                <a href="{{ route('about', $pages->slug) }}" class="footer__nav-item">
                    {{__($pages->name)}}
{{--                   {{}}--}}
                </a>
                    @endforeach
            </div>
        </div>
        <div class="footer__content">
            <a target="_blank" href="{{route('user_agreement_when_using_the_site')}}" class="footer__subtitle">
           {{__('Пользовательское соглашение при использовании сайта')}}
            </a>
            <a target="_blank" href="{{route('personal_data_processing_policy')}}" class="footer__subtitle">
                {{__('Политика обработки персональных данных')}}
            </a>
        </div>
        <div class="footer__bottom">
            <div class="footer__slogan">
                © 2022 - {{\Illuminate\Support\Carbon::now()->year}} OneTeam
            </div>
        </div>
    </footer>
</div>