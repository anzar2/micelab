<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="team-name" content="{{ $team->team_name }}">
    <meta name="app-version" content="{{ config('app.version') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(["resources/css/app.css" ,"resources/app/main.tsx"])
    <title>{{ $team->team_name }}</title>
</head>
<body>
    <div id="root"></div>
</body>
</html>