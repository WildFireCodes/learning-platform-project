<x-app-layout>
    <div class="container register">
        <div class="card min-w-500">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('user.exercise.index',Auth::user()) }}">
            @csrf
            <!-- Exercise_type -->
                <div class="mt-16 question">
                    <x-label class="mt-8 center" for="type">Rodzaj zadania</x-label>
                    <label class="checkbox primary">
                        <input onclick="changeForm(this)" type="radio" checked="checked" name="type" id="zamkniete"
                               value="Zamknięte"/>
                        <div class="checkmark py-8">Zamknięte</div>
                    </label>
                    <label class="checkbox primary">
                        <input onclick="changeForm(this)" type="radio" checked="checked" name="type" id="prawda-falsz"
                               value="Prawda-Fałsz"/>
                        <div class="checkmark py-8">Prawda-Fałsz</div>
                    </label>
                    <label class="checkbox primary">
                        <input onclick="changeForm(this)" type="radio" checked="checked" name="type" id="otwarte"
                               value="Otwarte"/>
                        <div class="checkmark py-8">Otwarte</div>
                    </label>
                </div>

                <!-- Exercise_name -->
                <div class="center">
                    <x-label for="exercise_name" :value="__('Tytuł zadania')"/>

                    <x-input id="exercise_name" class="min-w-500 mb-16" type="text" name="exercise_name"
                             :value="old('exercise_name')" autofocus/>
                </div>

                <!-- Exercise_content -->
                <div class="center">
                    <x-label for="exercise_content" :value="__('Treść zadania')"/>

                    <x-input id="exercise_content" class="min-w-500 mb-16" type="text" name="exercise_content"
                             :value="old('exercise_content')" autofocus/>
                </div>

                <!-- Correct Answers -->
                <div id="corr_answer" class="center corr-answer active">
                    <x-label for="correct_answer" :value="__('Poprawna odpowiedź')"/>

                    <x-input id="correct_answer" class="min-w-500 mb-16" type="text" name="correct_answer"
                             :value="old('correct_answer')"/>
                </div>

                <div id="correct_answer_pf" class="mt-16 question answers-pf">
                    <x-label class="mt-8 center" for="correct_answer">Poprawna odpowiedź</x-label>
                    <label class="checkbox primary">
                        <input type="radio" checked="checked" name="correct_answer_pf" id="prawda"
                               value="Prawda"/>
                        <div class="checkmark py-8">Prawda</div>
                    </label>
                    <label class="checkbox primary">
                        <input type="radio" checked="checked" name="correct_answer_pf" id="falsz"
                               value="Fałsz"/>
                        <div class="checkmark py-8">Fałsz</div>
                    </label>
                </div>

                <!-- Answers -->
                <div id="answers" class="answers">
                    <div class="center">
                        <x-label id="title_a" for="answers_a" :value="__('Odpowiedź błędna 1')"/>

                        <x-input id="answers_a" class="min-w-500 mb-16" type="text" name="answers_a"
                                 :value="old('answers_a')"/>
                    </div>
                    <div class="center">
                        <x-label id="title_b" for="answers_b" :value="__('Odpowiedź błędna 2')"/>

                        <x-input id="answers_b" class="min-w-500 mb-16" type="text" name="answers_b"
                                 :value="old('answers_b')"/>
                    </div>
                    <div class="center">
                        <x-label id="title_c" for="answers_c" :value="__('Odpowiedź błędna 3')"/>

                        <x-input id="answers_c" class="min-w-500 mb-16" type="text" name="answers_c"
                                 :value="old('answers_c')"/>
                    </div>
                </div>
                <div class="center">
                    <x-button class="primary mt-16">
                        {{ __('Utwórz zadanie') }}
                    </x-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    function changeForm(el) {
        if (el.getAttribute('id') === "zamkniete") {
            document.getElementById('answers').classList.add('active');
            document.getElementById('corr_answer').classList.add('active');
            document.getElementById('correct_answer_pf').classList.remove('active');
        } else if (el.getAttribute('id') === "otwarte") {
            document.getElementById('answers').classList.remove('active');
            document.getElementById('corr_answer').classList.add('active');
            document.getElementById('correct_answer_pf').classList.remove('active');
        } else {
            document.getElementById('answers').classList.remove('active');
            document.getElementById('corr_answer').classList.remove('active');
            document.getElementById('correct_answer_pf').classList.add('active');
        }
    }
</script>
