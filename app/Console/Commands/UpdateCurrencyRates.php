<?php

namespace App\Console\Commands;

use App\Services\CurrencyService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

/**
 * The class containing methods with commands for updating exchange rates
 */
class UpdateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command
     *
     * @var string
     */
    protected $signature = 'currency:update-rates';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Update currency rates from freecurrencyapi.com';

    public function __construct(protected CurrencyService $currencyService)
    {
        parent::__construct();
    }

    /**
     * Updates the exchange rates and displays a successful completion message
     *
     * @return void
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $this->currencyService->updateRates();
        $this->info('Currency rates updated successfully');
    }
}
