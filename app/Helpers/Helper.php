<?php

use App\Models\Currency;
use App\Models\Settings;
use Illuminate\Support\Facades\Date;

function settings()
{
    $settings = cache_remember('settings', function () {
        return Settings::where('status', 1)->first();
    });
    return $settings;
}

function cache_remember(string $key, callable $callback, int $ttl = 1800): mixed
{
    return cache()->remember($key, env('CACHE_LIFETIME', $ttl), $callback);
}

function currency_format($amount, $type = "icon", $customIcon = null, $decimals = 2, $currency = null)
{
    $amount = number_format($amount, $decimals);
    $currency = $currency ?? default_currency();
    $symbol = $customIcon ?? $currency->symbol;

    if ($type == "icon" || $type == "symbol") {
        if ($currency->position == "right") {
            return $amount . $symbol;
        } else {
            return $symbol . $amount;
        }
    } else {
        if ($currency->position == "right") {
            return $amount . ' ' . $currency->code;
        } else {
            return $currency->code . ' ' . $amount;
        }
    }
}

function default_currency($key = null, Currency $currency = null): object|int|string
{
    $currency = $currency ?? cache_remember('default_currency', function () {
        $currency = Currency::whereIsDefault(1)->first();
        return $currency;
    });

    return $key ? $currency->$key : $currency;
}

function formatted_date(string $date = null, string $format = 'd M, Y'): ?string
{
    return !empty($date) ? Date::parse($date)->format($format) : null;
}
