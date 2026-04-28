<x-app-layout>
    @if(Auth::id() == $user->id || Auth::user()->role == 'teacher')
        {{--    wyswietlenie naglowka w zaleznosci od typu uzytkownika --}}
        @can('isUser')
            <div class="title center">
                Poniżej możesz sprawdzić postępy w swojej nauce przygotowane w formie krótkich statystyk.
            </div>
            @if($points[2] == 0)
                <div class="d-flex align-items-center container">
                    <div class="content center">
                            Nie zostały ci przydzielone jeszcze żadne zadania!
                    </div>
                </div>
            @endif
        @endcan

        @can('isTeacher')
            <div class="container">
                <div class="title center">Podejrzyj jak radzi sobie twój uczeń {{$user->name}} z rozwiązywaniem
                    zadań:
                </div>
                @if($points[2] == 0)
                    <div class="d-flex align-items-center">
                        <div class="content center">
                            {{$user->name}} nie dostał jeszcze żadnych zadań!
                        </div>
                    </div>
                @endif
            </div>
        @endcan
        {{--    wykresy    --}}
        <div class="grid-2 container">
            @if($points[2] != 0)
                <div class="card">
                    <div id="chartContainer_1" style="height: 370px; width: 100%;"></div>
                </div>
            @endif
            @if($points[1] != 0)
                <div class="card">
                    <div id="chartContainer_2" style="height: 370px; width: 100%; margin:0 auto"></div>
                </div>
            @endif
        </div>
        @if($points[1] != 0)
            @can('isTeacher')
                <div class="container">
                    <div class="title mt-32">Poprawnie rozwiązane zadania:</div>

                    @foreach($user->exercise as $ex)
                        @if($ex->pivot->is_correct == '1')
                            <div class="card mt-32">
                                <div class="card-title">{{$ex->exercise_name}}</div>
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

                    <div class="title mt-32">Źle rozwiązane zadania:</div>
                    @foreach($user->exercise as $ex)
                        @if($ex->pivot->is_correct == '0')
                            <div class="card mt-32">
                                <div class="card-title">{{$ex->exercise_name}}</div>
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

                </div>
            @endcan
        @endif

        <script type="text/javascript">
            window.onload = function () {
                var chart_1 = new CanvasJS.Chart("chartContainer_1",
                    {
                        title: {
                            text: "Postęp w rozwiązywaniu zadań"
                        },
                        data: [
                            {
                                type: "pie",
                                dataPoints: [
                                    {y: {{$points[1]}}, indexLabel: "Rozwiązane zadania"},
                                    {y: {{100-$points[1]}}, indexLabel: "Nierozwiązane zadania"},
                                ]
                            }
                        ]
                    });
                chart_1.render();

                var chart_2 = new CanvasJS.Chart("chartContainer_2",
                    {
                        title: {
                            text: "Poprawność rozwiązywania zadań"
                        },
                        data: [
                            {
                                type: "pie",
                                dataPoints: [
                                    {y: {{$points[0] }}, indexLabel: "Rozwiązane poprawnie"},
                                    {y: {{100-$points[0]}}, indexLabel: "Rozwiązane niepoprawnie"},
                                ]
                            }
                        ]
                    });

                chart_2.render();
            }
        </script>
        <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    @endif
</x-app-layout>

