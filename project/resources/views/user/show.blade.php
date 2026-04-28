<x-app-layout>
    <div class="container xd">
        <div class="card min-w-500 mt-32">
            <div class="card-title center mb-16">
                Przypisz zadanie dla: {{$user->name}}
            </div>
            <div class="center card-subtitle mb-32">
                Podaj id zadania w formularzu, aby przypisać je do wybranego ucznia
            </div>
            <form method="POST" action="{{ route('user.store',$user) }}">
            @csrf

            <!-- Exercise_name -->
                <div class="center">
                    <x-label for="exercise_id" :value="__('ID Zadania')"/>
                    <x-input id="exercise_id" class="min-w-200 mb-16" type="text" name="exercise_id"/>
                </div>
                <div class="disp-none">
                    <x-label for="user_id" :value="__('User ID')"/>
                    <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" value="{{$user->id}}"
                             autofocus/>
                </div>

                <div class="center">
                    <x-button class="primary">
                        {{ __('Dodaj') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>

</x-app-layout>

<style>
    .xd {
        min-height: calc(100vh - 188px);
        display: flex;
        align-content: center;
        justify-content: center;
    }

</style>
