@extends('admin.layouts.default')
@section('title')
    Страны
@endsection




@section('content')
    <style>
        input{
            color: white !important;
        }
    </style>

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
                    <h4 class="card-title">Добавления страны</h4>
                    <form class="forms-sample" action="{{route('create_country')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Материк</label>
                                <div class="col-sm-9" bis_skin_checked="1">
                                    <select name="metric_id" class="form-control" style="color: white">
                                        @foreach($metric as $met)
                                        <option value="{{$met->id}}">{{$met->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Название страны</label>
                            <input name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Название страны">
                            @error('name')
                                <label class="text-danger font-weight-normal" for="name">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Гражданство на русском</label>
                            <textarea rows="5" class="form-control" name="div" placeholder="Гражданство на русском"></textarea>
                            @error('div')
                            <label class="text-danger font-weight-normal" for="div">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group" bis_skin_checked="1">
                            <label for="exampleInputName1">Обратный кредитный коэффициент (Например, 50% от цены на 24 мес = 48)</label>
                            <input name="inverse_credit_ratio" type="text" class="form-control" id="exampleInputName1" placeholder="Обратный кредитный коэффициент (Например, 48)">
                            @error('inverse_credit_ratio')
                            <label class="text-danger font-weight-normal" for="inverse_credit_ratio">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6" bis_skin_checked="1">
                                <label for="exampleInputName1">Широта</label>
                                <input name="lat" type="text" class="form-control" id="exampleInputName1" placeholder="Широта">
                                @error('lat')
                                <label class="text-danger font-weight-normal" for="name">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group col-md-6" bis_skin_checked="1">
                                <label for="exampleInputName1">Долгота</label>
                                <input name="long" type="text" class="form-control" id="exampleInputName1" placeholder="Долгота">
                                @error('long')
                                <label class="text-danger font-weight-normal" for="name">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div bis_skin_checked="1">
                            <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="" alt="">
                            <br>
                            <input name="photo" id="file-photo-city" type="file" style="opacity: 0">
                            <br>
                            <label style="width: 200px" for="file-photo-city" class="btn btn-outline-success">
                                Выберите фото
                            </label>
                            @error('photo')
                            <label class="text-danger font-weight-normal" for="photo">{{ $message }}</label>
                            @enderror
                        </div>

                        <div bis_skin_checked="1">
                            <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="" alt="">
                            <br>
                            <input name="flag" id="file-logo-city" type="file" style="opacity: 0">
                            <br>
                            <label style="width: 200px" for="file-logo-city" class="btn btn-outline-success">
                                Выберите флаг
                            </label>
                            @error('flag')
                            <label class="text-danger font-weight-normal" for="flag">{{ $message }}</label>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-inverse-success btn-fw mt-5">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
