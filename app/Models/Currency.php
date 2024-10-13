<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 *
 * Represents a currency with its code and rate
 */
class Currency extends Model
{
    use HasFactory;

    /**
     * The name of the table associated with the model
     *
     * @var string
     */
    protected $table = 'currencies';

    /**
     * The columns in the table 'currencies'
     *
     * @var array
     */
    protected $fillable = ['currency_code', 'rate'];
}
