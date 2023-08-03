@extends('admin.layouts.default')
@section('title')
    {{__("Просмотр валютной пары")}}
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
                    <h4 class="card-title">Просмотр валютной пары</h4>
                    <form class="forms-sample" action="{{route('admin.exchange_rates.destroy', $exchange_rate->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('delete')

                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Прямая</label>
                                <div class="col-sm-3" bis_skin_checked="1">
                                    <select class="form-control"  name="direct_val" style="color: #e2e8f0">
                                            <option selected value="{{$exchange_rate->direct_val}}">{{$exchange_rate->direct_val}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group row" bis_skin_checked="1">
                                <label class="col-sm-3 col-form-label">Относительная</label>
                                <div class="col-sm-3" bis_skin_checked="1">
                                    <select class="form-control"  name="relative_val" style="color: #e2e8f0">
                                        <option selected value="{{$exchange_rate->relative_val}}">{{$exchange_rate->relative_val}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" bis_skin_checked="1">
                            <div class="form-group" bis_skin_checked="1">
                                <label for="buy_val">Покупка</label>
                                <input name="buy_val" type="text" class="form-control" id="buy_val" value="{{ $exchange_rate->buy_val }}" placeholder="Покупка">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="sell_val">Продажа</label>
                                <input name="sell_val" type="text" class="form-control" id="sell_val" value="{{ $exchange_rate->sell_val }}" placeholder="Продажа">
                            </div>
                        </div>

                        <a href="{{ route('admin.exchange_rates.edit', $exchange_rate->id) }}" type="submit" class="btn btn-inverse-success btn-fw">Редактировать</a>
                        <button type="submit" class="btn btn-inverse-danger btn-fw">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
