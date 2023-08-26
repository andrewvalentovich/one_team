@extends('panel.layouts.default')
@section('title')
    {{__("Просмотр лендинга")}}
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
                    <h4 class="card-title">{{ __('Просмотр лендинга') }}</h4>
                    <form class="forms-sample" action="{{ route('panel.landings.destroy', $landing->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('delete')

                        <div class="col-md-6 pl-0 py-3" bis_skin_checked="1">
                            <div class="form-group" bis_skin_checked="1">
                                <label for="subdomain">{{ __('Поддомен') }}</label>
                                <input name="subdomain" type="text" class="form-control" id="subdomain" value="{{ $landing->subdomain }}" placeholder="{{ __('Поддомен') }}">
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="domain">{{ __('Домен') }}</label>
                                <input name="domain" type="text" class="form-control" id="domain" value="{{ $landing->domain }}" placeholder="{{ __('Домен') }}">
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="template">{{ __('Название шаблона') }}</label>
                                <input name="template" type="text" class="form-control" id="template" value="{{ $landing->template->name }}" placeholder="{{ __('Название шаблона') }}">
                            </div>
                        </div>

                        <a href="{{ route('panel.landings.edit', $landing->id) }}" type="submit" class="btn btn-inverse-success btn-fw">{{ __('Редактировать') }}</a>
                        <button type="submit" class="btn btn-inverse-danger btn-fw">{{ __('Удалить') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
