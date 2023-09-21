@extends('admin.layouts.default')
@section('title')
    {{__("Добавление категорий для фото")}}
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
                    <h4 class="card-title">Добавления категории для фото</h4>
                    <form class="forms-sample" action="{{ route('admin.photo_categories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group" bis_skin_checked="1">
                                <label for="name">Название опции</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Название категории">
                            </div>
                            @error('name')
                                <label class="text-danger font-weight-normal" for="name">{{ $message }}</label>
                            @enderror
                        </div>

                        <button  type="submit" class="btn btn-inverse-success btn-fw">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
