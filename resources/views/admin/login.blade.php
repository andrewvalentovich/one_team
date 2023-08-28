@extends('admin.layouts.default')
<link rel="shortcut icon" href="{{asset('Лого.png')}}"/>
@section('title')
    Логин
@endsection

<style>
    input{
        color: white !important;
    }

</style>


    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div style="background-image: url({{asset('1651057817_37-vsegda-pomnim-com-p-samoe-krasivoe-more-foto-41.jpg')}})" class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto" style="  backdrop-filter: blur(3px) grayscale(0.4) !important;
  background-color: transparent !important;">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Вход</h3>
                            <form method="post" action="{{route('logined')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Эл.почта *</label>
                                    <input  name="email" type="text" class="form-control p_input"  value="{{old('login')}}" required style="background-color: transparent !important;">
                                    @if(session('login'))
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                        <script>
                                            $(document).ready(function () {

                                                setTimeout(function(){
                                                    document.getElementById('emailerror').style.display = 'none';
                                                }, 10000);
                                            });
                                        </script>
                                        <p id="emailerror" style=" color: #fe8765;">Неверная эл.почта</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Пароль *</label>
                                    <input name="password" type="password" class="form-control p_input" required style="background-color: transparent !important;">
                                    @if(session('password'))
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                        <script>
                                            $(document).ready(function () {

                                                setTimeout(function(){
                                                    document.getElementById('passworderror').style.display = 'none';
                                                }, 10000);
                                            });
                                        </script>
                                        <p id="passworderror" style=" color: #fe8765;">Неверный пароль</p>
                                    @endif
                                </div>


                                <div class="text-center">
                                    <button type="submit" style="    background: #41485885;" class="btn  btn-block enter-btn">Войти</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
