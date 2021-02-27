<x-guest-layout>
    <x-slot name="header">{{ __('Quizler') }}</x-slot>
    <div class="sm:pt-14">
        <div class="justify-content-between col-md-6 mx-auto">
            <div class="p-0">
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="card-body md:px-5">
                        <div class="card-title">
                            <h3>{{ __('Quiz detayını görmek için bir Quiz seçiniz.')}}</h3>
                        </div>
                        @foreach($quizzes as $quiz)
                            <div class="list-group mb-2">
                                <a href="{{ route('home.quiz.detay',$quiz->slug) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between mb-2">
                                        <h4 class="text-gray-600 pt-2">{{ $quiz->title }}</h4>
                                    </div>
                                    <p class="text-lg">{{ ($quiz->description) ? Str::limit($quiz->description,100,' ...') : ''}}&nbsp;</p>
                                    <div class="row col-md-14">
                                        <hr class="my-1">
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <span>Soru sayısı: </span>
                                            <small class="badge bg-secondary rounded-pill">{{ $quiz->questions_count }}</small>
                                        </div>
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <span>Katılımcı sayısı: </span>
                                            <small class="badge bg-secondary rounded-pill">{{ $quiz->joinUsers ? $quiz->joinUsers : 0}}</small>
                                        </div>
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <span>Ortalama Puan: </span>
                                            <small class="badge {{($quiz->average >= 50) ? 'bg-success' : 'bg-danger' }} rounded-pill">{{ $quiz->average ? $quiz->average : 0}}</small>
                                        </div>
                                        <div class="col-md-3 flex justify-content-end align-items-center">
                                            <span class="text-muted" title="{{ $quiz->finished_at }}">{{($quiz->finished_at) ? $quiz->finished_at->diffForHumans().' bitiyor' : 'Süre sınırı yok' }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                        {{ $quizzes->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
