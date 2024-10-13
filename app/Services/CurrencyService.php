<?php

namespace App\Services;

use App\Models\Currency;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class CurrencyService
 *
 * Handles currency rate updates and conversions
 */
class CurrencyService
{
    public function __construct(protected Client $client)
    {
    }

    /**
     * Updates currency rates from the external API
     *
     * @return void
     * @throws GuzzleException
     */
    public function updateRates(): void
    {
        $apiKey = config('services.currencyapi.key');
        $url = 'https://api.freecurrencyapi.com/v1/latest?apikey=' . $apiKey;

        $response = $this->client->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        if (isset($data['data'])) {
            foreach ($data['data'] as $currencyCode => $rate) {
                Currency::updateOrCreate(
                    ['currency_code' => $currencyCode],
                    ['rate' => $rate]
                );
            }
        }
    }

    /**
     * Converts an amount from one currency to another
     *
     * @param float|int $amount The amount to convert
     * @param string $from The currency code to convert from
     * @param string $to The currency code to convert to
     * @return float|int The converted amount
     * @throws Exception If the currency is not found
     */
    public function convert(int $amount, string $from, string $to): float|int
    {
        $fromRate = Currency::where('currency_code', $from)->value('rate');
        $toRate = Currency::where('currency_code', $to)->value('rate');

        if (!$fromRate || !$toRate) {
            throw new Exception('Currency not found');
        }

        return $amount * ($toRate / $fromRate);
    }
}
