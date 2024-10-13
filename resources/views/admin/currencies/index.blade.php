@extends('layouts.admin')

@section('content')

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if($currencies->isEmpty())
        <p>No currencies available.</p>
    @else
        <table>
            <thead>
            <tr>
                <th>Currency</th>
                <th>Rate</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($currencies as $currency)
                <tr>
                    <td>{{ $currency->currency_code }}</td>
                    <td>{{ $currency->rate }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <h3>Convert Currency</h3>
    <form id="conversionForm">
        @csrf
        <input type="number" name="amount" required placeholder="Amount" min="0" max="999999999999999" pattern="\d{1,15}" title="Введите целое число до 15 знаков"/>
        <select name="from" required>
            <option value="">Select From Currency</option>
            @foreach ($currencies as $currency)
                <option value="{{ $currency->currency_code }}">{{ $currency->currency_code }}</option>
            @endforeach
        </select>
        <select name="to" required>
            <option value="">Select To Currency</option>
            @foreach ($currencies as $currency)
                <option value="{{ $currency->currency_code }}">{{ $currency->currency_code }}</option>
            @endforeach
        </select>
        <button type="submit">Convert</button>
    </form>

    <div id="conversionResult"></div>

    <a href="{{ route('admin.currencies.update') }}" class="update-rates-button">
        Update Rates
    </a>

    <script>
        const convertUrl = "{{ route('admin.currencies.convert') }}";
    </script>

    @vite(['resources/css/currency_rates.css', 'resources/js/currency_converter.js'])

@endsection
