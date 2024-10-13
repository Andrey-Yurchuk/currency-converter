<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/currency_rates.css'])
    <title>Currencies</title>
</head>
<body>
<header>
    <h1>Currency Rates</h1>
</header>

<main>
    @yield('content')
</main>

<footer>
    <p class="footer-note">Currency rates data sourced from <a href="https://freecurrencyapi.com" target="_blank" class="footer-link">freecurrencyapi.com</a></p>
</footer>

</body>
</html>
