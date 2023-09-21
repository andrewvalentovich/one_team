@extends('admin.layouts.default')
@section('title')
    {{__("Редактирование валютной пары")}}
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
                    <h4 class="card-title">Редактирование валютной пары</h4>
                    <form class="forms-sample" action="{{ route('admin.exchange_rates.update', $exchange_rate->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Прямая</label>
                                <div class="col-sm-3" bis_skin_checked="1">
                                    <select class="form-control" name="direct" style="color: #e2e8f0">
{{--                                        <option value="{{$exchange_rate->direct}}">{{$exchange_rate->direct}}</option>--}}
                                        @foreach($exchange_names as $name)
                                            <option {{ ($exchange_rate->direct == $name) ? "selected" : "" }} value="{{$name}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('direct')
                                <label class="text-danger font-weight-normal" for="direct">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Относительная</label>
                                <div class="col-sm-3" bis_skin_checked="1">
                                    <select class="form-control"  name="relative" style="color: #e2e8f0">
{{--                                        <option value="{{$exchange_rate->relative}}">{{$exchange_rate->relative}}</option>--}}
                                        @foreach($exchange_names as $name)
                                            <option {{ ($exchange_rate->relative == $name) ? "selected" : "" }} value="{{$name}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('relative')
                                <label class="text-danger font-weight-normal" for="relative">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group" bis_skin_checked="1">
                                <label for="value">Значение</label>
                                <input name="value" type="text" class="form-control" id="value" value="{{ $exchange_rate->value }}" placeholder="Значение">
                            </div>
                            @error('value')
                                <label class="text-danger font-weight-normal" for="value">{{ $message }}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-inverse-success btn-fw">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
