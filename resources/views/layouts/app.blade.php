<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <meta name="csrf-token" content="{{  csrf_token()  }}">

</head>
<body>

@yield('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" ></script>
<script type='text/javascript' src='https://maps.google.com/maps/api/js?key={{ config('services.google.maps_api') }}&libraries=places'></script>
<script>
    var client_id = "{{ config('services.foursquare.client_id') }}";
    var secret_id = "{{  config('services.foursquare.secret_id') }}";
</script>
<script src="{{ asset('js/app.js') }}" ></script>
</body>
</html>