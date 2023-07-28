@if(isset($phone))
    Ном.Телефона ` {{$phone}}
    @endif
<br>

@if(isset($details['fio']))
    ФИО ` {{$details['fio']}}
@endif
<br>
@if(isset($details['country']))
    Страна номера ` {{$details['country']}}
@endif
<br>
@if(isset($details['product_id']))
    ID  обьекта` {{$details['product_id']}}
@endif
<br>
@if(isset($details['messanger']))
    Месенджер` {{$details['messanger']}}
@endif

