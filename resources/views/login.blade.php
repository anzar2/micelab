<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Micelab Login</title>
</head>

<body>
    <form action="{{ route('login.attempt') }}" method="POST">
        @csrf
        <h1>Micelab Login</h1>
        <fieldset>
            <label for="identifier">Email or username</label>
            <input type="text" name="identifier" placeholder="Email or username">
            @error('identifier')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </fieldset>
        <fieldset>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password">
            @error('password')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </fieldset>
        @if(session("error"))
            <strong style="color: red;">{{ session("error") }}</strong>
        @endif
        <p style="background-color: yellow;">UI is under development</p>
        <button class="btn-primary">Login</button>
    </form>
</body>

</html>