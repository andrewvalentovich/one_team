@extends('panel.layouts.default')
@section('title')
    {{__("Редактирование параметров лендинга")}}
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
                    <h4 class="card-title">{{__("Редактирование параметров лендинга")}}</h4>
                    <form class="forms-sample" action="{{ route('panel.landings.update', $landing->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="col-md-6 pl-0 py-3" bis_skin_checked="1">
                            <div class="form-group" bis_skin_checked="1">
                                <label for="subdomain">{{ __('Поддомен') }}</label>
                                <input name="subdomain" type="text" class="form-control" id="subdomain" value="{{ $landing->subdomain }}" placeholder="{{ __('Поддомен') }}">
                            </div>
                            @error('subdomain')
                                <label class="text-danger font-weight-normal" for="subdomain">{{ $message }}</label>
                            @enderror

                            <div class="form-group" bis_skin_checked="1">
                                <label for="domain">{{ __('Домен') }}</label>
                                <input name="domain" type="text" class="form-control" id="domain" value="{{ $landing->domain }}" placeholder="{{ __('Домен') }}">
                            </div>
                            @error('domain')
                                <label class="text-danger font-weight-normal" for="domain">{{ $message }}</label>
                            @enderror

                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-12 col-form-label">{{ __('Шаблон сайта') }}</label>
                                <div class="col-sm-12" bis_skin_checked="1">
                                    <select class="form-control" name="template_id" style="color: #e2e8f0">
                                        @foreach($templates as $template)
                                            <option {{ $template->id === $landing->template->id ? "selected" : "" }} value="{{ $template->id }}">{{ $template->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('template_id')
                                    <label class="text-danger font-weight-normal" for="template_id">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-inverse-success btn-fw">{{ __('Редактировать') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
