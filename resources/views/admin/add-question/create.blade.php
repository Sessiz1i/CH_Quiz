<x-app-layout>
    <x-slot name="header">{{ __('Quiz\'e Question Ekleme Sayfasındasınız') }} </x-slot>
    <div class="sm:pt-14">
        <div class="card col-md-8 mx-auto overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="card-body md:px-5">
                <div class="card-title">
                    <h3>{{ $quiz->title }}</h3>
                    <form action="" method="GET">
                        <div class="row g-1">
                            <div class="col-md-3">
                                <input type="text" name="title" value="{{request()->get('title')}}" class="form-control" id="floatingInputGrid" placeholder="Soru Ara...">
                            </div>
                            <div class="col-md-3">
                                @if (request()->get('title'))
                                    <div class="">
                                        <a href="{{route('admin.add-question.store',$quiz->id)}}" type="button" class="btn btn-outline-secondary" id="create">
                                            <i class="fa fa-search">&nbsp;</i>{{'Clear!'}}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <form action="{{ route('admin.add-question.store',$quiz->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="quizid" value="{{ $quiz->id }}">
                    @foreach ($questions as $question)
                        <div class="card mb-2">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    @if ($question->image)
                                        <a href="{{asset($question->image)}}" target="_blank">
                                            <img class="w-100 h-100" src="{{asset($question->image)}}" title="{{ $quiz->title }}">
                                        </a>
                                    @else
                                        <a href="http://via.placeholder.com/200x160" target="_blank">
                                            <img class="w-100 h-100" src="http://via.placeholder.com/200x160" title="Resim Yok">
                                        </a>

                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body">
                                        <h5 class="card-title text-gray-600"><b>{{ $question->id }}{{__(". Soru ")}}"{{$question->question}}"</b></h5>
                                        <div class="card-text row">
                                            <div class="col-md-6">
                                                <span>{{'Cevap 1-) '}}{{$question->answer1}}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <span>{{'Cevap 2-) '}}{{$question->answer2}}</span>
                                            </div>
                                        </div>
                                        <div class="card-text row">
                                            <div class="col-md-6">
                                                <span>{{'Cevap 3-) '}}{{$question->answer3}}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <span>{{'Cevap 4-) '}}{{$question->answer4}}</span>
                                            </div>
                                        </div>
                                        <span>{{'Doğru Cevap -) '}}{{'Cevap '.Str::substr($question->correct_answer,-1)}}</span>
                                        <div class="">
                                            <input @if (old('question'.$question->id)) checked @endif class="form-check-input @if (old('question'.$question->id)) @error('question'.$question->id)
                                                    is-invalid @enderror @endif " type="checkbox"
                                                   name="{{'question'.$question->id}}" id="{{$question->id.'-answer4'}}"
                                                   value="{{$question->id}}">
                                            <label class="form-check-label text-primary @error('question'.$question->id) text-danger @enderror" for="{{$question->id.'-answer4'}}">
                                                <strong>{{'Quiz\'e Eklemek için seçim yap'}}</strong></label></input>
                                            @if (old('question'.$question->id))
                                                @error('question'.$question->id)
                                                <span class="invalid-feedback" role="alert">
                                                <strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong></span>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success mb-3">Quiz'i Tamamla</button>
                    </div>
                     {{--{{ $questions->onEachSide(1)->withQueryString()->links() }}--}}
                    {{--    <nav class="pagination d-flex justify-content-end">
                            {{ $questions->withQueryString()->links() }}
                        </nav>--}}
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

