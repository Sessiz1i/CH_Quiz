<x-app-layout>
    <x-slot name="header">{{ __('Katıldığın Quizler') }}</x-slot>
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
                                <a href="{{ route('home.quiz.detay',$quiz->slug) }}" class="list-group-item pb-1 list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between mb-2">
                                        <h4 class="text-gray-600 pt-2">{{ $quiz->title }}</h4>
                                    </div>
                                    <p class="text-lg">{{ ($quiz->description) ? Str::limit($quiz->description,100,' ...') : ''}}&nbsp;</p>
                                    <div class="row col-md-14">
                                        <hr class="my-1">
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <span>Soru sayısı: </span>
                                            <small class="badge bg-secondary rounded-pill">{{ $quiz->correct+$quiz->wrong }}</small>
                                        </div>
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <span>Doğru Cevabın: </span>
                                            <small class="badge bg-success rounded-pill">{{ $quiz->correct }}</small>
                                        </div>
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <span>Yanlış Cevabın: </span>
                                            <small class="badge bg-danger rounded-pill">{{ $quiz->wrong }}</small>
                                        </div>
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <span>Puanın: </span>
                                            <small class="badge {{($quiz->point >= 50) ? 'bg-success' : 'bg-danger' }} rounded-pill">{{ $quiz->point ? $quiz->point : 0}}</small>
                                        </div>
                                        <div class="col-md-3 flex justify-content-end align-items-center">

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
</x-app-layout>
