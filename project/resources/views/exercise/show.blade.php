<x-app-layout>
    <div class="container register">
        <div class="card min-w-500 content">

            @if(Auth::id() == $user->id)
                @can('isTeacher')
                    <div class="d-flex align-items-center mt-8">
                        <div class="task-field-name mr-10">ID:</div>
                        <div class="task-field-value">{{$exercise->id}}</div>
                    </div>
                    <div class="d-flex align-items-center mt-8">
                        <div class="task-field-name mr-10">Nazwa:</div>
                        <div class="task-field-value">{{$exercise->exercise_name}}</div>
                    </div>
                    <div class="d-flex align-items-center mt-8">
                        <div class="task-field-name mr-10">Treść:</div>
                        <div class="task-field-value">{{$exercise->exercise_content}}</div>
                    </div>
                    @if($exercise->type == "Zamknięte")
                        <div class="d-flex align-items-center mt-8">
                            <div class="task-field-name mr-10">Możliwe odpowiedzi:</div>
                            <div class="task-field-value">
                                @foreach($answers as $answer)
                                    {{$answer}},
                                @endforeach

                                {{$exercise->correct_answer}}
                            </div>
                        </div>
                    @endif

                    <div class="d-flex align-items-center mt-8">
                        <div class="task-field-name mr-10">Poprawna odpowiedź:</div>
                        <div class="task-field-value">{{$exercise->correct_answer}}</div>
                    </div>
                    <div class="d-flex align-items-center mt-8">
                        <div class="task-field-name mr-10 ">Typ zadania:</div>
                        <div class="task-field-value">{{$exercise->type}}</div>
                    </div>
                    <div class="d-flex justify-content-between mt-32">
                        <form method="post" action="{{ route('user.exercise.destroy', [$user,$exercise]) }}">
                            @csrf
                            @method("DELETE")
                            <x-button class="primary">
                                {{ __('Usuń') }}
                            </x-button>
                        </form>
                        <form method="get" action="{{ route('user.exercise.edit', [$user,$exercise]) }}">
                            @csrf

                            <x-button class="primary">
                                {{ __('Edytuj') }}
                            </x-button>
                        </form>
                    </div>
                    <br>

                @endcan


                @can('isUser')
                        <div class="card-title center">{{$exercise->exercise_name}}</div>
                        <div style="color:var(--secondary)" class="mt-16">{{$exercise->exercise_content}}</div>
                    {{--        SPRAWDZAMY CZY ZADANIE MA JAKĄŚ ODPOWIEDŹ UDZIELONĄ. jEŚLI TAK, TO WYŚWIATLAMY ODPOWIEDZI--}}
                    @if($ue->pivot->is_correct != "")

                        Twoja odpowiedź: {{$ue->pivot->user_answer}}  <br>
                        Poprawna odpowiedź: {{$exercise->correct_answer}}  <br>
                    @endif
                    <br>

                    {{--        JEŻELI ZADANIE NIE MIAŁO UDZIELONEJ ODPOWIEDZI TO WYŚWIETLAMY ODPOWIEDNIE FORMULARZE--}}
                    @if($ue->pivot->is_correct == "")
                        @if($exercise->type == "Prawda-Fałsz" )
                            <form method="post" action="{{ route('user.exercise.update', [$user,$exercise]) }}">
                                @csrf
                                @method("PUT")
                                <div class="mt-16 question">
                                    <label class="checkbox primary">
                                        <input onclick="changeForm(this)" type="radio" checked="checked" name="answer"
                                               id="answer"
                                               value="prawda"/>
                                        <div class="checkmark py-8">Prawda</div>
                                    </label>
                                    <label class="checkbox primary">
                                        <input onclick="changeForm(this)" type="radio" checked="checked" name="answer"
                                               id="answer"
                                               value="fałsz"/>
                                        <div class="checkmark py-8">Fałsz</div>
                                    </label>

                                </div>
                                <div class="d-flex justify-content-center mt-32">
                                    <button  class="primary">
                                        {{ __('Prześlij') }}
                                    </button>
                                </div>
                                <br><br><br>
                            </form>
                        @endif

                        @if($exercise->type == "Otwarte" )
                            <form method="post" action="{{ route('user.exercise.update', [$user,$exercise]) }}">

                                @csrf
                                @method("PUT")
                                <div class="mt-16 question">
                                    <x-input id="answer" class="min-w-500 mb-16" type="text" name="answer"
                                             :value="old('exercise_name')" autofocus/>
                                </div>
                                <div class="d-flex justify-content-center mt-32">
                                    <button  class="primary">
                                        {{ __('Prześlij') }}
                                    </button>
                                </div>
                                <br><br><br>
                            </form>
                        @endif

                        @if($exercise->type == "Zamknięte" )
                            <form method="post" action="{{ route('user.exercise.update', [$user,$exercise]) }}">
                                @csrf
                                @method("PUT")
                                <div class="mt-16 question">
                                    @foreach($answers as $answer)
                                        <label class="checkbox primary">
                                            <input onclick="changeForm(this)" type="radio" checked="checked"
                                                   name="answer" id="answer"
                                                   value="{{$answer}}"/>
                                            <div class="checkmark py-8">{{$answer}}</div>
                                        </label>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-center mt-32">
                                    <button  class="primary">
                                        {{ __('Prześlij') }}
                                    </button>
                                </div>
                            </form>
                        @endif

                        <br>
                    @endif
                @endcan
            @endif
        </div>
    </div>
</x-app-layout>
