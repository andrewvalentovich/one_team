@extends('admin.layouts.default')
@section('title')
    Настройки
@endsection

<style>
    input{
        color: white !important;
    }
    .swal2-container.swal2-center>.swal2-popup {
        background: #0f1116 !important;

    }
    /*.swal2-styled.swal2-confirm{*/
    /*    background-color: #a5dc86 !important;*/
    /*    border: none !important;*/
    /*}*/
</style>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

    @error('newpassword')
    <script>
        var error = "<?php echo $message ?>";
        Swal.fire({
            icon: 'error',
            title: error,
            showConfirmButton: false,
            timer: 5000,
        });
    </script>
    @enderror
    @error('oldpassword')
    <script>
        var error = "<?php echo $message ?>";
        Swal.fire({
            icon: 'error',
            title: error,
            showConfirmButton: false,
            timer: 5000,
        });
    </script>
    @enderror
    @if(session('succses'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Вы удачно изменили пароль',
                showConfirmButton: false,
                timer: 5000,
            });
        </script>
    @endif
    @if(session('nopassword'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Неправильный старый пароль',
                showConfirmButton: false,
                timer: 5000,
            });
        </script>
    @endif

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

            </div>



            <div class="row ">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            {{--                            @error('oldpassword')--}}
                            {{--                            <div class="alert alert-danger">{{ $message }}</div>--}}
                            {{--                            @enderror--}}

                        </div>
                        <div class="card-body">

                            <div style="display: flex ; width: 100%; justify-content: center">

                                <form action="{{route('updatePassword')}}" method="post" style=" width: 100%;">

                                    <h1 style="display: flex; justify-content: center">Редактирование пароля</h1>
                                    <br><br>
                                    @csrf                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Старый пароль</label>
                                        <input value="{{ old('oldpassword') }}" name="oldpassword" type="password" class="form-control input1" id="exampleInputPassword1" placeholder="Пароль">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Новый пароль</label>
                                        <input  name="newpassword" type="password" class="form-control input1" id="exampleInputPassword1" placeholder="Пароль">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Повторите новый пароль</label>
                                        <input  name="newpassword_confirmation" type="password" class="input1 form-control" id="exampleInputPassword1" placeholder="Пароль">
                                    </div>


                                    <button type="submit" class="btn btn-success">Сохранить изменения</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection