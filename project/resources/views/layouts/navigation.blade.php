@if (Auth::user())
    <div class="header">
        <div class="container align-items-center d-flex justify-content-between center h-100">
            <a href="{{route('mainpage')}}" class="bold fs-24">Witaj {{ Auth::user()->name }}!</a>
            <div class="d-flex">
                <a class="link" href="{{route('user.exercise.index', Auth::user())}}">Moje zadania</a>
                @can('isUser')
                    <a class="link" href="{{route('user.statistics.index',Auth::user())}}">Statystyki</a>
                @endcan
                @can('isTeacher')
                    <a class="link" href="{{route('user.index', Auth::user())}}">Lista uczniów</a>
                @endcan
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        <div>
                            @csrf
                            <button class="primary" :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                {{ __('Wyloguj') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else

    <div class="header">
        <div class="container align-items-center d-flex justify-content-between center h-100 p-relative">
            <div class="bold fs-24">Witaj w Twoim programie do nauki matematyki!</div>
            <div class="d-flex justify-content-end flex-column">
                <div class="d-flex justify-content-end">
                    <button class="primary" onclick="document.getElementById('login-form').classList.toggle('active');">
                        Zaloguj
                    </button>
                </div>
                <a href="{{route('register')}}" class="mt-8">Nie masz konta? Zarejestruj się tutaj!</a>
            </div>
            <div class="login-form {{$errors->isNotEmpty() ? 'active' : ''}}" id="login-form">


                <form method="POST" action="{{ route('mainpage') }}">
                @csrf

                <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-16 error" :errors="$errors"/>

                    <!-- Email Address -->
                    <div>
                        <x-label for="email" :value="__('Email')"/>

                        <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')"
                                 autofocus/>
                    </div>

                    <!-- Password -->
                    <div class="mt-16">
                        <x-label for="password" :value="__('Password')"/>

                        <x-input id="password" class="block mt-1 w-full"
                                 type="password"
                                 name="password"
                                 autocomplete="current-password"/>
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-8">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                   name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <x-button class="mt-8 primary">
                        {{ __('Log in') }}
                    </x-button>

                    <div class="flex items-center justify-end mt-16">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                    </div>


                </form>
            </div>
        </div>
    </div>
@endif
