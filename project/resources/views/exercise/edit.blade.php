<x-app-layout>
    <div class="container center">
        <form method="post" action="{{ route('user.exercise.update', [$user,$exercise]) }}">
            <div class="title center">EDYCJA ZADANIA</div>
            <div class="align-items-center">
                <div class="content center">
                    W tym miejscu można edytować treść zadań.
                    Odpowiedzi powinny mieć sens logiczny i merytorycznie powinny być poprawne.
                    Tylko jedna odpowiedź musi być poprawna.
                </div>
            </div>
            <div class="card mt-32">
                <div class="error bold mt-16">UWAGA! EDYTUJESZ ZADANIE, KTÓRE MOGŁO BYĆ JUŻ PRZYPISANE KTÓREMUŚ
                    UCZNIOWI!
                </div>


                @csrf
                @method("PUT")
                <div class="mt-16 question">
                    <!-- Exercise_name -->
                    <div>
                        <x-label for="exercise_name" :value="__('Tytuł zadania')"/>

                        <x-input id="exercise_name" class="min-w-500 mb-16" type="text" name="exercise_name"
                                 value="{{$exercise->exercise_name}}" autofocus/>
                    </div>

                    <!-- Exercise_content -->
                    <div>
                        <x-label for="exercise_content" :value="__('Treść zadania')"/>

                        <x-input id="exercise_content" class="min-w-500 mb-16" type="text" name="exercise_content"
                                 value="{{$exercise->exercise_content}}" autofocus/>
                    </div>
                    @if($exercise->type == 'Zamknięte' ||$exercise->type == 'Otwarte' )
                        <div>
                            <x-label for="correct_answer" :value="__('Poprawna odpowiedź')"/>

                            <x-input id="correct_answer" class="min-w-500 mb-16" type="text" name="correct_answer"
                                     value="{{$exercise->correct_answer}}"/>
                        </div>
                    @endif
                    @if($exercise->type == 'Zamknięte')
                        <div id="answers">
                            <div>
                                <x-label id="title_a" for="answers_a" :value="__('Odpowiedź błędna 1')"/>

                                <x-input id="answers_a" class="min-w-500 mb-16" type="text" name="answers_a"
                                         value="{{$answers[0]}}"/>
                            </div>
                            <div>
                                <x-label id="title_b" for="answers_b" :value="__('Odpowiedź błędna 2')"/>

                                <x-input id="answers_b" class="min-w-500 mb-16" type="text" name="answers_b"
                                         value="{{$answers[1]}}"/>
                            </div>
                            <div>
                                <x-label id="title_c" for="answers_c" :value="__('Odpowiedź błędna 3')"/>

                                <x-input id="answers_c" class="min-w-500 mb-16" type="text" name="answers_c"
                                         value="{{$answers[2]}}"/>
                            </div>
                        </div>
                    @endif
                    @if($exercise->type == 'Prawda-Fałsz')
                        <div>
                            <label class="checkbox primary">
                                <input onclick="changeForm(this)" type="radio" checked="checked" name="correct_answer"
                                       id="correct_answer"
                                       value="prawda"/>
                                <div class="checkmark py-8">Prawda</div>
                            </label>
                            <label class="checkbox primary">
                                <input onclick="changeForm(this)" type="radio" checked="checked" name="correct_answer"
                                       id="correct_answer"
                                       value="fałsz"/>
                                <div class="checkmark py-8">Fałsz</div>
                            </label>
                        </div>
                    @endif
                </div>
                <div class="flex items-center justify-end mt-4">

                    <x-button class="primary mt-32">
                        {{ __('Prześlij') }}
                    </x-button>
                </div>
                <br><br><br>
            </div>
        </form>
    </div>
</x-app-layout>
