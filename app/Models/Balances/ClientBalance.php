<?php

namespace App\Models\Balances;

use Illuminate\Database\Eloquent\Model;

class ClientBalance extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientBalances';
    protected $primaryKey = 'ClientBalanceID';
    public $timestamps = false;

    protected $fillable = [
        'ClientID',
        'ExternalReference',
        'CashBalance',
        'TradeBalance',
        'Date',
        'NonApportionedValue',
        'OutstandingPurchases',
        'OutstandingSales',
        'PeriodSales',
        'PeriodPurchases',
        'TaxCashBalance',
        'TaxTradeBalance',
        'PeriodNumberSales',
        'PeriodNumberPurchases',
        'NumberOutstandingSales',
        'NumberOutstandingPurchases',
        'TradeTradingFees',
        'CashTradingFees',
        'DateCreated',
        'DateModified',
    ];
}
