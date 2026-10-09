<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Model;

class ClientInvoice extends Model
{
    protected $connection = 'mysql_staging';

    protected $table = 'ClientInvoices';
    protected $primaryKey = 'ClientInvoiceID';
    public $timestamps = false;

    protected $fillable = [
        'ExternalReference',
        'PreviousInvoiceID',
        'InvoiceSeriesID',
        'AccountStatus',
        'StaffFK',
        'BrokerFK',
        'TaxChargeFK',
        'ETrade',
        'ExchangeRate',
        'OpeningCashBalance',
        'OpeningTradeBalance',
        'CashFeesThisPeriod',
        'TradeFeesThisPeriod',
        'CashChargesThisPeriod',
        'TradeChargesThisPeriod',
        'CashPaymentsThisPeriod',
        'TotalPaymentsThisPeriod',
        'ClosingCashBalance',
        'ClosingTradeBalance',
        'OpeningCashFees',
        'OpeningCashCharges',
        'ClosingCashFees',
        'ClosingCashCharges',
        'YTDSales',
        'YTDPurchases',
        'YTDNumberSales',
        'YTDNumberPurchases',
        'SeriesSales',
        'SeriesPurchases',
        'SeriesNumberSales',
        'SeriesNumberPurchases',
        'ClosingCreditLimit',
        'CashTaxThisPeriod',
        'TradeTaxThisPeriod',
        'DateCreated',
        'DateModified',
        'CreatedBy',
        'ModifiedBy'
    ];
}
