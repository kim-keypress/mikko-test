@extends('layout')

@section('content')
    <h1>Payment dates for the year {{ $year }}</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Month</th>
                <th>Salary</th>
                <th>Bonus</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paymentDatesArray as $paymentDates)
            <tr>
                <td>{{ $paymentDates->month }}</td>
                <td>{{ $paymentDates->salary->format('Y-m-d') }}</td>
                <td>{{ $paymentDates->bonus->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
