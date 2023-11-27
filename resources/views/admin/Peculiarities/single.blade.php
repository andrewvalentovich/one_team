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
                    <h4 class="card-title">Редактирование {{$string}}</h4>
                    <form class="forms-sample" action="{{route('update_peculiarities')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group pt-5 pb-5" bis_skin_checked="1">
                            <label for="exampleInputName1">Отображение в url (slug)</label>
                            <input value="{{ $get->slug }}" name="slug" type="text" class="form-control" id="exampleInputName1" placeholder="name-type">
                            @error('slug')
                                <label class="text-danger font-weight-normal" for="slug">{{ $message }}</label>
                            @enderror
                        </div>

                        @foreach($locales as $locale)
                            <div class="form-group @if($loop->last) pb-5 @endif" bis_skin_checked="1">
                                <label for="exampleInputName1">Название {{ '(' . $locale->code . ')' }}</label>
                                <input value="{{ $get->getTranslatedName($locale->code) }}" name="name[{{ $locale->code }}]" type="text" class="form-control" id="exampleInputName1" placeholder="Название {{ '(' . $locale->code . ')' }}" >
                            </div>
                        @endforeach

                        <input type="hidden" name="id" value="{{$get->id}}">

                        <div style="display: flex; justify-content: space-between">
                            <button type="submit" class="btn btn-inverse-success btn-fw">Сохранить</button>
                            <a href="{{route('delete_peculiarities', $get->id)}}" class="btn btn-inverse-danger btn-fw">Удалить</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
