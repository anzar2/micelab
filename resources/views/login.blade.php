<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/app/css/app.css'])
    <title>{{ $team->team_name }} | Login</title>
</head>

<body>
    <div class=" overflow-hidden h-screen w-screen flex items-center justify-center md:grid md:grid-cols-2">
        <section class="flex items-center justify-center">
            <div class="min-w-90">
                <h1>{{ $team->team_name }}</h1>
                <p class="mb-5 text-gray-500">Micelab</p>
                <form action="{{ route('login.attempt') }}" method="POST">
                    @csrf
                    <fieldset>
                        <label for="identifier">{{ __("forms.login.identifier.label") }}</label>
                        <input class="input" placeholder="{{ __("forms.login.identifier.placeholder") }}" type="text"
                            name="identifier">
                        @error('identifier')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror
                    </fieldset>
                    <fieldset>
                        <label for="password">{{ __("forms.login.password.label") }}</label>
                        <input class="input" id="password" placeholder="{{ __("forms.login.password.label") }}"
                            type="password" name="password">
                        <button id="show-password" type="button" class="link text-start"></button>
                        @error('password')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror
                    </fieldset>
                    <button type="submit"
                        class="btn mt-5 btn-primary w-full justify-center">{{ __("forms.login.submit.label") }}</button>
                    @if(session("error"))
                        <span style="color: red;">{{ session("error") }}</span>
                    @endif
                </form>
                <hr class="border-gray-300 my-5">
                <div class="flex flex-col items-center">
                    <a class="link" href="">Olvidé mi contraseña</a>
                    <a class="link" href="">Seguridad y Privacidad</a>
                </div>
            </div>
        </section>
        <section class="hidden h-full md:flex">
            <img class="w-full h-full object-cover" src="{{ asset('media/MICELAB_BG.png') }}" alt="">
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const button = document.getElementById("show-password");
            const passwordInput = document.getElementById("password");
            let showPassword = false;

            button.innerText = showPassword;
                ? @json(__('forms.login.password.hide'))
                : @json(__('forms.login.password.show'))

            button.addEventListener('click', (e) => {
                e.preventDefault();
                showPassword = !showPassword;

                if (showPassword) {
                    button.innerText = @json(__('forms.login.password.hide'));
                    passwordInput.setAttribute("type", "text");
                } else {
                    button.innerText = @json(__('forms.login.password.show'));
                    passwordInput.setAttribute("type", "password");
                }

            })
        })
    </script>
</body>

</html>