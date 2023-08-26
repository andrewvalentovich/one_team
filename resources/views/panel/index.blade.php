@extends('panel.layouts.default')
@section('title')
Главный экран
    @endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

            </div>



            <div class="row ">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h2 style="display: flex; justify-content: center; align-items: center" class="card-title">Добро пожаловать в админ панель OneTime</h2>
                           <div  style="display: flex; justify-content: center; align-items: center" >
                            <img  style="max-width: 500px; width: 100%;" src="{{asset('Лого (1).png')}}" alt="">
                           </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->






        <!-- partial -->
    </div>
    @endsection
