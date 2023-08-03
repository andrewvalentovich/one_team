<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- plugins:css -->

    <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('admin/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/dist/image-uploader.min.css')}} ">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




    <link rel="stylesheet" href="{{asset('admin/AdminSelect/css/style.css')}} ">
    <link rel="stylesheet" href="{{asset('admin/AdminSelect/css/materialdesignicons.min.css')}} ">
    <link rel="stylesheet" href="{{asset('admin/AdminSelect/css/select2-bootstrap.min.css')}} ">
    <link rel="stylesheet" href="{{asset('admin/AdminSelect/css/select2.min.css')}} ">
    <link rel="stylesheet" href="{{asset('admin/AdminSelect/css/vendor.bundle.base.css')}} ">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700|Montserrat:300,400,500,600,700|Source+Code+Pro&display=swap"
          rel="stylesheet">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('Лого.png')}}"/>


{{--    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}
    <script src="{{asset('editor/tinymce/js/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>

    <script type="text/javascript">
        tinymce.init({
            selector: '#mytextarea',
            plugins: 'a_tinymce_plugin',
            a_plugin_option: true,
            a_configuration_option: 400,
            plugins: 'advlist link image lists',
            plugins: 'code',
            toolbar: 'a11ycheck|language | undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent|code'
        });
        tinymce.init({
            selector: '#mytextarea_en',
            plugins: 'a_tinymce_plugin',
            a_plugin_option: true,
            a_configuration_option: 400,
            plugins: 'advlist link image lists',
            plugins: 'code',
            toolbar: 'a11ycheck|language | undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent|code'
        });
        tinymce.init({
            selector: '#mytextarea_tr',
            plugins: 'a_tinymce_plugin',
            a_plugin_option: true,
            a_configuration_option: 400,
            plugins: 'advlist link image lists',
            plugins: 'code',
            toolbar: 'a11ycheck|language | undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent|code'
        });
    </script>
</head>
<body>

@if(auth()->user())

    @if(auth()->user()->role_id == 1)

        <div class="container-scroller">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">

                    <a class=" sidebar-brand brand-logo" style="color: white; text-decoration: none;" href="{{route('HomePage')}}">
                        <h3 style="color: #2f5687 !important">OneTime</h3>
                    </a>

                </div>
                <ul class="nav">
                    <li class="nav-item profile">
                        <div class="profile-desc">
                            <div class="profile-pic">
                                <div class="count-indicator">

                                </div>
                                <div class="profile-name">
                                    <h5 class="mb-0 font-weight-normal">{{auth()->user()->name}}</h5>
                                    @if(auth()->user()->role_id == 1)
                                        <span>Администратор </span>
                                    @else
                                    @endif
                                </div>
                            </div>
                            {{--                    <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>--}}

                        </div>
                    </li>
                    <li class="nav-item nav-category">
                        <span class="nav-link">Навигация</span>
                    </li>


                    <li class="nav-item menu-items">
                        <a class="nav-link" href="{{ route('admin.exchange_rates.index') }}">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
                            <span class="menu-title">Курс валют</span>
                        </a>
                    </li>

                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic10" aria-expanded="false" aria-controls="ui-basic10">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
                            <span class="menu-title">Заявки</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic10" bis_skin_checked="1">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('all_requests_new')}}">Новые Заявки</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('requests_old')}}">Просмотренные</a></li>
                                {{--                                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Города</a></li>--}}
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
                            <span class="menu-title">Страны и города</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic" bis_skin_checked="1">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('all_country')}}">Страны</a></li>
                                {{--                                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Города</a></li>--}}
                            </ul>
                        </div>
                    </li>



                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
                            <span class="menu-title">Параметры сайта</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic2" bis_skin_checked="1">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('peculiarities_peculiarities','Типы')}}">Типы</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('peculiarities_peculiarities','Спальни')}}">Спальни</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('peculiarities_peculiarities','Ванные')}}">Ванные</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('peculiarities_peculiarities','Гостиные')}}">Гостиные</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('peculiarities_peculiarities','Особенности')}}">Особенности</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('peculiarities_peculiarities','Вид')}}">Вид</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('peculiarities_peculiarities','До моря')}}">До моря
                                    </a></li>
                                {{--                                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Города</a></li>--}}
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
                            <span class="menu-title">Продажа</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <?php $category = \App\Models\Peculiarities::where('type','Типы')->get() ?>
                        <div class="collapse" id="ui-basic3" bis_skin_checked="1">
                            <ul class="nav flex-column sub-menu">
                                @foreach($category as $cat)
                                    <li class="nav-item"> <a class="nav-link" href="{{route('all_product',$cat->id)}}">{{$cat->name}}</a></li>
                                @endforeach
                                {{--                                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Города</a></li>--}}
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
                            <span class="menu-title">Аренда</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <?php $category = \App\Models\Peculiarities::where('type','Типы')->get() ?>
                        <div class="collapse" id="ui-basic4" bis_skin_checked="1">
                            <ul class="nav flex-column sub-menu">
                                @foreach($category as $cat)
                                    <li class="nav-item"> <a class="nav-link" href="{{route('rent_product',$cat->id)}}">{{$cat->name}}</a></li>
                                @endforeach
                                {{-- <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Города</a></li>--}}
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item menu-items">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
                            <span class="menu-title">Страницы</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic5" bis_skin_checked="1">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('invest_page')}}">Инвестиции</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('vng_page')}}">ВНЖ и Гражданство</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('rasrochka_page')}}">Рассрочка</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('contacts_page')}}">Контакты</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('all_company_select')}}">О компании</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('police')}}">Поль. сог. при исп. сай.</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('privice')}}">Пол. обр. пер. дан.</a></li>

                            </ul>
                        </div>
                    </li>

                </ul>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_navbar.html -->
                <nav class="navbar p-0 fixed-top d-flex flex-row">

                    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                            <span class="mdi mdi-menu"></span>
                        </button>

                        <ul class="navbar-nav navbar-nav-right">


                            <li class="nav-item dropdown border-left">

                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                     aria-labelledby="messageDropdown">
                                    <h6 class="p-3 mb-0">Messages</h6>
                                    <div class="dropdown-divider"></div>
                                    <a  class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="{{asset('images/faces/face4.jpg')}}" alt="image"
                                                 class="rounded-circle profile-pic">
                                        </div>
                                        <div class="preview-item-content">
                                            <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                                            <p class="text-muted mb-0"> 1 Minutes ago </p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="{{asset('images/faces/face2.jpg')}}" alt="image"
                                                 class="rounded-circle profile-pic">
                                        </div>
                                        <div class="preview-item-content">
                                            <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                                            <p class="text-muted mb-0"> 15 Minutes ago </p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="{{asset('images/faces/face3.jpg')}}" alt="image"
                                                 class="rounded-circle profile-pic">
                                        </div>
                                        <div class="preview-item-content">
                                            <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                                            <p class="text-muted mb-0"> 18 Minutes ago </p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <p class="p-3 mb-0 text-center">4 new messages</p>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                    <div class="navbar-profile">
                                        {{--                                <img class="img-xs rounded-circle" src="{{asset('images/faces/face15.jpg')}}" alt="">--}}
                                        <p class="mb-0 d-none d-sm-block navbar-profile-name">&nbsp;&nbsp;&nbsp;&nbsp;{{auth()->user()->name}}</p>
                                        <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                     aria-labelledby="profileDropdown">
                                    <h6 class="p-3 mb-0">Пофиль</h6>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{route('settingView')}}" class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-dark rounded-circle">
                                                <i class="mdi mdi-settings text-success"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <p class="preview-subject mb-1">Настройки</p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{route('logoutAdmin')}}" class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-dark rounded-circle">
                                                <i class="mdi mdi-logout text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <p class="preview-subject mb-1">  Выход </p>
                                        </div>

                                    </a>
                                    <div class="dropdown-divider"></div>

                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                                data-toggle="offcanvas">
                            <span class="mdi mdi-format-line-spacing"></span>
                        </button>
                    </div>
                </nav>
            @else

            @endif
            @else

            @endif

            <!-- partial -->
            @yield('content')
            <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>


        <!-- container-scroller -->
        <!-- plugins:js -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


        <script src="{{asset('admin/vendors/js/vendor.bundle.base.js')}}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{asset('admin/vendors/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('admin/vendors/progressbar.js/progressbar.min.js')}}"></script>
        <script src="{{asset('admin/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
        <script src="{{asset('admin/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script src="{{asset('admin/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{asset('admin/js/off-canvas.js')}}"></script>
        <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
        <script src="{{asset('admin/js/misc.js')}}"></script>
        <script src="{{asset('admin/js/settings.js')}}"></script>
        <script src="{{asset('admin/js/todolist.js')}}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{asset('admin/js/dashboard.js')}}"></script>
        {{--        <script src="{{asset('admin/js/message.js')}}"></script>--}}
        <script src="{{asset('admin/js/my_main.js')}}"></script>

        <script src="{{asset('admin/AdminSelect/js/select2.js')}}"></script>
        <script src="{{asset('admin/AdminSelect/js/select2.min.js')}}"></script>


        <script src="{{asset('admin/AdminSelect/js/typeahead.bundle.min.js')}}"></script>
        <script src="{{asset('admin/AdminSelect/js/typeahead.js')}}"></script>
        <script src="{{asset('admin//js/ManyPhoto.js')}}"></script>





        <!-- End custom js for this page -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{asset('admin/dist/image-uploader.min.js')}} "></script>

        <script src="{{asset('admin/js/Product.js')}}"></script>
        @yield('scripts')


</body>
</html>
