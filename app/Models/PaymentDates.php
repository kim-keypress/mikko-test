<?php

namespace App\Models;

use Carbon\Carbon;

class PaymentDates
{
    public int $month;
    public int $year;
    public Carbon $salary;
    public Carbon $bonus;

    public function __construct(int $month, int $year, Carbon $salary, Carbon $bonus)
    {
        $this->month = $month;
        $this->salary = $salary;
        $this->bonus = $bonus;
        $this->year = $year;
    }
}
