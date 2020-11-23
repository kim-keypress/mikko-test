<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IPaymentDateCalculator;
use Illuminate\Http\Request;

class PaymentDateCalculatorController extends Controller
{
    public function index(Request $request, IPaymentDateCalculator $calculator)
    {
        $year = $request->get('year') ?? date('Y');

        return view('calculator', [
            'year' => $year,
            'paymentDatesArray' => $calculator->getPaymentDatesForYear($year)
        ]);
    }
}
