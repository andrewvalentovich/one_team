@extends('admin.layouts.default')
@section('title')
    {{__("Добавление валютной пары")}}
@endsection

<style>
    input{
        color: white !important;
    }
    textarea{
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
                    <h4 class="card-title">Добавление языка</h4>
                    <form class="forms-sample" action="{{route('admin.locales.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group" bis_skin_checked="1">
                            <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%; display: none;" src="" alt="" id="blahas">
                            <div class="mt-2">
                                <label style="width: 200px" for="file-logos" class="custom-file-upload btn btn-outline-success">
                                    Выберите флаг
                                </label>
                                <input accept="image/*" style="display: none" name="icon" id="file-logos" class="btn btn-outline-success" type="file">
                            </div>
                            @error('icon')
                                <label class="text-danger font-weight-normal" for="icon">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-4 row" bis_skin_checked="1">
                            <div class="form-group" bis_skin_checked="1">
                                <label for="code">Код</label>
                                <input name="code" type="text" class="form-control" id="code" placeholder="ru">
                            </div>
                            @error('code')
                                <label class="text-danger font-weight-normal" for="code">{{ $message }}</label>
                            @enderror
                        </div>

                        <button  type="submit" class="btn btn-inverse-success btn-fw">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
