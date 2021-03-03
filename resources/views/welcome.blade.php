<x-guest-layout>
    <x-slot name="header">{{ __('Quiz detayını görmek için bir Quiz seçiniz.')}}</x-slot>
    <div class="sm:pt-14">
        <div class="justify-content-between col-md-6 mx-auto">
            <div class="p-0">
                <div class="card overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="card-body">
                        <div class="card-title">
                        </div>
                        @foreach($quizzes as $quiz)
                            <div class="list-group pb-1">
                                <a href="{{ route('home.quiz.detay',$quiz->slug) }}" class="list-group-item pb-0 list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h4 class="text-gray-600">{{ $quiz->title }}</h4>
                                        <small class="text-muted" title="{{ $quiz->finished_at }}">{{($quiz->finished_at) ? $quiz->finished_at->diffForHumans().' bitiyor' : 'Süre sınırı yok' }}</small>
                                    </div>
                                    <p>{{ ($quiz->description) ? Str::limit($quiz->description,100,' ...') : ''}}&nbsp;</p>
                                    <div class="row col-md-14 border-t">
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <small>Soru sayısı: </small>
                                            <span style="font-size: 2.5mm; width: 28px;" class=" badge bg-secondary rounded-pill">{{ $quiz->questions_count }}</span>
                                        </div>
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <small>Katılımcı sayısı: </small>
                                            <span style="font-size: 2.5mm; width: 28px;" class="badge bg-secondary rounded-pill">{{ $quiz->joinUsers ? $quiz->joinUsers : 0}}</span>
                                        </div>
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <small>Ortalama Puan: </small>
                                            <span style="font-size: 2.5mm; width: 28px;" class="badge {{($quiz->average >= 50) ? 'bg-success' : 'bg-danger' }} rounded-pill">{{ $quiz->average ? $quiz->average : 0}}</span>
                                        </div>
                                        <div class="col-md-3 flex justify-content-end align-items-center">
                                            @if (auth()->user())
                                            @if ($quiz->myRank)
                                               <small class="text-success">{{'Katıldınız '}}<i class="fa fa-check-circle"></i></small>
                                            @else
                                                <small class="text-primary">{{'Katılmadınız '}} <i class="fa fa-play-circle"></i> </small>
                                            @endif
                                            @endif
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
