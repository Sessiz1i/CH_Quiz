<x-app-layout>
    <x-slot name="header">{{ __($quiz->title.' - Quiz\'ine Ait Sorular') }}</x-slot>
    <div class="sm:pt-14">
        <div class="col-md-7 mx-auto overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="card-body table-responsive-sm">
                <div class="card-title gap-2 d-flex justify-content-end mb-3">
                    <a href="{{route('admin.questions.create',$quiz->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;{{ __('Soru Oluştur') }}</a>
                    <a href="{{route('admin.quizzes.index')}}" class="btn btn-secondary">{{ __('Quizlere Dön') }}&nbsp;<i class="fa fa-share"></i></a>
                </div>
                <table class="table table-hover table-bordered mt-3">
                    <thead>
                    <tr>
                        <th scope="col" width="5%">#</th>
                        <th scope="col">Resim</th>
                        <th scope="col">Soru</th>
                        <th scope="col">1. Cevap</th>
                        <th scope="col">2. Cevap</th>
                        <th scope="col">3. Cevap</th>
                        <th scope="col">4. Cevap</th>
                        <th scope="col" width="8%">Doğru C.</th>
                        {{--    <th scope="col" width="15%">Durum</th>
                            <th scope="col" width="13%">Bitiş Tarihi</th>--}}
                        <th scope="col" width="5%">İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <th scope="row">{{$question->id}}</th>
                            <td>
                                @if ($question->image)
                                    <a href="{{asset($question->image)}}" target="_blank"><img width="75" src="{{asset($question->image)}}" alt="{{Str::title($question->question)}}" title="{{Str::title($question->question)}}" class="img-thumbnail"></a>
                                @endif
                            </td>
                            <td>{{Str::limit($question->question,15,' ...')}}</td>
                            <td>{{Str::limit($question->answer1,15,' ...')}}</td>
                            <td>{{Str::limit($question->answer2,15,' ...')}}</td>
                            <td>{{Str::limit($question->answer3,15,' ...')}}</td>
                            <td>{{Str::limit($question->answer4,15,' ...')}}</td>
                            <td><strong class="text-success">{{Str::substr($question->correct_answer,-1).'. Cevap'}}</strong></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form method="post" action="{{route('admin.questions.edit',[$quiz->id,$question->id])}}">
                                        @csrf @method('GET')
                                        <a href="{{route('admin.questions.edit',[$quiz->id,$question->id])}}" type="button" class="btn btn-sm btn-primary" title="Düzenle"><i class="fa fa-pen"></i></a>
                                    </form>
                                    <button class="btn btn-sm btn-danger" data-quiz-id="{{$quiz->id}}" data-question-id="{{$question->id}}" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Sil"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $questions->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
    @include('admin.question.delete')
</x-app-layout>
