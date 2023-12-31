@extends('project.includes.layouts')

@section('header')
    @include('project.includes.header')
@endsection

@section('seo')
<title>{{ __('Сайт недвижимости в Турции от застройщика: покупка, продажа в Анталии и других регионах') }}</title>
<meta name="description" content="{{ __('Продажа и покупка высоколиквидной недвижимости в Турции. Самые популярные регионы — Мерсин, Бодрум, Фетхие, Анталия (Манавгат, Кемер, Белек, Финике, Сиде, Алания, Махмутлар, Авсаллар, Каргыджак, Кестел).') }}" />
@endsection

@section('content')
     <!-- <section class="index-map">
        <div class="index-map__content">
            <div class="index-map__content-buttons">
                <div class="index-map__button active">
                    {{__('Турция')}}
                </div>
            </div>
            <div id="map-country">
            </div>
        </div>
    </section>  -->
    <div class="container with-filter">
        <section class="preview">
            <img class="preview__bg" src="{{asset('project/img/preview-index.webp')}}" alt="">
            <div class="preview__content">
                <h1>
                    Oneteam {{ __('— лицензированное агентство недвижимости') }}
                </h1>
                <p class="preview__subtitle">
                    {{ __('Мы помогаем клиентам купить, продать, арендовать или сдать в аренду коммерческие и жилые объекты') }}
                </p>
                <ul class="preview__list">
                    <li>
                        <div class="icon">
                            <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.4191 18.8422L21.3907 14.6499L22.6284 12.3012C22.9041 11.7769 22.9147 10.8896 22.4425 10.192C21.4812 8.7723 19.3134 8.95917 18.627 10.5502L15.8636 15.351H10.6082L9.33624 10.1758L16.0008 8.39002C16.4089 8.28071 16.651 7.8613 16.5417 7.45324C15.4076 3.22108 11.2214 0.606041 6.9849 1.33985L6.77784 0.567125C6.66848 0.159103 6.24921 -0.0831581 5.84101 0.0262932C5.43299 0.135607 5.19086 0.555009 5.30018 0.963076L5.50724 1.73584C1.47131 3.21869 -0.846394 7.57641 0.287631 11.8086C0.396899 12.2162 0.816439 12.4589 1.22441 12.3494L7.85831 10.5719L9.0329 15.351H3.75423C2.5493 15.351 1.56901 16.3314 1.56901 17.5362V17.7551C1.56901 18.96 2.54935 19.9403 3.75423 19.9403H4.19635L3.18522 21.8816C2.99009 22.2563 3.13561 22.7182 3.51032 22.9134C3.88479 23.1084 4.34683 22.9631 4.542 22.5883L5.92113 19.9403H10.1608L10.7696 22.4175C10.8704 22.8277 11.2847 23.0785 11.6949 22.9777C12.1052 22.8769 12.356 22.4626 12.2551 22.0524L11.736 19.9403H17.6773L19.0565 22.5883C19.2517 22.9631 19.7138 23.1083 20.0882 22.9134C20.4629 22.7182 20.6084 22.2563 20.4133 21.8816L19.4021 19.9403H22.7306C23.2942 19.9403 23.6646 19.3496 23.4191 18.8422ZM1.60807 10.6629C1.08715 7.24415 3.21606 3.8972 6.63264 2.98157C6.63273 2.98157 6.63282 2.98152 6.63296 2.98152L6.6331 2.98148C10.051 2.0658 13.5674 3.90142 14.8253 7.12135L1.60807 10.6629ZM3.75423 18.4106C3.39279 18.4106 3.09876 18.1165 3.09876 17.7551V17.5363C3.09876 17.1748 3.39283 16.8808 3.75423 16.8808H9.40889L9.78488 18.4106C9.18833 18.4106 4.34504 18.4106 3.75423 18.4106ZM17.68 18.4106H11.3602L10.9842 16.8808H16.3058C16.5794 16.8808 16.8322 16.7347 16.9687 16.4975C20.1861 10.9082 19.9947 11.248 20.0243 11.1738C20.2188 10.6876 20.8802 10.6133 21.1757 11.0497C21.2935 11.2237 21.321 11.4334 21.2529 11.63L17.68 18.4106ZM19.4091 18.4106L20.5048 16.3312L21.5109 18.4106H19.4091Z" fill="#4CB7FF"/>
                            </svg>
                        </div>
                        <p>
                            {{ __('Подходит для жизни и') }}

                            <span>
                                {{ __('инвестиций') }}
                            </span>
                        </p>
                    </li>
                    <li>
                        <div class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.71493 10.51L4.35987 10.978C4.44984 11.0036 4.54549 11.0016 4.63437 10.9721L13.5683 8.01379C14.2534 8.79521 15.1785 9.32931 16.1813 9.53565C16.6228 11.5117 17.84 12.3456 18.9964 12.3456C19.2639 12.3456 19.5283 12.2995 19.7752 12.206C21.0198 11.7343 21.4858 9.97785 20.8361 8.20713C20.8008 8.11109 20.7627 8.01971 20.723 7.93084C21.7564 6.68865 22.1423 4.96906 21.6146 3.32391C20.9771 1.33578 19.1673 0 17.1111 0C14.6717 0 12.6283 1.89218 12.3938 4.35191L12.0186 4.47617C11.9297 4.50564 11.8513 4.56119 11.7934 4.63577L10.9312 5.74672L9.59046 5.36524C9.40627 5.31276 9.20913 5.37814 9.09074 5.53066L8.22855 6.64161L6.88776 6.26012C6.70351 6.20779 6.50648 6.27303 6.38804 6.42564L5.57075 7.47873L4.72249 7.04038C4.6104 6.98251 4.4804 6.97226 4.36101 7.01178L3.46011 7.31008C3.31831 7.35707 3.20655 7.4691 3.15846 7.61252L2.3942 9.89109C2.35217 10.0164 2.36274 10.1536 2.42343 10.2707C2.48411 10.3878 2.58953 10.4743 2.71493 10.51ZM19.4441 11.3038C19.0703 11.4454 18.6201 11.3971 18.2396 11.1748C17.8892 10.9701 17.4499 10.5381 17.1839 9.62943C18.2019 9.61311 19.1854 9.26287 19.9838 8.64529C20.3835 9.83553 20.146 11.0377 19.4441 11.3038ZM3.97883 8.15105L4.46789 7.98909L5.48747 8.51588C5.68882 8.61992 5.93437 8.56513 6.07417 8.38483L6.93637 7.27392L8.27715 7.65536C8.4613 7.7077 8.65844 7.64246 8.77688 7.48985L9.63907 6.37894L10.9798 6.76043C11.1639 6.81276 11.3611 6.74757 11.4795 6.59491L12.4485 5.34641L12.9936 5.16587C13.1845 5.10266 13.3154 4.92405 13.3204 4.72007C13.3714 2.62915 15.0625 0.96277 17.111 0.96277C18.7559 0.96277 20.2037 2.03146 20.7137 3.62211C21.1027 4.83508 20.8706 6.09249 20.19 7.06103C19.7254 6.4966 19.1579 6.16437 18.6251 5.9704C18.9821 5.48526 19.1102 4.8373 18.912 4.2188C18.5841 3.19643 17.5107 2.65741 16.523 2.9844C15.5295 3.31342 14.9846 4.40247 15.3084 5.41208C15.6142 6.36585 16.5787 6.91352 17.5298 6.69308C18.188 6.77237 18.984 7.03663 19.5374 7.77495C18.8508 8.35628 17.9829 8.66801 17.1096 8.66801C15.9399 8.66801 14.816 8.10483 14.1033 7.16141C13.981 6.9996 13.7716 6.9337 13.5807 6.99686L4.47717 10.0114L3.45267 9.71989L3.97883 8.15105ZM17.1099 5.77874C16.6987 5.77874 16.3368 5.51154 16.2093 5.11383C16.0474 4.609 16.3198 4.06445 16.8165 3.89999C17.3121 3.73582 17.8475 4.00711 18.0111 4.51714C18.1729 5.02193 17.7538 5.77874 17.1099 5.77874Z" fill="#4CB7FF"/>
                                <path d="M21.9953 18.1563C21.9391 17.5359 21.3837 17.0613 20.8642 16.9132C20.4426 16.793 20.155 16.9024 19.7834 16.9374C19.6928 16.9322 19.6643 16.9432 19.3239 17.0334C15.0997 18.1519 13.5156 18.3866 12.9306 18.3866C12.7975 18.3866 12.7516 18.3739 12.7509 18.3737C11.9414 18.1082 10.8106 17.8666 10.4325 17.5612C10.7157 17.5234 11.0902 17.5926 11.3699 17.6793C11.848 17.8276 12.3846 17.9028 12.9649 17.9027C14.408 17.9027 15.8071 17.4287 16.4463 16.7234C16.7522 16.3858 16.8966 15.994 16.8638 15.5903C16.8375 15.2656 16.6636 14.8436 15.9854 14.6771C14.9015 14.4111 12.7619 14.8654 11.5143 13.7561C10.197 12.585 8.67501 11.9912 6.99056 11.9912C5.80228 11.9912 4.80321 12.2927 4.19443 12.5334C4.01132 11.9657 3.48531 11.5545 2.86625 11.5545H1.39759C0.626926 11.5545 0 12.1916 0 12.9747V19.2815C0 20.0647 0.626926 20.7017 1.39759 20.7017H2.86625C3.48431 20.7017 4.00962 20.2917 4.19353 19.7255L7.85631 21.3536C8.74092 21.7825 9.86841 22 11.2074 22C15.2793 22 20.2275 19.9924 20.8334 19.6894C21.862 19.1751 22.033 18.5718 21.9953 18.1563ZM3.31637 19.2815C3.31637 19.5337 3.11445 19.7389 2.86629 19.7389H1.39764C1.14948 19.7389 0.947567 19.5337 0.947567 19.2815V12.9747C0.947567 12.7226 1.14948 12.5174 1.39764 12.5174H2.86629C3.11445 12.5174 3.31637 12.7226 3.31637 12.9747V19.0207V19.2815ZM20.4151 18.8254C19.8351 19.1154 15.1 21.0371 11.2074 21.0371C10.0074 21.0371 9.01517 20.8502 8.2582 20.4816C8.2428 20.4742 8.51986 20.5977 4.26384 18.7058V13.5468C4.71069 13.3438 5.73264 12.9541 6.99051 12.9541C8.4387 12.9541 9.75083 13.4678 10.8903 14.4808C12.0015 15.4688 13.5441 15.5048 14.6705 15.531C15.1118 15.5413 15.7738 15.5567 15.9195 15.6701C15.9235 15.7194 15.9345 15.8667 15.7491 16.0712C15.2931 16.5745 14.122 16.9398 12.9647 16.9399C12.4852 16.9399 12.0293 16.8771 11.6463 16.7584C11.287 16.647 10.926 16.5881 10.6022 16.5881C9.92873 16.5881 9.6357 16.8462 9.50845 17.0627C9.42104 17.2114 9.30815 17.5245 9.53413 17.9509C9.93138 18.7004 11.2543 18.8945 12.4597 19.2899C12.5834 19.3305 12.7331 19.3494 12.9305 19.3494C14.3812 19.3494 18.3983 18.2672 19.8024 17.9019C20.1147 17.8781 20.3315 17.8211 20.4736 17.8211C20.5203 17.8211 20.5618 17.827 20.6082 17.8401C20.7962 17.8938 21.0378 18.0909 21.0518 18.2445C21.0623 18.3604 20.9019 18.582 20.4151 18.8254Z" fill="#4CB7FF"/>
                            </svg>
                        </div>
                        <p>
                            {{ __('С качественной отделкой') }} <span>"{{ __('Под ключ') }}"</span>
                        </p>
                    </li>
                    <li>
                        <div class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.0664 5.15625H17.4436C17.8491 4.61725 18.0898 3.94758 18.0898 3.22266C18.0898 1.44568 16.6442 0 14.8672 0C13.7968 0 13.0075 0.383496 12.3832 1.20686C11.8609 1.89574 11.479 2.85755 11 4.07279C10.521 2.85751 10.1391 1.89574 9.61679 1.20686C8.9925 0.383496 8.20321 0 7.13281 0C5.35584 0 3.91016 1.44568 3.91016 3.22266C3.91016 3.94758 4.15091 4.61725 4.55645 5.15625H1.93359C0.86741 5.15625 0 6.02366 0 7.08984V8.37891C0 9.21916 0.538871 9.93558 1.28906 10.2016V20.0664C1.28906 21.1326 2.15647 22 3.22266 22H18.7773C19.8435 22 20.7109 21.1326 20.7109 20.0664V10.2016C21.4611 9.93558 22 9.21916 22 8.37891V7.08984C22 6.02366 21.1326 5.15625 20.0664 5.15625ZM12.1831 4.58648C13.1705 2.08149 13.5459 1.28906 14.8672 1.28906C15.9334 1.28906 16.8008 2.15647 16.8008 3.22266C16.8008 4.28884 15.9334 5.15625 14.8672 5.15625H11.9576C12.0366 4.95795 12.1119 4.76704 12.1831 4.58648ZM7.13281 1.28906C8.45414 1.28906 8.82952 2.08149 9.8169 4.58648C9.88805 4.76704 9.96338 4.95795 10.0424 5.15625H7.13281C6.06663 5.15625 5.19922 4.28884 5.19922 3.22266C5.19922 2.15647 6.06663 1.28906 7.13281 1.28906ZM8.42188 20.7109H3.22266C2.86726 20.7109 2.57812 20.4218 2.57812 20.0664V10.3125H8.42188V20.7109ZM8.42188 9.02344H1.93359C1.5782 9.02344 1.28906 8.7343 1.28906 8.37891V7.08984C1.28906 6.73445 1.5782 6.44531 1.93359 6.44531H8.42188V9.02344ZM12.2891 20.7109H9.71094V6.44531C9.84599 6.44531 11.5483 6.44531 12.2891 6.44531V20.7109ZM19.4219 20.0664C19.4219 20.4218 19.1327 20.7109 18.7773 20.7109H13.5781V10.3125H19.4219V20.0664ZM20.7109 8.37891C20.7109 8.7343 20.4218 9.02344 20.0664 9.02344H13.5781V6.44531H20.0664C20.4218 6.44531 20.7109 6.73445 20.7109 7.08984V8.37891Z" fill="#4CB7FF"/>
                            </svg>
                        </div>
                        <p>
                            <span>{{ __('Рассрочка 0%') }}.</span> {{ __('Первый взнос от 30%') }}
                        </p>
                    </li>
                    <li>
                        <div class="icon">
                            <svg width="26" height="19" viewBox="0 0 26 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.5417 8.06964H19.0197C18.7661 8.06964 18.5585 8.27718 18.5585 8.53084C18.5585 8.78449 18.7661 8.99203 19.0197 8.99203H20.5417C20.7492 8.99203 20.9198 9.16268 20.9198 9.37021V15.993C20.9198 16.2005 20.7492 16.3712 20.5417 16.3712H19.0197C18.7661 16.3712 18.5585 16.5787 18.5585 16.8324C18.5585 17.086 18.7661 17.2936 19.0197 17.2936H20.5417C21.2565 17.2936 21.8422 16.7125 21.8422 15.993V9.37021C21.8422 8.65536 21.2611 8.06964 20.5417 8.06964Z" fill="#4CB7FF"/>
                                <path d="M2.99315 8.99203H4.5151C4.76876 8.99203 4.9763 8.78449 4.9763 8.53084C4.9763 8.27718 4.76876 8.06964 4.5151 8.06964H2.99315C2.2783 8.06964 1.69258 8.65075 1.69258 9.37021V15.993C1.69258 16.7078 2.27369 17.2936 2.99315 17.2936H4.5151C4.76876 17.2936 4.9763 17.086 4.9763 16.8324C4.9763 16.5787 4.76876 16.3712 4.5151 16.3712H2.99315C2.78562 16.3712 2.61497 16.2005 2.61497 15.993V9.37021C2.61497 9.16268 2.78562 8.99203 2.99315 8.99203Z" fill="#4CB7FF"/>
                                <path d="M12.2263 8.86291V8.52162C12.2263 8.26796 12.0188 8.06042 11.7651 8.06042C11.5115 8.06042 11.3039 8.26796 11.3039 8.52162V8.88597C10.0956 9.0935 9.19164 9.95594 9.19164 10.9844C9.19164 12.0129 10.091 12.8661 11.3039 13.0736V15.5456C10.5245 15.4211 9.92494 14.9276 9.92494 14.3511C9.92494 14.0975 9.7174 13.8899 9.46374 13.8899C9.21009 13.8899 9.00255 14.0975 9.00255 14.3511C9.00255 15.4349 10.008 16.3297 11.3039 16.4726V16.8139C11.3039 17.0676 11.5115 17.2751 11.7651 17.2751C12.0188 17.2751 12.2263 17.0676 12.2263 16.8139V16.4496C13.4346 16.242 14.3432 15.3796 14.3432 14.3511C14.3432 13.3227 13.4531 12.4648 12.2263 12.2619V9.78991C13.0057 9.90982 13.6053 10.4079 13.6053 10.9844C13.6053 11.2381 13.8128 11.4456 14.0665 11.4456C14.3201 11.4456 14.5277 11.2381 14.5277 10.9844C14.5277 9.9006 13.5223 9.00588 12.2263 8.86291ZM10.114 10.9844C10.114 10.4586 10.6213 9.99745 11.3039 9.83142V12.1374C10.6167 11.9714 10.114 11.5102 10.114 10.9844ZM13.4208 14.3557C13.4208 14.8815 12.9135 15.3381 12.2263 15.5087V13.2028C12.9181 13.3688 13.4208 13.83 13.4208 14.3604V14.3557Z" fill="#4CB7FF"/>
                                <path d="M25.767 10.4725L22.7001 0.902677C22.4833 0.220107 21.7454 -0.158074 21.0674 0.0633003L1.70181 6.3494H1.30057C0.585719 6.3494 0 6.93051 0 7.64997V17.6994C0 18.4143 0.581107 19 1.30057 19H22.2343C22.9491 19 23.5348 18.4189 23.5348 17.6994V12.534C23.5671 12.534 23.5994 12.5294 23.6317 12.5202L24.923 12.1051C25.6056 11.8884 25.9792 11.1551 25.7624 10.4725H25.767ZM22.6124 17.6994C22.6124 17.907 22.4418 18.0776 22.2343 18.0776H1.30057C1.09303 18.0776 0.922392 17.907 0.922392 17.6994V7.64997C0.922392 7.44243 1.09303 7.27179 1.30057 7.27179H10.875C10.875 7.27179 10.8796 7.27179 10.8842 7.27179H10.8888H12.5307C12.5307 7.27179 12.5353 7.27179 12.5399 7.27179C12.5445 7.27179 12.5445 7.27179 12.5491 7.27179H22.2343C22.4418 7.27179 22.6124 7.44243 22.6124 7.64997V17.6994ZM24.6463 11.2289L23.5348 11.584V7.64997C23.5348 7.07348 23.1566 6.58922 22.6355 6.41858L21.6116 3.05185C21.5056 2.71979 21.2796 2.4523 20.9706 2.29088C20.6616 2.13407 20.3111 2.10179 19.979 2.20786L18.5308 2.67367C18.2864 2.75207 18.1527 3.01034 18.2311 3.25478C18.3095 3.49921 18.5677 3.62834 18.8122 3.55455L20.2603 3.08875C20.3572 3.05646 20.4586 3.06569 20.5463 3.1118C20.6339 3.15792 20.7031 3.23633 20.7308 3.32396L21.6485 6.34479H14.8966C14.4354 5.68989 13.5499 5.35783 12.5953 5.4639L12.4892 5.13646C12.4108 4.89663 12.1525 4.76289 11.9081 4.83668C11.6636 4.91508 11.5299 5.17335 11.6083 5.41778L11.6959 5.68989C11.3131 5.8467 10.9718 6.06807 10.6951 6.34479H4.68575L21.3441 0.939572C21.441 0.907288 21.5425 0.916512 21.6301 0.962632C21.7177 1.00875 21.7869 1.08716 21.8146 1.18401L24.8815 10.7538C24.9461 10.9521 24.8354 11.1643 24.6371 11.2289H24.6463Z" fill="#4CB7FF"/>
                            </svg>
                        </div>
                        <p>
                            {{ __('Работаем') }} <span>{{ __('без комиссии') }}</span> {{ __('по ценам застройщиков') }}
                        </p>
                    </li>
                </ul>
            </div>
        </section>
    </div>
     <div class="container-w">
         @include('project.includes.search_nav_bar')
     </div>
    <div class="container-w">
        @include('project.includes.objects-carousel', ['title' => __('Лучшие объекты'), 'products' => $products])
    </div>
    <!-- лучшие -->
    <section class="popular-locations container">
        <div class="popular-locations__title title">
            {{__('Популярные локации')}}
        </div>
        <div class="popular-locations__content">
            <div class="popular-locations__list">
                @foreach($all_country as $country)
                    @if(count($country->product_country) > 0)
                        <a href="{{route('countries', $country->slug)}}" class="popular-locations__item">
                            <div class="popular-locations__item-img">
                                <img style="max-width: 50px" src="{{asset("uploads/$country->flag")}}" alt="gr">
                            </div>
                            <div class="popular-locations__item-text">
                                {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}
                                <span>{{$country->product_country->count()}}</span>
                            </div>
                        </a>
                    @else
                        <div class="popular-locations__item _close-opening">
                            <div class="popular-locations__item-img">
                                <img style="max-width: 50px" src="{{asset("uploads/$country->flag")}}" alt="gr">
                            </div>
                            <div class="popular-locations__item-text _close-opening">
                                {{ $country->locale_fields->where('locale.code', app()->getLocale())->first()->name }}
                                <span>({{ __('скоро открытие') }})</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="popular-locations__footer">
            <div class="popular-locations__button">
                <a href="{{route('all_location')}}">{{__('Все локации')}}</a>
            </div>
        </div>
    </section>

    @include('project.includes.still-have-questions')
    <div class="index-questions">
        @include('project.includes.form-main')
    </div>

    @if(!empty($citizenship_product))
    <section class="objects-slider container">
        <div class="objects-slider__title title">
            {{ $citizenship_for_invesment }}
        </div>
        <div class="objects-slider__content">
            <div class="objects__swiper swiper">
                <div class="objects__wrapper swiper-wrapper">
                    @foreach($citizenship_product as $product)
                    <div class="objects__slide swiper-slide open-place-popup" data_id="{{$product->id}}">
                        <div class="objects__slide-img">
                            @if($product->photo[0]->preview)
                                <img src="{{ asset($product->photo[0]->preview) }}" alt="place">
                            @else
                                <img src="{{ asset('uploads/'.$product->photo[0]->photo) }}" alt="place">
                            @endif
                        </div>
                        <div class="objects__slide-text">
                            <div class="objects__slide-price" @if(app()->getLocale() == 'ar' || app()->getLocale() == 'fa')style="direction: ltr!important; text-align: right;"@endif>
                                @if (isset($product->layouts))
                                    @if (isset($product->price["EUR"]))
                                        @php
                                        $euroPrice = str_replace(' €', '', $product->price["EUR"]);
                                        @endphp
                                        @if (count($product->layouts) > 1)
                                            {{ "€ " . $euroPrice . " +" }}
                                        @else
                                            {{ "€ " . $euroPrice }}
                                        @endif
                                    @else
                                        {{ "€ " . str_replace(' €', '', $product->price["EUR"]) }}
                                    @endif
                                @endif
                            </div>
                            <div class="objects__slide-rooms">
                                @if($product->number_rooms_unique != "")
                                    {{ $product->number_rooms_unique }}
                                @else
                                    {{ $product->size }} {{__('кв.м')}} <span>|</span> {{ str_replace('+', '', $product->spalni) }} <span>|</span> {{ str_replace('+', '', $product->vanie) }}
                                @endif
                            </div>
                            <div class="objects__slide-address">
                            {{$product->address}}
        {{--                                Balbey, 431. Sk. No:4, 07040 Muratpaşa--}}
                            </div>
                        </div>
                        @php
                            $user_id = isset($_COOKIE["user_id"]) ? $_COOKIE['user_id'] : null;
                            $fav = $product->favorite->where('user_id', isset($_COOKIE["user_id"]) ? $_COOKIE['user_id'] : null)->where('product_id', $product->id)->all();
                        @endphp
                        <div class="objects__slide-favorites check-favorites {{ count($fav) === 0 ? '' : 'active' }}"  data_id="{{$product->id}}" >
                            <svg class="blue" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="73px" height="64px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 2.33 2.04"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Слой_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"/>
                                    <path class="fil0 str0" d="M1.16 1.88c-0.22,-0.16 -0.5,-0.38 -0.77,-0.65 -0.2,-0.19 -0.26,-0.37 -0.26,-0.55 0,-0.31 0.26,-0.55 0.58,-0.55 0.18,0 0.35,0.08 0.45,0.21 0.11,-0.13 0.28,-0.21 0.46,-0.21 0.32,0 0.58,0.24 0.58,0.55 0,0.18 -0.06,0.36 -0.26,0.55 -0.27,0.27 -0.56,0.49 -0.78,0.65z"/>
                                </g>
                            </svg>
                        </div>
                        <div class="die__list">
                            @foreach($product->tags as $tag)
                            <div class="die__list-item">
                                    {{ $tag }}
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="objects__pagination"></div>
            </div>
            <div class="objects__prev objects__btn">
                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35px" height="60px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                    viewBox="0 0 0.5 0.86"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Слой_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"/>
                        <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "/>
                    </g>
                    </svg>
            </div>
            <div class="objects__next objects__btn">
                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35px" height="60px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                    viewBox="0 0 0.5 0.86"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Слой_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"/>
                        <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "/>
                    </g>
                    </svg>
            </div>
        </div>
    </section>
    @endif
    <script>
        //отправить запрос с фильтром по кнопке найти страница houses
        // if(document.querySelectorAll('.btn-filter-houses').length) {
        //     const btnFilterHouses = document.querySelectorAll('.btn-filter-houses')
        //     btnFilterHouses.forEach(btn => {
        //         btn.addEventListener('click', async function() {
        //             console.log(window.filter_params_data)
        //             handleCountries(window.filter_params_data);
        //         })
        //     });
        // }
        if(document.querySelectorAll('.btn-filter-houses').length) {
            const btnFilterHouses = document.querySelectorAll('.btn-filter-houses')
            btnFilterHouses.forEach(btn => {
                btn.addEventListener('click', async function() {
                    const currentURL = window.location.href;
                    window.location.href = currentURL;
                    history.pushState(null, null, currentURL);
                })
            });

        }
    </script>
     <!-- <section class="hello container">
        <div class="hello__title title">
            {{ __('Приветствую вас, дорогой гость!') }}
        </div>
        <div class="hello__content">
            <img class="hello__content-pic" src="{{asset('project/img/hellow-preview.webp')}}" alt="Владелец компании oneteam">
            <div class="hello__text">
                <div class="hello__text-lead">
                    <p>
                        {{ __('Давайте познакомимся.') }}
                    </p>
                    <p>
                        {{ __('Меня зовут Фаиг Ализаде, я — владелец агентства') }} <b>Oneteam</b>.
                    </p>
                    <p>
                        {{ __('Наша сфера деятельности — сделки с недвижимостью в Турции: мы помогаем клиентам купить, продать, арендовать или сдать в аренду коммерческие и жилые объекты.') }}
                    </p>
                </div>
                <div class="hello__text-lead">
                    <p>
                        {{ __('Офис агентства расположен в Анталье; зоны нашего особого интереса — это Анталия, Алания, Мерсин, Кемер, Белек, Махмутлар, Авсаллар, Кестел и другие. Также мы активно работаем и в других регионах Турецкой Республики, в частности, в Мерсине, Бодруме, Фетхие.') }}
                    </p>
                </div>
                <div class="hello__text-lead">
                    <p>
                        {{ __('В портфеле Oneteam представлены высоколиквидные объекты, предназначенные для разных целей: для инвестиций, сдачи в аренду и просто для комфортной жизни. Все они поступают к нам напрямую от застройщиков, минуя посредников, и это значит, что мы можем предложить вам лучшие цены на них.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>  -->
     <!-- <section class="benefit container">
        <div class="benefit__title title">
            {{ __('Чем мы будем вам полезны?') }}
        </div>
        <div class="benefit__content">
            <div class="benefit__item">
                {{ __('Подберем объекты под ваш запрос') }}
            </div>
            <div class="benefit__item">
                {{ __('Обеспечим юридическое сопровождение на всех этапах сделки') }}
            </div>
            <div class="benefit__item">
                {{ __('Проконсультируем и поможем оформить все документы') }}
            </div>
            <div class="benefit__item">
                {{ __('Поможем получить выгодные условия по рассрочке и кредиту') }}
            </div>
            <div class="benefit__item">
                {{ __('Возьмем вашу недвижимость в управление') }}
            </div>
            <div class="benefit__item">
                {{ __('Обеспечим постпродажный сервис') }}
            </div>
        </div>
        <div class="benefit__desc">
            <svg width="46" height="45" viewBox="0 0 46 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M23 2C34.598 2 44 11.1782 44 22.5C44 33.8218 34.598 43 23 43C11.402 43 2 33.8218 2 22.5C2 11.1782 11.402 2 23 2Z" stroke="#FA0064" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M13 21.6399L21.2353 29.3334L33 15.6667" stroke="#FA0064" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <p>
                {{ __('Специалисты Oneteam говорят на русском, турецком, английском, немецком, иранском, арабском языках. Поэтому можете не волноваться: наше с вами сотрудничество не затруднит языковой барьер.') }}
            </p>
        </div>
        <button class="benefit__btn">
            {{ __('Посмотреть каталог объектов') }}
        </button>
    </section>  -->
     <!-- <section class="why container">
        <div class="why__title title">
            {{ __('Почему клиенты выбирают именно нас?') }}
        </div>
        <div class="why__desc">
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none">
                <g clip-path="url(#clip0_17_222)">
                    <path d="M22.5025 0C10.0757 0 0.00170898 10.0724 0.00170898 22.496C0.00170898 34.926 10.0757 45 22.5025 45C34.9293 45 45.0001 34.9244 45.0001 22.496C45.0001 10.0724 34.9293 0 22.5025 0ZM22.5025 42.6955C11.3454 42.6955 2.30618 33.6514 2.30618 22.4944C2.30618 11.3421 11.3454 2.30126 22.5025 2.30126C33.6564 2.30126 42.6972 11.3421 42.6972 22.4944C42.6956 33.6514 33.6548 42.6955 22.5025 42.6955Z" fill="#FA0064"/>
                    <path d="M25.0708 27.6119L26.0557 7.3689H18.9958L19.9775 27.6119H25.0708Z" fill="#FA0064"/>
                    <path d="M22.5266 29.8455C20.1594 29.8455 18.5034 31.5014 18.5034 33.9105C18.5034 36.2327 20.1111 37.9787 22.4365 37.9787H22.5266C24.9389 37.9787 26.4999 36.2327 26.4999 33.9105C26.458 31.5014 24.8922 29.8455 22.5266 29.8455Z" fill="#FA0064"/>
                </g>
                <defs>
                    <clipPath id="clip0_17_222">
                    <rect width="45" height="45" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
            <p>
                {{ __('Хороших агентств в Турции много, но у Oneteam есть серьезный козырь.') }}
            </p>
        </div>
        <p class="why__lead">
            {{ __('Пока другие подбирают объекты недвижимости вручную, мы разработали собственный IT-продукт на базе искусственного интеллекта, который анализирует предложения рынка и помогает не только выбрать из них максимально соответствующие запросу клиента, но и определить наиболее ликвидные.') }}
        </p>
        <button class="why__btn">
            {{ __('Тестовая версия программы') }}
        </button>
    </section>  -->
     <!-- {!! $citizenship_div !!} -->
    <!-- <form action="" id="index_page_form" style="display: none;">
        <section class="contact">
            <div class="contact__title title">
                {{__('Свяжитесь с нами')}}

            </div>
            <div class="contact__subtitle container">
                <span>{{__('Если у вас есть вопросы')}},</span>{{__('оставьте свои контактные данные, и мы свяжемся с вами в самое ближайшее время')}}
            </div>
            <div class="contact__form selection-phone">
                <div class="contact__form-top">
                    <div class="contact__top-item active">
                        WhatsApp
                    </div>
                    <div class="contact__top-item">
                        Viber
                    </div>
                    <div class="contact__top-item">
                        Telegram
                    </div>
                </div>

                <input type="hidden" name="contact_type" value="WhatsApp">
                <div class="contact__form-phone input-wrapper">
                    <span class="text">
                        {{__('Номер телефона')}}
                    </span>
                    <input class="selector-list-phone" id="phone" name="phone">
                </div>
                <label class="contact__form-politic" for="contact__form_politic_on_index_page">
                    <input class="contact__form-politic-checkbox contact__form-checkbox" type="checkbox"
                           id="contact__form_politic_on_index_pagee" checked>
                    <div class="contact__form-custom-checkbox one_check"></div>
                    <div class="contact__form-checkbox-text">
                        {{__('Ознакомлен с')}} <span>{{__('политикой конфеденциальности')}} </span>
                    </div>
                </label>
                <label class="contact__form-data" for="contact__form_data_on_index_page">
                    <input class="contact__form-data-checkbox contact__form-checkbox" type="checkbox"
                           id="contact__form_data_on_index_page">
                    <div class="contact__form-custom-checkbox two_check"></div>
                    <div class="contact__form-checkbox-text">
                        {{__('Согласен на обработку')}} <span>{{__('персональных данных')}} </span>
                    </div>
                </label>
                <div class="contact__form-footer">
                    <button type="submit" style="width: 100%;" class="contact__form-footer-button">
                        {{__('Связаться')}}
                    </button>
                </div>
            </div>
        </section>
        <input type="hidden" name="contact__phone-title" value="Россия (Russia)">
    </form> -->
    <!-- <script>
        $('.contact__top-item').click(function () {
            $("input[name='contact_type']").val($(this).html())
        })
        $('.contact__phone-title').click(function () {
            $("input[name='contact__phone-title']").val($(this).html())
        });
        $('.contact__form-phone-input').on('keydown', function () {
            $('.contact__form-phone').css('border', '2px solid #508cfa')
        });
        $('#index_page_form').submit(function (event) {
            event.preventDefault()
            let phone = $("input[name='phone']").val();
            let country = $(this).find('.iti__selected-flag').attr('title')
            let message = $("input[name='contact_type']").val();
            let phone_val = false;

            let countryCode = $(this).find('.iti__selected-dial-code').html()

            const regex = /(\+\d+)/;
            const matches = countryCode.match(regex);

            if (matches && matches.length > 0) {
                countryCode = matches[0];
                phone = countryCode + phone
                } else {
                countryCode =  ''
            }

            const placeHolder = this.querySelector('.selector-list-phone').getAttribute('placeholder')

            if (phone.length <=5) {
                $('.contact__form-phone').css('border', '2px solid red')
            } else {
                phone_val = true;
            }
            let check_one = false;
            if ($(this).find('.contact__form-politic-checkbox').not(':checked').length) {
                $('.one_check').css('border', '2px solid red')
            } else {
                check_one = true;
            }
            let check_two = false;
            if ($(this).find('.contact__form-data-checkbox').not(':checked').length) {
                $('.two_check').css('border', '2px solid red')
            } else {
                check_two = true;
            }
            if (check_two == true && check_one == true && phone_val == true) {
                let formData = new FormData();
                formData.append('phone', phone);
                formData.append('country', country);
                formData.append('message', message);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('send_request') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // Handle the response from the server
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2500
                        })
                        $("input[name='phone']").val('')
                        $('.two_check').css('border', '2px solid #508cfa')
                        $('.one_check').css('border', '2px solid #508cfa')
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        })
    </script> -->
    <!-- <div class="popup popup-modal">
        <div class="popup__body">
            <form class="popup__content">
                <div class="popup__subtitle">
                    {{__('ФИО')}}
                </div>
                <div class="field">
                    <input type="text" value="" placeholder="">
                </div>
                <div class="popup__subtitle">
                    {{__('Номер телефона')}}
                </div>
                <div class="contact__form-phone input-wrapper">
                    <input class="selector-list-phone" id="phone" name="phone">
                </div>
                <button class="btn">
                    {{ __('Отправить заявку') }}
                </button>
                <div class="popup-close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <script xmlns=""/>
                        <path d="M1 1L13 13" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M13 1L1 13" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                </а>
        </div>
    </div> -->
@include('project.includes.modal-object')
@endsection

@section('footer')
    @include('project.includes.footer')
@endsection


<!-- @section('scripts')
    <script>
        function changerActive(list) {
            for (let i = 0; i < list.length; i++) {
                list[i].classList.remove('active')
            }
            list = 0
        }

        // список номеров телефонов
        if (document.querySelectorAll('.field-phone').length) {
            const fieldPhone = document.querySelectorAll('.field-phone')
            let phonesBtn
            fieldPhone.forEach(element => {
                phonesBtn = element.querySelectorAll('.contact__form-phone-country')

            });
            phonesBtn.forEach(btn => {
                btn.addEventListener('click', function () {
                    const paranetField = btn.closest('.field-phone')
                    const dropdownList = paranetField.querySelector('.contact__phone-dropdown')

                    this.classList.toggle('active')
                    dropdownList.classList.toggle('active')
                })
            });
        }
        //Popup close
        document.addEventListener("click", function (event) {
                event = event || window.event;
                let target = event.target

                if (target.classList.contains('popup')) {
                    target.classList.remove('active')
                    //   bodyScrollLock.enableBodyScroll(target);
                }

                //закрытие меню кликом по темной области
                if (target.classList.contains('header-m')) {
                    target.classList.remove('active')
                    //   bodyScrollLock.enableBodyScroll(target);
                    for (let i = 0; i < headerMenuBtn.length; i++) {
                        headerMenuBtn[i].classList.toggle('open')
                    }
                }
            }
        )

        // let popupClose = document.querySelectorAll('.popup-close')
        for (let i = 0; i < popupClose.length; i++) {
            popupClose[i].addEventListener("click",
                function () {
                    let popup = popupClose[i].closest('.popup')
                    if (popup.classList.contains('filter')) {
                        popup.classList.remove('popup')
                    } else {
                        popup.classList.remove('active')
                    }
                    // bodyScrollLock.enableBodyScroll(popup);
                })
        }


        // добавление выбранного кода странцы
        if (document.querySelectorAll('.contact__phone-list').length) {
            const contactPhoneList = document.querySelectorAll('.contact__phone-list')

            contactPhoneList.forEach(list => {
                list.addEventListener('click', function (e) {
                    const target = e.target
                    const parentBlock = target.closest('.selection-phone')
                    const phoneFlag = parentBlock.querySelector('.contact__form-country-item-img').querySelector('img')
                    const input = parentBlock.querySelector('.contact__phone-input')
                    const contactCountry = parentBlock.querySelector('.contact__form-phone-country')
                    const dropdown = parentBlock.querySelector('.contact__phone-dropdown')

                    if (target.classList.contains('contact__phone-list-item') || target.closest('.contact__phone-list-item')) {

                        const selectedPhoneBlock = target.closest('.contact__phone-list-item')
                        const img = selectedPhoneBlock.querySelector('.contact__phone-img').querySelector('img').getAttribute('src')
                        mask = selectedPhoneBlock.getAttribute('mask')
                        // const code = selectedPhoneBlock.querySelector('.contact__phone-title').querySelector('span').innerHTML
                        phoneFlag.setAttribute('src', img)
                        input.setAttribute('data-phone-pattern', mask)
                        input.value = ''
                        contactCountry.classList.remove('active')
                        dropdown.classList.remove('active')
                    }
                })
            });
        }

        //маска номера телефона
        document.addEventListener("DOMContentLoaded", function () {
            var eventCalllback = function (e) {
                var el = e.target,
                    clearVal = el.dataset.phoneClear,
                    pattern = el.dataset.phonePattern,
                    matrix_def = "+7(___) ___-__-__",
                    matrix = pattern ? pattern : matrix_def,
                    i = 0,
                    def = matrix.replace(/\D/g, ""),
                    val = e.target.value.replace(/\D/g, "");
                if (clearVal !== 'false' && e.type === 'blur') {
                    if (val.length < matrix.match(/([\_\d])/g).length) {
                        e.target.value = '';
                        return;
                    }
                }
                if (def.length >= val.length) val = def;
                e.target.value = matrix.replace(/./g, function (a) {
                    return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
                });
            }
            var phone_inputs = document.querySelectorAll('[data-phone-pattern]');
            for (let elem of phone_inputs) {
                for (let ev of ['input', 'blur', 'focus']) {
                    elem.addEventListener(ev, eventCalllback);
                }
            }
        });

        getData('{{ app()->getLocale() }}');
    </script>
    <script src="{{asset('project/js/tel-input.js')}}"></script>
    <script src="{{asset('project/js/filter.js')}}"></script>
    <script>
    //отправить запрос с фильтром по кнопке найти
    if(document.querySelectorAll('.btn-filter-houses').length) {
        const btnFilterHouses = document.querySelector('.btn-filter-houses')
        btnFilterHouses.addEventListener('click', async function() {
            const currentURL = window.location.href;
            window.location.href = currentURL;
            history.pushState(null, null, currentURL);
        })
    }
    </script>
@endsection -->


