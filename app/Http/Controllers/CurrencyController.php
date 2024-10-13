<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use App\Models\Currency;
use Illuminate\View\View;

/**
 * This controller is responsible for displaying the list of currencies and managing currency updates
 *
 * @param CurrencyService $currencyService
 */
class CurrencyController extends Controller
{
    public function __construct(protected CurrencyService $currencyService)
    {
    }

    /**
     * Display the currencies page
     *
     * Retrieves all currencies from the database and passes them to the view
     *
     * @return View
     */
    public function index(): View
    {
        $currencies = Currency::all();

        return view('admin.currencies.index', compact('currencies'));
    }
}

