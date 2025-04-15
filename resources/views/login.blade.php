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
            <label for="identifier">{{ __("forms.login.identifier.label") }}</label>
            <input type="text" name="identifier" placeholder="{{ __("forms.login.identifier.placeholder") }}">
            @error('identifier')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </fieldset>
        <fieldset>
            <label for="password">{{ __("forms.login.password.label") }}</label>
            <input type="password" name="password" placeholder="{{ __("forms.login.password.placeholder") }}">
            @error('password')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </fieldset>
        @if(session("error"))
            <strong style="color: red;">{{ session("error") }}</strong>
        @endif
        <p style="background-color: yellow;">UI is under development</p>
        <button class="btn-primary">{{ __("forms.login.submit.label") }}</button>
    </form>
</body>

</html>