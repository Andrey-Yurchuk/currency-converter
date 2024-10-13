<?php

use App\Services\CurrencyService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/**
 * The command that displays an inspiring quote
 *
 * @return void
 */
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

/**
 * The command that manually updates currency rates
 *
 * @return void
 */
Artisan::command('currency:update-rates', function () {
    $currencyService = app(CurrencyService::class);
    $currencyService->updateRates();
    $this->info('Currency rates updated successfully');
})->describe('Manually update currency rates');


