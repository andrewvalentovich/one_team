@extends('admin.layouts.default')
@section('title')
    Страны
@endsection

<style>
    input{
        color: white !important;
    }
</style>



@section('content')
    <div class="content-wrapper" bis_skin_checked="1">
        <br><br><br>
        <div class="col-12 grid-margin stretch-card" bis_skin_checked="1">


            <div class="card" bis_skin_checked="1" style="min-height: 1000px">

                <div class="card-body" bis_skin_checked="1">
                    @if(Session::has('true'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('true') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(Session::has('false'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ Session::get('false') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h4 class="card-title">Сегодняшний курс</h4>
                    <form class="forms-sample" action="{{route('update_value')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Курс евро к Рублю</label>
                            <input value="{{$get->rub}}" name="rub" type="number" class="form-control" id="exampleInputName1" placeholder="Курс евро к Рублю" required >
                        </div>
                        <input type="hidden" value="{{$get->id}}" name="id">
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Курс евро к Лире</label>
                            <input value="{{$get->lira}}" name="lira" type="number" class="form-control" id="exampleInputName1" placeholder="Курс евро к Лире" required >
                        </div>

                        <button type="submit" class="btn btn-inverse-success btn-fw">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection