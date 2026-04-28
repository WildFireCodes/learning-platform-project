<x-app-layout>
    {{--    użytkownik zalogowany --}}
    @if(Auth::user())
        <div class="container">
            {{--  uczeń --}}
            @can('isUser')
                <div class="grid-2 mt-32">
                    <div>
                        <div class="title center">
                            Jak działa ta strona?
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="content center">
                                Platforma, z której korzystasz jest wysoce zaawansowaną oraz interaktywną pomocą do
                                nauki matematyki,
                                skierowaną do uczniów od uczniów na miarę XXI wieku. Po poprawnym zarejestrowaniu konta,
                                a następnie
                                zalogowaniu strona przedstawia główny widok (odpowiednio inny dla ucznia oraz
                                nauczyciela pełniącego rolę
                                administratora). Zadaniem ucznia jest rozwiązanie zadań przydzielonych mu przez
                                nauczyciela. Do dyspozycji
                                ma on zakładki "Moje zadania" i "Statystyki". W zakładce "Moje zadania" znajdują się
                                zadania, które już udało
                                się uczniowi wykonać oraz te, które czekają na rozwiązanie. W zakładce "Statystyki"
                                uczeń może na bieżąco kontrolować
                                swoje postępy w nauce przedstawione za pomocą różnych technik wizualizacji danych - mają
                                one za zadanie stymulować ucznia
                                do dalszej pracy. Na głównej stronie uczeń może również rozwiązać losowe zadanie.
                                <br><br>

                                Nauczyciel ma do dyspozycji listę zadań, które może przydzielić wybranym uczniom ze
                                swojej listy uczniów, którzy dokonali
                                rejestracji na platformie. Może również podejrzeć statystyki dla każdego z uczniów,
                                dzięki czemu może w łatwy i przejrzysty sposób
                                kontrolować postępy nauki, weryfikować wiedzę oraz dobierać odpowiednie środki
                                pozwalające wiedzę przekazywać.

                            </div>
                        </div>
                    </div>

                    {{--                    Losowe zadanie          --}}
                    <div class="card" id="random_task">
                        @if($random)
                            <div class="card-big-title center mt-16">
                                {{$random->exercise_name}}
                                <div class="card-title mt-32">
                                    {{$random->exercise_content}}

                                </div>
                            </div>
                            @if( $random->type == "Zamknięte")
                                <div class="mt-16 question">
                                    @for ($i = 0; $i < 4; $i++ )
                                        <label class="checkbox primary">
                                            <input type="radio" checked="checked" value="{{$answers[$i]}}"
                                                   name="typeuser">
                                            <div class="checkmark">{{$answers[$i]}}</div>
                                        </label>
                                    @endfor
                                </div>
                            @elseif ( $random->type == "Prawda-Fałsz")
                                <div class="mt-16 question">
                                    <label class="checkbox primary">
                                        <input type="radio" checked="checked" name="typeuser" value="Prawda">
                                        <div class="checkmark">Prawda</div>
                                    </label>
                                    <label class="checkbox primary">
                                        <input type="radio" name="typeuser" value="Fałsz">
                                        <div class="checkmark">Fałsz</div>
                                    </label>
                                </div>
                            @else
                                <div class="center mt-32">
                                    <x-label for="answer" :value="__('Odpowiedź:')"/>
                                    <x-input id="answer" class="min-w-500 mb-16" type="text" name="typeuser" value=""/>
                                </div>
                            @endif
                            <div class="d-flex justify-content-center mt-16" id="submit_answer">
                                <button class="primary"
                                        onclick="solveRandomTask('{{$random->correct_answer}}','{{$random->type}}')">
                                    Wyślij
                                </button>
                            </div>
                            <div class="center">
                                <div class="error fs-18 mt-32 disp-none" id="wrong_answer">
                                    Ups, to nie była poprawna odpowiedź.
                                    <br>
                                    Poprawna odpowiedź to: {{$random->correct_answer}}
                                </div>
                            </div>
                            <div class="center">
                                <div class="green fs-18 mt-32 disp-none" id="right_answer">
                                    Gratulacje! To poprawna odpowiedź.
                                </div>
                            </div>
                        @else
                            <div class="card-title mt-32 center">
                                Twój nauczyciel nie utworzył jeszcze żadnego zadania
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="title">
                            Twoje zadania
                        </div>
                        <a href="{{route('user.exercise.index', Auth::user())}}">
                            Zobacz wszystkie
                        </a>
                    </div>
                    <div class="grid-2">
                        <div class="card">
                            <div class="card-subtitle">
                                Do zrobienia
                            </div>
                            @if($exercises_todo_count != 0)
                                <div>
                                    @for ($i = 0; $i < $exercises_todo_count; $i++)
                                        <a class="mt-16"
                                           href="{{ route('user.exercise.update', [$user,$exercises_todo[$i]]) }}">
                                            <div class="task green">
                                                <div class="left d-flex justify-content-between">
                                                    <div class="">
                                                        <div
                                                            class="task-field-value bigger">{{$exercises_todo[$i]->exercise_name}}</div>
                                                        <div
                                                            class="task-field-name">{{$exercises_todo[$i]->exercise_content}}</div>
                                                    </div>
                                                </div>
                                                <div class="right">
                                                    Rozwiąż
                                                </div>
                                            </div>
                                        </a>
                                    @endfor

                                </div>
                            @else
                                <div class="card-title mt-32 center">
                                    Nie masz żadnych zadań do rozwiązania
                                </div>
                            @endif
                        </div>
                        <div class="card">
                            <div class="card-subtitle">
                                Ocenione
                            </div>
                            <div>
                                @if($exercises_done_count != 0)
                                    @for ($i = 0; $i < $exercises_done_count; $i++)
                                        <a class="mt-16"
                                           href="{{ route('user.exercise.update', [$user,$exercises_done[$i]]) }}">
                                            <div class="task green">
                                                <div class="left d-flex justify-content-between">
                                                    <div class="">
                                                        <div
                                                            class="task-field-value bigger">{{$exercises_done[$i]->exercise_name}}</div>
                                                        <div
                                                            class="task-field-name">{{$exercises_done[$i]->exercise_content}}</div>
                                                    </div>
                                                </div>
                                                <div class="right">
                                                    Pokaż
                                                </div>
                                            </div>
                                        </a>
                                    @endfor
                                @else
                                    <div class="card-title mt-32 center">
                                        Nie rozwiązałeś jeszcze żadnych zadań
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            @endcan

            {{--    nauczyciel      --}}
            @can('isTeacher')
                <div class="title center">
                    Jak działa ta strona?
                </div>
                <div class="d-flex align-items-center">
                    <div class="content center">
                        Platforma, z której korzystasz jest wysoce zaawansowaną oraz interaktywną pomocą do
                        nauki matematyki,
                        skierowaną do uczniów od uczniów na miarę XXI wieku. Po poprawnym zarejestrowaniu konta,
                        a następnie
                        zalogowaniu strona przedstawia główny widok (odpowiednio inny dla ucznia oraz
                        nauczyciela pełniącego rolę
                        administratora). Zadaniem ucznia jest rozwiązanie zadań przydzielonych mu przez
                        nauczyciela. Do dyspozycji
                        ma on zakładki "Moje zadania" i "Statystyki". W zakładce "Moje zadania" znajdują się
                        zadania, które już udało
                        się uczniowi wykonać oraz te, które czekają na rozwiązanie. W zakładce "Statystyki"
                        uczeń może na bieżąco kontrolować
                        swoje postępy w nauce przedstawione za pomocą różnych technik wizualizacji danych - mają
                        one za zadanie stymulować ucznia
                        do dalszej pracy. Na głównej stronie uczeń może również rozwiązać losowe zadanie.
                        <br><br>

                        Nauczyciel ma do dyspozycji listę zadań, które może przydzielić wybranym uczniom ze
                        swojej listy uczniów, którzy dokonali
                        rejestracji na platformie. Może również podejrzeć statystyki dla każdego z uczniów,
                        dzięki czemu może w łatwy i przejrzysty sposób
                        kontrolować postępy nauki, weryfikować wiedzę oraz dobierać odpowiednie środki
                        pozwalające wiedzę przekazywać.

                    </div>
                </div>

                <div class="grid-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="title">
                            Twoje zadania
                        </div>
                        <a href="{{route('user.exercise.index', Auth::user())}}">
                            Zobacz wszystkie
                        </a>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <div class="title">
                            Twoi uczniowie
                        </div>

                        <a href="{{route('user.index', Auth::user())}}">
                            Pokaż wszystkich
                        </a>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="card">
                        <div>
                            @if($exercises_count != 0)

                                @for ($i = 0; $i < $exercises_count; $i++)
                                    <a class="mt-16" href="{{ route('user.exercise.update', [$user,$exercises[$i]]) }}">
                                        <div class="task green">
                                            <div class="left d-flex justify-content-between">
                                                <div class="">
                                                    <div
                                                        class="task-field-value bigger">{{$exercises[$i]->exercise_name}}</div>
                                                    <div
                                                        class="task-field-name">{{$exercises[$i]->exercise_content}}</div>
                                                </div>
                                            </div>
                                            <div class="right">
                                                Szczegóły
                                            </div>
                                        </div>

                                    </a>
                                @endfor
                            @else
                                <div class="card-title mt-32 center">
                                    Nie dodałeś jeszcze żadnych zadań
                                </div>

                            @endif
                        </div>
                    </div>

                    <div class="card">

                        @if($users_count != 0)
                            <div>
                                @for ($i = 0; $i < $users_count; $i++)
                                    <a class="mt-16" href="{{route('user.show', $users[$i])}}">
                                        <div class="users green">
                                            <div class="left d-flex justify-content-between">
                                                <div class="">
                                                    <div
                                                        class="task-field-value bigger">{{$users[$i]->name}} {{$users[$i]->surname}}</div>
                                                </div>
                                            </div>
                                            <div class="right">
                                                Przypisz zadanie
                                            </div>
                                        </div>

                                    </a>
                                @endfor
                                @else
                                    <div class="card-title mt-32 center">
                                        Nie masz pod sobą jeszcze żadnych uczniów
                                    </div>
                                @endif
                            </div>
                    </div>
                </div>

            @endcan

            {{--        niezalogowany użytkownik        --}}
            @else
                <div class="container">
                    <div class="mt-64">
                        <div class="title center mt-64">
                            Jak działa ta strona?
                        </div>
                        {{--                    <div class="grid-2">--}}
                        {{--                        <img style="height:auto; width:100%; border-radius:25px; margin:0 auto;" src="Assets/board.jpg">--}}
                        <div class="d-flex align-items-center mt-32">
                            <div class="content center">
                                Platforma, z której korzystasz jest wysoce zaawansowaną oraz interaktywną pomocą
                                do
                                nauki
                                matematyki,
                                skierowaną do uczniów od uczniów na miarę XXI wieku. Po poprawnym
                                zarejestrowaniu konta,
                                a
                                następnie
                                zalogowaniu strona przedstawia główny widok (odpowiednio inny dla ucznia oraz
                                nauczyciela
                                pełniącego rolę
                                administratora). Zadaniem ucznia jest rozwiązanie zadań przydzielonych mu przez
                                nauczyciela. Do
                                dyspozycji
                                ma on zakładki "Moje zadania" i "Statystyki". W zakładce "Moje zadania" znajdują
                                się
                                zadania,
                                które już udało
                                się uczniowi wykonać oraz te, które czekają na rozwiązanie. W zakładce
                                "Statystyki"
                                uczeń może
                                na bieżąco kontrolować
                                swoje postępy w nauce przedstawione za pomocą różnych technik wizualizacji
                                danych - mają
                                one za
                                zadanie stymulować ucznia
                                do dalszej pracy. Na głównej stronie uczeń może również rozwiązać losowe
                                zadanie.
                                <br><br>

                                Nauczyciel ma do dyspozycji listę zadań, które może przydzielić wybranym uczniom
                                ze
                                swojej listy
                                uczniów, którzy dokonali
                                rejestracji na platformie. Może również podejrzeć statystyki dla każdego z
                                uczniów,
                                dzięki czemu
                                może w łatwy i przejrzysty sposób
                                kontrolować postępy nauki, weryfikować wiedzę oraz dobierać odpowiednie środki
                                pozwalające
                                wiedzę przekazywać.

                            </div>
                        </div>
                    </div>
                </div>

        </div>

    @endif


    <script type="text/javascript">
        function solveRandomTask(correct_answer, random_type) {
            if (random_type == "Otwarte") {
                const answer = document.getElementById('answer')?.value ?? '';
                if (answer == correct_answer) {
                    document.getElementById('right_answer').style.display = "block";
                } else {
                    document.getElementById('wrong_answer').style.display = "block";
                }
            } else {
                console.log(document.querySelector('input[name="typeuser"]:checked').value)
                if (document.querySelector('input[name="typeuser"]:checked').value == correct_answer) {
                    document.getElementById('right_answer').style.display = "block";
                } else {
                    document.getElementById('wrong_answer').style.display = "block";
                }
            }
            document.getElementById('submit_answer').style.display = "none";
            document.querySelectorAll('input[name="typeuser"]').forEach((el) => {
                el.disabled = true
            })
        }
    </script>
</x-app-layout>


