<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ticket printer</title>

    <!-- Fonts -->
    {{--        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600|Share+Tech|Kalam|Permanent+Marker|Yellowtail&display=swap"
          rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="ticket-content">
    @php
    $issue = $issues[3];
    @endphp
    @foreach($issues as $issue)
        <div class="ticket-page-frame">
            <div class="ticket-page-margin">
                <div class="header">
                    <div class="title">{{$issue['key']}}</div>
                    <div class="points">{{$issue['points']}}</div>
                </div>
                <div class="body">
                    <div class="description">{!! $issue['description'] !!}</div>
                </div>
                <div class="footer">
                    <div class="logo-mini"></div>
                    @if(!empty($issue['epic']))
                    <div class="epic label">{{$issue['epic']}}</div>
                    @endif
                </div>
{{--                <div class="qr-code">{!! QrCode::margin(0)->errorCorrection('L')->format('svg')->margin(0)->generate('https://enrise.atlassian.net/browse/'.$issue['key']) !!}</div>--}}
{{--                                <div class="qr-code"><img src="data:image/png;base64,{!! base64_encode(QrCode::errorCorrection('L')->format('png')->margin(0)->generate('https://enrise.atlassian.net/browse/'.$issue['key'])) !!}"></div>--}}


            </div>
        </div>
    @endforeach
</div>
</body>
</html>
