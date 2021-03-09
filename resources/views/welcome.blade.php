<x-guest-layout>
    <x-slot name="header">{{ __('Quiz detayını görmek için bir Quiz seçiniz.')}}</x-slot>
    <div class="sm:pt-14">
        <div class="justify-content-between col-md-6 mx-auto">
            <div class="p-0">
                <div class="card overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="card-body">
                        <div class="card-title">
                            <form action="" method="GET">
                                <div class="row g-1">
                                    <div class="col-md-2">
                                        <div class="">
                                            <input type="text" name="title" value="{{request()->get('title')}}" class="form-control" id="floatingInputGrid" placeholder="Quiz Ara...">
                                        </div>
                                    </div>
                                    @if (!request()->is('*my-result*'))
                                        <div class="col-md-2">
                                            <div class="">
                                                <select name="status" class="form-select" onchange="this.form.submit()" id="floatingSelectGrid" aria-label="Floating label select example">
                                                    <option {{(request()->get('status') == '') ? 'selected' : '' }} value="">Tüm Quizler</option>
                                                    <option {{(request()->get('status') == 'true') ? 'selected' : '' }} value="true">Quizleriniz</option>
                                                    <option {{(request()->get('status') == 'false') ? 'selected' : '' }} value="false">Katılmadıklarınız</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-3">
                                        @if (request()->get('title') or request()->get('status'))
                                            <div class="">
                                                <a href="{{route('welcome')}}" type="button" class="btn btn-outline-secondary" id="create">
                                                    <i class="fa fa-search">&nbsp;</i>{{'Clear!'}}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
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
                                            <span style="font-size: 2.5mm; width: 28px;" class=" badge bg-secondary rounded-pill">{{ $quiz->quiz_list_count }}</span>
                                        </div>
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <small>Katılımcı sayısı: </small>
                                            <span style="font-size: 2.5mm; width: 28px;" class="badge bg-secondary rounded-pill">{{ $quiz->joinUsers ? $quiz->joinUsers : 0}}</span>
                                        </div>
                                        <div class="col-md-3 flex justify-content-between align-items-center">
                                            <small>Ortalama Puan: </small>
                                            <span style="font-size: 2.5mm; width: 28px;" class="badge {{($quiz->average >= 50) ? 'bg-success' : 'bg-danger' }} rounded-pill">{{ $quiz->average ? $quiz->average : 0}}</span>
                                        </div>
                                        @if (auth()->user())
                                            @if (request()->is('*my-result') || request()->get('status') == 'true')
                                                <div class="col-md-3 flex justify-content-between align-items-center">
                                                    <small>Puanınız: </small>
                                                    <span style="font-size: 2.5mm; width: 28px;" class="badge {{($quiz->my_result->point >= 50) ? 'bg-success' : 'bg-danger' }} rounded-pill">{{ $quiz->my_result->point ? $quiz->my_result->point : 0}}</span>
                                                </div>
                                            @else
                                                <div class="col-md-3 flex justify-content-end align-items-center">
                                                    @if ($quiz->myRank)
                                                        <small class="text-success">{{'Katıldınız '}}<i class="fa fa-check-circle"></i></small>
                                                    @else
                                                        <small class="text-primary">{{'Katılmadınız '}} <i class="fa fa-play-circle"></i> </small>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                       <nav class="d-flex justify-content-end">
                           {{ $quizzes->onEachSide(1)->withQueryString()->links() }}
                       </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
