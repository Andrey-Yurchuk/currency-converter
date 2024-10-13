<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * Convert currency from one type to another
 *
 * @param Request $request
 */
class CurrencyConversionController extends Controller
{
    public function __construct(protected CurrencyService $currencyService)
    {
    }

    /**
     * The method accepts data for currency conversion from one to another
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function convert(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'amount' => 'required|integer|min:0',
                'from' => 'required|string',
                'to' => 'required|string',
            ]);

            $amount = $request->input('amount');
            $fromCurrency = $request->input('from');
            $toCurrency = $request->input('to');

            $convertedAmount = $this->currencyService->convert($amount, $fromCurrency, $toCurrency);

            return response()->json([
                'success' => true,
                'data' => [
                    'amount' => $amount,
                    'from' => $fromCurrency,
                    'to' => $toCurrency,
                    'converted_amount' => $convertedAmount
                ]
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->validator->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
