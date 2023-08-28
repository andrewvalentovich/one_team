@extends('panel.layouts.default')
@section('title')
    {{__("Редактирование параметров шаблона")}}
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
                    <h4 class="card-title">{{__("Редактирование параметров шаблона")}}</h4>
                    <form class="forms-sample" action="{{ route('panel.templates.update', $template->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="col-md-6 pl-0 py-3" bis_skin_checked="1">
                            <div class="form-group" bis_skin_checked="1">
                                <label for="name">{{ __('Название шаблона') }}</label>
                                <input name="name" type="text" class="form-control" value="{{ $template->name }}" id="name" placeholder="{{ __('Название шаблона') }}">
                            </div>
                            @error('name')
                                <label class="text-danger font-weight-normal" for="name">{{ $message }}</label>
                            @enderror

                            <div class="form-group" bis_skin_checked="1">
                                <label for="path">{{ __('Путь шаблона') }}</label>
                                <input name="path" type="text" class="form-control" value="{{ $template->path }}" id="path" placeholder="{{ __('Путь шаблона') }}">
                            </div>
                            @error('path')
                                <label class="text-danger font-weight-normal" for="path">{{ $message }}</label>
                            @enderror

                            <div class="form-group mb-1" bis_skin_checked="1">
                                <label for="token">{{ __('Токен') }}</label>
                                <input name="token" type="text" class="form-control" value="{{ $template->token }}" id="token" placeholder="{{ __('Токен') }}">
                                <label class="text-gray pt-1" for="token">{{ __('* будьте аккуратны: при изменении данного токена CRM может перестать считывать данные ') }}</label>
                            </div>
                            @error('token')
                                <label class="text-danger font-weight-normal" for="token">{{ $message }}</label>
                            @enderror
                            <a id="button_token_generate" class="btn btn-inverse-primary btn-fw">{{ __('Сгенирировать новый токен') }}</a>
                        </div>

                        <button type="submit" class="btn btn-inverse-success btn-fw mt-3">{{ __('Сохранить изменения') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var rand = function() {
            return Math.random().toString(36).substr(2); // remove `0.`
        };

        var token = function() {
            return rand() + rand(); // to make it longer
        };

        $('#token').val(token());

        $('#button_token_generate').bind('click', function (e) {
            e.preventDefault();
            var result = confirm("Вы уверены, что хотите изменить токен для данного шаблона? CRM-система может перестать принимать заявки");

            if(result) {
                $('#token').val(token());
            }

        })
    </script>
@endsection
