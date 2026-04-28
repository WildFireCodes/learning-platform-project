<x-app-layout>
    <div class="container">
        <div class="title fs-24 center">
            LISTA ZADAŃ UCZNIA
        </div>
        <div class="d-flex align-items-center">
            <div class="content center">
                W tym miejscu można możesz zobaczyć listę uczniów przypisanych do twojego konta nauczyciela. Listę
                uczniów możesz edytować np. usuwając ucznia.
                Możesz również na bieżąco sprawdzać postępy danej osoby.
            </div>
        </div>

        <div class="card m-w-500 mb-32 mt-16">
            <div class="py-12">
                @if(count($users)==1)
                    <div class="content">Brak zarejestrowanych uczniów</div>
                @else
                    <div class="border-bottom-xd">
                        <div class="grid-asd content " style="width:500px;">
                            <div>Imie</div>
                            <div>Nazwisko</div>
                            <div>Email</div>
                        </div>
                    </div>
                    @foreach($users as $user)
                        @if($user->role != 'teacher')
                            <div class=" mb-16">

                                <div class="d-flex align-items-center justify-content-between">
                                    <div style="width:500px" class="grid-asd">
                                        <div class="mr-20 task-field-value">{{$user->name}}</div>
                                        <div class="mr-20 task-field-value">{{$user->surname}}</div>
                                        <div class="mr-20 task-field-value">{{$user->email}}</div>
                                    </div>
                                    <div class="d-flex">
                                        <button class="primary mr-10"><a href="{{route('user.show', $user)}}">Przypisz
                                                zadanie</a></button>
                                        <form method="post" action="{{ route('user.destroy', [$user]) }}">
                                            @csrf
                                            @method("DELETE")
                                            <x-button class="primary mr-10">
                                                {{ __('Usuń') }}
                                            </x-button>
                                        </form>

                                        <form method="GET" action="{{ route('user.statistics.index', [$user]) }}">
                                            @csrf
                                            <x-button class="primary mr-10">
                                                {{ __('Podgląd postępów') }}
                                            </x-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
        <div class="card" style="min-height: 450px">
                <div id="chartContainer_1">
                    <script type="text/javascript">
                        window.onload = function () {
                            var chart_1 = new CanvasJS.Chart("chartContainer_1",
                                {
                                    title: {
                                        text: "Przypisane zadania"
                                    },
                                    axisY: {
                                        title: "Ilość przypisanych zadań",
                                    },
                                    data: [
                                        {
                                            type: "column",
                                            name: "Przypisane zadania",
                                            dataPoints: [
                                                    @foreach($users as $user)
                                                    @if($user->role != 'teacher')
                                                {
                                                    label: "{{$user->name}} {{$user->surname}}",
                                                    y: {{$user->exercise->count()}}
                                                },
                                                @endif
                                                @endforeach
                                            ]
                                        }
                                    ]
                                });
                            chart_1.render();
                        }
                    </script>
                </div>
        </div>
        <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </div>
</x-app-layout>
