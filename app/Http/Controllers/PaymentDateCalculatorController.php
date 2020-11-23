<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IPaymentDateCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PaymentDateCalculatorController extends Controller
{
    public function index(Request $request, IPaymentDateCalculator $calculator)
    {
        $request->validate([
            'year' => 'required|integer'
        ]);

        $year = $request->get('year') ?? date('Y');

        return view('calculator', [
            'year' => $year,
            'paymentDatesArray' => $calculator->getPaymentDatesForYear($year)
        ]);
    }

    public function download(Request $request, IPaymentDateCalculator $calculator)
    {
        $request->validate([
            'year' => 'required|integer'
        ]);

        $year = $request->post('year');

        $paymentDatesArray = $calculator->getPaymentDatesForYear($year);

        return Response::streamDownload(
            function () use ($paymentDatesArray) {
                $outputBuffer = fopen('php://output', 'w');
                fputcsv($outputBuffer, ['month', 'salary', 'bonus'], ';');

                foreach($paymentDatesArray as $paymentDates) {
                    fputcsv(
                        $outputBuffer,
                        [
                            $paymentDates->month,
                            $paymentDates->salary->format('Y-m-d'),
                            $paymentDates->bonus->format('Y-m-d')
                        ],
                        ';'
                    );
                }

                fclose($outputBuffer);
            },
            "payment-dates-$year.csv"
        );
    }
}
