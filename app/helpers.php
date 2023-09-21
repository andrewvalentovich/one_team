<?php

function numbers_graduation($n) {
    $titles = array('объявление', 'объявления', 'объявлений');
    $cases = array(2, 0, 1, 1, 1, 2);
    return $n." ".$titles[($n % 100 > 4 && $n % 100 < 20) ? 2 : $cases[min($n % 10, 5)]];
}

function get_exchange_rate_symbol($code) {
    $exchange_rate = [
        "RUB" => "₽",
        "EUR" => "€",
        "USD" => "$",
        "TRY" => "₺"
    ];

    return $exchange_rate[($code === "") ? "EUR" : $code];
}

function cdn_asset($path, $secure = null) {
    return app('url')->assetFrom(config('app.panel_subdomain'), $path, $secure);
}
