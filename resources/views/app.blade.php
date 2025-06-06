<!DOCTYPE html>
<html lang={{ config("app.locale") }}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @viteReactRefresh
    @vite(["resources/css/app.css", "resources/app/main.tsx"])
    <title></title>
</head>
<body>
    <div id="root"></div>
</body>
</html>