{{--<x-app-layout>
    <x-slot name="header"><i class="fa fa-plus"></i> {{ __('Dashboard') }} </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>--}}
<x-app-layout>
    <x-slot name="header"> {{ __('Quiz') }} </x-slot>
    <div class="container">
        <div class="row justify-content-evenly mt-4">
            <div class="col-9">
                <div class="card">
                    <div class="card-body p-4">
                        <!-- Button trigger modal -->
                        <div class="card-title mb-4">
                            <h3>{{ __('Hazırsanız Quize başlayabilirsiniz.')}}</h3>
                        </div>
                        <div class="list-group list-group-item mb-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-3"><strong>{{$quiz->title}}</strong></h5>
                            </div>
                            <p style="text-align: justify;" class="mb-2">{{$quiz->description}}</p>
                        </div>
                        @foreach ($quiz->questions as $question)
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action mb-3" aria-current="true">
                                    <div class="d-flex w-100">
                                        <h5 class="mb-3"><strong>{{ $loop->iteration }}{{__(". Soru ")}}"{{$question->question}}"</strong></h5>
                                        <h5 class="mb-3"><strong></strong></h5>
                                    </div>
                                    <div class="d-flex w-100">

                                    </div>
                                    <p style="text-align: justify;" class="mb-2">{{$question->answer1}}</p>
                                    <p style="text-align: justify;" class="mb-2">{{$question->answer2}}</p>
                                    <p style="text-align: justify;" class="mb-2">{{$question->answer3}}</p>
                                    <p style="text-align: justify;" class="mb-2">{{$question->answer4}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card position-fixed col-2">
                    <div class="card-body p-4 px-3 pb-3">
                        <!-- Button trigger modal -->
                        <div class="card-title mb-4">
                            <h3>{{ __('Genel Bilgiler')}}</h3>
                        </div>
                        <ul class="list-group mb-1">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Son Katılım Tarihi
                                <span class="badge bg-secondary rounded-pill" title="{{ $quiz->finished_at }}">{{$quiz->finished_at ? $quiz->finished_at->diffForHumans() : null }}</span>
                            </li>
                        </ul>
                        <ul class="list-group mb-1">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Soru Sayısı
                                <span class="badge bg-secondary rounded-pill">{{ $quiz->questions_count }}</span>
                            </li>
                        </ul>
                        <ul class="list-group mb-1">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Katılımcı sayısı
                                <span class="badge bg-secondary rounded-pill">14</span>
                            </li>
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ortalama Quiz Puanı
                                <span class="badge bg-secondary rounded-pill">14</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
