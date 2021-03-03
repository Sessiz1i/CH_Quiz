<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>
    <div class="sm:pt-14">
        <div class="col-md-6 mx-auto overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="card-body md:px-5">
                <div class="card-title">
                    <h3>{{ __('Quiz\'e verdiğiniz cevaplar.')}} - {{ __('Puanınız: ') .$quiz->my_result->point}}</h3>
                </div>
                @foreach ($quiz->questions as $question)
                    <div class="list-group mb-2">
                        <div class="list-group-item pb-0" aria-current="true">
                            @if ($question->image)
                                <div class="d-flex justify-content-between mt-2">
                                    <img src="{{asset($question->image)}}" class="mb-2 img-thumbnail">
                                </div>
                            @endif
                            <div class="d-flex w-100 justify-content-start">
                                @if ($question->correct_answer == $question->myAnswer->answer)
                                    <h5 class="mt-2 text-success"><i class="fa fa-check">&nbsp;</i>
                                        @else
                                            <h5 class="mt-2 text-danger"><i class="fa fa-times">&nbsp;</i>
                                                @endif
                                                <b>{{ $loop->iteration }}{{__(". Soru ")}}"{{$question->question}}"</b></h5>
                            </div>
                            <div class="pb-0">
                                <div class="form-check">
                                    @if ($question->correct_answer == 'answer1')
                                        <p style="text-align: justify;" class="mb-2 text-success"><i class="fa fa-check">&nbsp;</i>{{$question->answer1}}</p>
                                    @elseif ($question->myAnswer->answer == 'answer1')
                                        <p style="text-align: justify;" class="mb-2 text-danger"><i class="fa fa-times">&nbsp;</i>{{$question->answer1}}</p>
                                    @else
                                        <p style="text-align: justify;" class="mb-2">{{$question->answer1}}</p>
                                    @endif
                                </div>
                                <div class="form-check">
                                    @if ($question->correct_answer == 'answer2')
                                        <p style="text-align: justify;" class="mb-2 text-success"><i class="fa fa-check">&nbsp;</i>{{$question->answer2}}</p>
                                    @elseif ($question->myAnswer->answer == 'answer2')
                                        <p style="text-align: justify;" class="mb-2 text-danger"><i class="fa fa-times">&nbsp;</i>{{$question->answer2}}</p>
                                    @else
                                        <p style="text-align: justify;" class="mb-2">{{$question->answer2}}</p>
                                    @endif
                                </div>
                                <div class="form-check">
                                    @if ($question->correct_answer == 'answer3')
                                        <p style="text-align: justify;" class="mb-2 text-success"><i class="fa fa-check">&nbsp;</i>{{$question->answer3}}</p>
                                    @elseif ($question->myAnswer->answer == 'answer3')
                                        <p style="text-align: justify;" class="mb-2 text-danger"><i class="fa fa-times">&nbsp;</i>{{$question->answer3}}</p>
                                    @else
                                        <p style="text-align: justify;" class="mb-2">{{$question->answer3}}</p>
                                    @endif
                                </div>
                                <div class="form-check">
                                    @if ($question->correct_answer == 'answer4')
                                        <p style="text-align: justify;" class="mb-2 text-success"><i class="fa fa-check">&nbsp;</i>{{$question->answer4}}</p>
                                    @elseif ($question->myAnswer->answer == 'answer4')
                                        <p style="text-align: justify;" class="mb-2 text-danger"><i class="fa fa-times">&nbsp;</i>{{$question->answer4}}</p>
                                    @else
                                        <p style="text-align: justify;" class="mb-2">{{$question->answer4}}</p>
                                    @endif
                                </div>

                            </div>
                            <div class="row col-md-14 border-t">
                                <div class="col-md-3 pb-0 d-flex justify-content-between align-items-center">
                                    <span>Doğru cevap oranı %</span>
                                    <small style="width: 37px;" class="badge {{$question->TruePercent >= 50 ? 'bg-success' : 'bg-danger' }} rounded-pill">{{$question->TruePercent}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <a href="{{route('home.quiz.detay',$quiz->slug)}}" type="submit" class="btn btn-secondary mb-3 float-end">Detaylara Dön&nbsp;<i class="overflow fa fa-share"></i></a>
            </div>
        </div>
    </div>
</x-app-layout>

