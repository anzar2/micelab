<!DOCTYPE html>
<html lang={{ config('app.locale') }}>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(["resources/css/app.css"])
    <title>Micelab Login</title>
</head>

<body>
    <main class="h-screen w-screen grid grid-cols-2">
        <section class="flex items-center justify-center">
            <div class="flex flex-col gap-6 w-[18rem]">
                @if (session("error"))
                    <div class="bp5-callout bp5-intent-danger bp5-icon-error">
                        {{ session("error") }}
                    </div>
                @endif
                <div>
                    <h1>{{ $team->team_name }}</h1>
                    <span>Bienvenido</span>
                </div>
                <form action="{{ route('login.attempt') }}" method="POST">
                    @csrf
                    <fieldset class="bp5-form-group" f="identifier">
                        <label for="identifier" class="bp5-label">{{ __("forms.login.identifier.label") }}</label>
                        <div class="bp5-form-content">
                            <div class="bp5-input-group">
                                <span class="bp5-icon bp5-icon-person"></span>
                                <input type="text" class="bp5-input" name="identifier"
                                    placeholder="{{ __("forms.login.identifier.placeholder") }}">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="bp5-form-group" f="password">
                        <label for="identifier" class="bp5-label">{{ __("forms.login.password.label") }}</label>
                        <div class="bp5-form-content">
                            <div class="bp5-input-group">
                                <span class="bp5-icon bp5-icon-lock"></span>
                                <input type="password" name="password" class="bp5-input" placeholder="••••••••••••••">
                                <button class="bp5-button bp5-minimal bp5-icon-eye-open" type="button" autocomplete="false"></button>
                            </div>
                        </div>
                    </fieldset>

                    <button class="bp5-button w-full bp5-intent-primary">{{ __("forms.login.submit.label") }}</button>
                </form>
                <div class="bp5-divider"></div>
                <div class="flex flex-col gap-2 items-center">
                    <a href="">Recuperar contraseña</a>
                    <a href="https://github.com/anzar2/micelab/wiki#privacy-and-security" target="_blank">Seguridad y
                        Privacidad</a>
                </div>
            </div>
        </section>
        <section class="bg-purple-500">
        </section>
    </main>
</body>

</html>