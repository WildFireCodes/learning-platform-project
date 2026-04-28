<x-app-layout>
    @if(Auth::user()->id == $user->id)
        <div class="container">
            @can('isUser')
                <div class="title center">
                    LISTA ZADAŃ UCZNIA
                </div>
                <div class="content center">
                    W tym miejscu można możesz rozwiązać zadania, które zostały przypisane przez nauczyciela.
                </div>
                <div class="container">
                    @if($exercise->isEmpty())
                        <div class="card m-w-500">
                            <div class="content">Nie masz jeszcze przypisanych zadań</div>
                        </div>
                    @else
                        {{--            NIEROZWIĄZANE ZADANIA--}}
                        <div class="title fs-18">
                            Zadania nierozwiązane:
                        </div>
                        <div class="grid-3">
                            @foreach($exercise as $ex)
                                @if($ex->pivot->is_correct =='')
                                    <div class="card">
                                        <div class="card-title center">
                                            <a href="{{route('user.exercise.show', [$user,$ex])}}">{{$ex->exercise_name}}</a>
                                        </div>
                                        <div class="mt-32">
                                            <span class="task-field-value">{{$ex->exercise_content}}</span>
                                        </div>
                                        <div class="d-flex justify-content-center mt-32">
                                            <a href="{{route('user.exercise.show', [$user,$ex])}}">
                                                <button class="primary">Rozwiąż</button>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        {{--ZADANIE ROZWIĄZANE POPRAWNIE--}}
                        <div class="title fs-18">
                            Zadania rozwiązane poprawnie:
                        </div>
                        @foreach($exercise as $ex)
                            @if($ex->pivot->is_correct =='1')
                                <div class="card mt-32">
                                    <div class="card-title">
                                        <a href="{{route('user.exercise.show', [$user,$ex])}}">{{$ex->exercise_name}}</a>
                                    </div>
                                    <div class="grid-3 mt-32">
                                        <div class="task-field-name">Treść zadania: <span
                                                class="task-field-value">{{$ex->exercise_content}}</span></div>
                                        <div class="task-field-name">Poprawna odpowiedź: <span
                                                class="task-field-value">{{$ex->correct_answer}}</span></div>
                                        <div class="task-field-name">Odpowiedź użytkownika: <span
                                                class="task-field-value">{{$ex->pivot->user_answer}}</span></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        {{--ZADANIE ROZWIĄZANE NIEPOPRAWNIE--}}
                        <div class="title fs-18">
                            Zadania rozwiązane niepoprawnie:
                        </div>
                        @foreach($exercise as $ex)
                            @if($ex->pivot->is_correct =='0')
                                <div class="card mt-32">
                                    <div class="card-title">
                                        <a href="{{route('user.exercise.show', [$user,$ex])}}">{{$ex->exercise_name}}</a>
                                    </div>
                                    <div class="grid-3 mt-32">
                                        <div class="task-field-name">Treść zadania: <span
                                                class="task-field-value">{{$ex->exercise_content}}</span></div>
                                        <div class="task-field-name">Poprawna odpowiedź: <span
                                                class="task-field-value">{{$ex->correct_answer}}</span></div>
                                        <div class="task-field-name">Odpowiedź użytkownika: <span
                                                class="task-field-value">{{$ex->pivot->user_answer}}</span></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            @endcan

            @can('isTeacher')
                <div class="title fs-24 center">
                    LISTA ZADAŃ NAUCZYCIELA
                </div>
                <div class="d-flex align-items-center">
                    <div class="content center">
                        Jako nauczyciel możesz tworzyć nowe zadania dla swoich uczniów. Aby rozpocząć proces
                        dodawania
                        nowego zadania kliknij znajdujący się na dole strony
                        przycisk "Utwórz zadanie". Następnie otrzymasz wybór, jakiego typu zadanie chcesz dodać
                        do bazy zadań. Platforma
                        oferuje szeroki wachlarz najpopularniejszych typów zadań do testowania wiedzy nabytych
                        przez
                        ucznia: zamknięte, otwarte oraz
                        prawda-fałsz.
                        <br><br> Aby poprawnie dodać zadania należy wypełnić wszystkie pola formularza
                        wybranego
                        zadania, przykładowo: tutył zadania,
                        treść zadania, poprawna odpowiedź, a nastepnie należy nacisnąć przycisk: "Utwórz
                        Zadanie".
                        <br><br> Aby edytować lub usunąć zadanie, należy przejść do szczegółów wybranego zadania (wybrać
                        odpowiednie
                        a następnie na nie kliknąć). Następnie należy wybrać interesującą nas opcję zaprezentowaną w
                        formie zielonego przycisku:
                        USUŃ/EDYTUJ.
                    </div>
                </div>
                @if($exercise->isEmpty())
                    <div class="card m-w-500 mb-32 mt-16">

                        <div class="content">Brak utworzonych zadań w bazie zadań.</div>
                    </div>
                @else
                    <div class="m-w-500 mb-32 mt-16">
                        <div class="card mb-32">
                            <div class="title fs-18">
                                Zadania zamknięte:
                            </div>
                            @foreach($exercise as $ex)
                                @if($ex->type == "Zamknięte")
                                    <div class="d-flex mt-8">
                                        <div class="mr-10 task-field-name">Id:</div>
                                        <div class="mr-20 task-field-value">{{ $ex->id }}</div>
                                        <div class="mr-10 task-field-name">Nazwa zadania:</div>
                                        <div class="mr-10 task-field-value">
                                            <a href="{{route('user.exercise.show', [$user,$ex])}}">{{$ex->exercise_name}}</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="card mb-32">
                            <div class="title fs-18">
                                Zadania prawda-fałsz:
                            </div>

                            @foreach($exercise as $ex)
                                @if($ex->type == "Prawda-Fałsz")
                                    <div class="d-flex mt-8">
                                        <div class="mr-10 task-field-name">Id:</div>
                                        <div class="mr-20 task-field-value">{{$ex->id }}</div>
                                        <div class="mr-10 task-field-name">Nazwa zadania:</div>
                                        <div class="mr-10 task-field-value"><a
                                                href="{{route('user.exercise.show', [$user,$ex])}}">{{$ex->exercise_name}}</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="card mb-16">
                            <div class="title fs-18">
                                Zadania otwarte:
                            </div>


                            @foreach($exercise as $ex)

                                @if($ex->type == "Otwarte")
                                    <div class="d-flex mt-8">
                                        <div class="mr-10 task-field-name">Id:</div>
                                        <div class="mr-20 task-field-value">{{ $ex->id}}</div>
                                        <div class="mr-10 task-field-name">Nazwa zadania:</div>
                                        <div class="mr-10 task-field-value">
                                            <a href="{{route('user.exercise.show', [$user,$ex])}}">{{$ex->exercise_name}}</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                <form method="GET" action="{{ route('user.exercise.create',Auth::user()) }}">
                    @csrf
                    <x-button class="primary mt-8">
                        {{ __('Utwórz zadanie') }}
                    </x-button>
                </form>
            @endcan
        </div>
    @endif
</x-app-layout>
