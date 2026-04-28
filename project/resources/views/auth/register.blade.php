<x-guest-layout>
    <x-auth-card>
        <div class="register">
            <div class="center card min-w-500">
                <div class="center mt-16 mb-32 fs-24">
                    <h2>Cieszymy się, że do nas dołączasz!</h2>
                </div>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')"/>

                        <x-input id="name" class="block mt-8 w-full mb-16" type="text" name="name" :value="old('name')"
                                 autofocus/>
                    </div>

                    <!-- Surname -->
                    <div>
                        <x-label for="surname" :value="__('Surname')"/>


                        <x-input id="surname" class="block mt-8 w-full mb-16" type="text" name="surname"
                                 :value="old('name')" autofocus/>
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')"/>

                        <x-input id="email" class="block mt-8 w-full mb-16" type="email" name="email"
                                 :value="old('email')"/>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')"/>


                        <x-input id="password" class="block mt-8 w-full mb-16"
                                 type="password"
                                 name="password"
                                 autocomplete="new-password"/>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirm Password')"/>
                        <x-input id="password" class="block mt-8 w-full mb-16"
                                 type="password"
                                 name="password_confirmation"
                                 autocomplete="new-password"/>
                    </div>

                    <x-button class="primary">
                        {{ __('Zarejestruj się') }}
                    </x-button>

                    <div class="flex items-center justify-end mt-16">
                        <a class="underline text-sm green hover:text-gray-900" href="{{ route('mainpage') }}">
                            {{ __('Masz już konto? Przejdź do strony logowania') }}
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
