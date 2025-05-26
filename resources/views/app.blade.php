<!DOCTYPE html>
<html lang={{ config('app.locale') }} data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    @viteReactRefresh
    @vite(['resources/app/css/app.css', 'resources/app/main.tsx'])
</head>
<body>
    <div id="root" class="bg-gray-100"></div>
</body>
</html>