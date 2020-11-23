<?php

namespace App\Services;

use App\Models\PaymentDates;
use App\Services\Interfaces\IPaymentDateCalculator;
use Carbon\Carbon;

class PaymentDateCalculator implements IPaymentDateCalculator
{
    /**
     * {@inheritDoc}
     */
    public function getPaymentDatesForYear(int $year): array
    {
        $paymentDates = [];

        foreach (range(1,12) as $month) {
            $paymentDates[$month] = $this->getPaymentDatesForMonth($month, $year);
        }

        return $paymentDates;
    }

    /**
     * @param int $year
     * @param int $month
     *
     * @return PaymentDates
     */
    protected function getPaymentDatesForMonth(int $month, int $year): PaymentDates
    {
        $carbon = Carbon::minValue();
        $carbon->setMonth($month);
        $carbon->setYear($year);

        $salary = $this->getSalaryDate($carbon);
        $bonus = $this->getBonusDate($carbon);

        return new PaymentDates($month, $year, $salary, $bonus);
    }

    /**
     * @param Carbon $carbon
     *
     * @return Carbon
     */
    protected function getSalaryDate(Carbon $carbon): Carbon
    {
        $payDay = $carbon->copy()->endOfMonth()->startOfDay();

        if ($payDay->isWeekend()) {
            $payDay = Carbon::createFromTimestamp(strtotime('last Friday', $payDay->getTimestamp()));
        }

        return $payDay;
    }

    /**
     * @param Carbon $carbon
     *
     * @return Carbon
     */
    protected function getBonusDate(Carbon $carbon): Carbon
    {
        $payDay = $carbon->copy()->setDay(15)->addMonth();

        if ($payDay->isWeekend()) {
            $payDay = Carbon::createFromTimestamp(strtotime('next Wednesday', $payDay->getTimestamp()));
        }

        return $payDay;
    }
}
