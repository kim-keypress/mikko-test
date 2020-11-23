@extends('layout')

@section('content')
    <h1>Payment dates for the year {{ $selectedYear }}</h1>
    <form id="year-selector-form" method="GET">
        <select id="year-selector" class="custom-select" name="year">
            @foreach(range(2000, 2100) as $year)
                <option value="{{$year}}" @if($year == $selectedYear) selected @endif>{{$year}}</option>
            @endforeach
        </select>
    </form>
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
    <form method="POST" action="{{ route('calculator.download') }}">
        @csrf
        <input type="hidden" name="year" value="{{ $selectedYear }}">
        <button class="btn btn-primary">Download CSV</button>
    </form>
@endsection
