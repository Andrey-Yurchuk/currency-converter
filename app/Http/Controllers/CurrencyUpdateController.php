<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;

/**
 * Controller is responsible for updating currency exchange rates
 *
 * @param CurrencyService $currencyService
 */
class CurrencyUpdateController extends Controller
{
    public function __construct(protected CurrencyService $currencyService)
    {
    }

    /**
     * Update the currency exchange rates
     *
     * @return RedirectResponse
     * @throws GuzzleException
     */
    public function updateRates(): RedirectResponse
    {
        $this->currencyService->updateRates();

        return redirect()->route('admin.currencies.index')->with('success', 'Currency rates updated successfully!');
    }
}
