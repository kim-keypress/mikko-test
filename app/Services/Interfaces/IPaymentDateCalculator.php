<?php

namespace App\Services\Interfaces;

use App\Models\PaymentDates;

interface IPaymentDateCalculator
{
    /**
     * Get the payment dates for a year keyed by month
     *
     * @param int $year
     *
     * @return PaymentDates[] [month => PaymentDates]
     */
    public function getPaymentDatesForYear(int $year): array;
}
