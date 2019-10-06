<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ticket printer</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

@section('fonts')
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600|Share+Tech|Kalam|Permanent+Marker|Yellowtail&display=swap"
              rel="stylesheet">
@show
@section('styles')
    <link rel="stylesheet" href="/css/app.css">
@show

</head>
<body>
@yield('content')


@section('scripts')
<script src="./js/app.js"></script>
@show

</body>
</html>
