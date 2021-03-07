<x-app-layout>
    <x-slot name="header">{{ __('Quiz Detayı') }}</x-slot>
    <div class="sm:pt-14">
        <div class="row justify-content-evenly col-md-11 mx-auto">
            <div class="col-md-6 p-0">
                <div class="card overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="card-body md:px-5">
                        <div class="card-title">
                        </div>
                        <div class="list-group">
                            <a class="list-group-item pb-1">
                                <div class="d-flex w-100 justify-content-between mb-2">
                                    <h3 class="text-gray-600 mt-1">{{ $quiz->title }}</h3>
                                </div>
                                <p class="my-4 text-xl">{{ ($quiz->description) ? $quiz->description : ''}}&nbsp;</p>
                                <div class="row col-md-14">
                                    <hr class="my-1">
                                    <div class="col-md-3 flex justify-content-between align-items-center">
                                        <span>Soru sayısı: </span>
                                        <small style="width: 37px;" class="badge bg-secondary rounded-pill">{{ $quiz->quiz_list_count }}</small>
                                    </div>
                                    <div class="col-md-3 flex justify-content-between align-items-center">
                                        <span>Katılımcı sayısı: </span>
                                        <small style="width: 37px;" class="badge bg-secondary rounded-pill">{{ $quiz->joinUsers ? $quiz->joinUsers : 0}}</small>
                                    </div>
                                    <div class="col-md-3 flex justify-content-between align-items-center">
                                        <span>Ortalama Puan: </span>
                                        <small style="width: 37px;" class="badge {{($quiz->average >= 50) ? 'bg-success' : 'bg-danger' }} rounded-pill">{{ $quiz->average ? $quiz->average : 0}}</small>
                                    </div>
                                    <div class="col-md-3 flex justify-content-end align-items-center">
                                        <span class="text-muted" title="{{ $quiz->finished_at }}">{{($quiz->finished_at) ? $quiz->finished_at->diffForHumans().' bitiyor' : 'Süre sınırı yok' }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="mt-2">
                            @if ($quiz->my_result)
                                <a href="{{ route('home.quiz.join',$quiz->slug) }}" type="button" class="btn btn-secondary float-end">Quiz'i Görüntüle</a>
                            @else
                                <a href="{{ route('home.quiz.join',$quiz->slug) }}" type="button" class="btn btn-primary float-end">Quiz'e Katıl</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 order-md-last p-0">
                <div class="card overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>{{ __('Bilgileriniz')}}</h3>
                        </div>
                        <ul class="list-group mb-1">
                            <li class="list-group-item d-flex w-100 justify-content-between align-items-center px-2 py-1">
                                @if ($quiz->my_result)
                                    <span>Puanınız</span>
                                    <span style="width: 37px;" class="badge {{($quiz->my_result->point >= 50) ? 'bg-success' : 'bg-danger' }} rounded-pill">{{$quiz->my_result->point}}</span>
                                @else
                                    <span>Puanınız</span>
                                    <span class="badge bg-secondary rounded-pill">{{'Bu Quiz\'e Katılmadınız.'}}</span>
                                @endif
                            </li>
                        </ul>
                        <ul class="list-group mb-1">
                            <li class="list-group-item d-flex w-100 justify-content-between align-items-center px-2 py-1">
                                <span>Doğru Cevap</span>
                                @if ($quiz->my_result)
                                    <span style="width: 37px;" class="badge bg-success rounded-pill">{{$quiz->my_result->correct}}</span>
                                @else
                                    <span class="badge bg-success rounded-pill"></span>
                                @endif
                            </li>
                        </ul>
                        <ul class="list-group mb-1">
                            <li class="list-group-item d-flex w-100 justify-content-between align-items-center px-2 py-1">
                                <span>Yanlış Cevap</span>
                                @if ($quiz->my_result)
                                    <span style="width: 37px;" class="badge bg-danger rounded-pill">{{$quiz->my_result->wrong}}</span>
                                @else
                                    <span class="badge bg-danger rounded-pill"></span>
                                @endif
                            </li>
                        </ul>
                        <ul class="list-group mb-1">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-2 py-1">
                                <span>Soru Sayısı</span>
                                @if ($quiz->my_result)
                                    <span style="width: 37px;" class="badge bg-primary rounded-pill">{{$quiz->my_result->correct+$quiz->my_result->wrong}}</span>
                                @else
                                    <span class="badge bg-primary rounded-pill"></span>
                                @endif
                            </li>
                        </ul>
                        <ul class="list-group mb-1">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-2 py-1">
                                <span>Sıralamanız</span>
                                @if ($quiz->my_result)
                                    <span style="width: 37px;" class="badge bg-secondary rounded-pill">{{$quiz->myRank}}</span>
                                @else
                                    <span class="badge bg-primary rounded-pill"></span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-2 order-md-first p-0">
                <div class="card overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>{{ __('İlk On')}}</h3>
                        </div>
                        @if ($quiz->topTen->count() > 0)
                            @foreach($quiz->topTen as $topuser)
                                <ul class="list-group mb-1">
                                    <li class="list-group-item d-flex w-100 justify-content-between align-items-center px-1 py-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{$topuser->user->profile_photo_url}}" title="{{$topuser->user->name}}">&nbsp;

                                            <span class="{{(auth()->user()->id == $topuser->user->id) ? 'badge bg-success' : ''}}">{{$loop->iteration.'. '.$topuser->user->name}}</span>
                                        </div>
                                        <div class="justify-content-end">
                                            <span style="width: 37px;" class="badge {{($topuser->point >= 50) ? 'bg-success' : 'bg-danger' }} rounded-pill">{{$topuser->point}}</span>
                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                        @else
                            <ul class="list-group mb-1">
                                <li class="list-group-item align-content-center px-2">
                                    <span>{{'Bu Quiz\'e Henüz Katılım Olmadı.'}}</span>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
