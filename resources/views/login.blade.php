<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(["resources/css/app.css"])
    <title>{{ $team->team_name }}</title>
</head>

<body>
    <main class="grid grid-cols-2 h-screen w-screen">
        <section class="flex flex-col gap-6 items-center justify-center">
            <div class="w-80">
                @if(session("error"))
                    <div class="bp5-callout bp5-intent-danger bp5-icon-info-sign">
                        {{session("error")}}
                    </div>
                @endif
                <div class="my-6">
                    <h1 class="font-semibold text-2xl">{{ $team->team_name }}</h1>
                    <span>Micelab</span>
                </div>
                <form action="{{ route('login.attempt') }}" method="POST">
                    @csrf
                    <fieldset class="bp5-form-group">
                        <label class="bp5-label" for="identifier">{{ __("forms.login.identifier.label") }}</label>
                        <div class="bp5-form-content">
                            <div class="bp5-input-group ">
                                <span class="bp5-icon bp5-icon-person"></span>
                                <input id="identifier" name="identifier" type="text" class="bp5-input" placeholder="{{ __("forms.login.identifier.placeholder") }}" />
                                @error("identifier")  <div class="text-sm text-red-500">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="bp5-form-group">
                        <label class="bp5-label" for="password">{{ __("forms.login.password.label") }}</label>
                        <div class="bp5-form-content">
                            <div class="bp5-input-group ">
                                <span class="bp5-icon bp5-icon-lock"></span>
                                <input name="password" id="password" type="password" class="bp5-input" placeholder="{{ __("forms.login.password.label") }}" />
                                @error("password")  <div class="text-sm text-red-500">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </fieldset>
                    <button type="submit"
                        class="bp5-button bp5-intent-primary w-full">{{ __("forms.login.submit.label") }}</button>
                </form>
                <div class="bp5-divider w-full !mt-6"></div>
                <div class="flex flex-col gap-1 items-center py-3">
                    <a href="">Recuperar contraseña</a>
                    <a href="">Seguridad y privacidad</a>
                </div>
            </div>

        </section>
        <section>
            tulita
        </section>
    </main>
    <script>
        // Todo: Show password 
    </script>
</body>

</html>