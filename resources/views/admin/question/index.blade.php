<x-app-layout>
    <x-slot name="header">{{ __('Question İşlemleri Sayfasındasınız') }}</x-slot>
    <div class="sm:pt-14">
        <div class="card col-md-8 mx-auto overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="card-body">
                <div class="card-title gap-2 d-flex justify-content-end">
                    <a href="{{ route('admin.questions.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;{{ __('Soru Oluştur') }}</a>
                    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary">{{ __('Quizlere Dön') }}&nbsp;<i class="fa fa-share"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" class="w-auto">Resim</th>
                            <th scope="col" class="w-25">Soru</th>
                            <th scope="col" class="w-auto">1. Cevap</th>
                            <th scope="col" class="w-auto">2. Cevap</th>
                            <th scope="col" class="w-auto">3. Cevap</th>
                            <th scope="col" class="w-auto">4. Cevap</th>
                            <th scope="col" width="8%">Doğru C.</th>
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
                                <td>{{Str::limit($question->question)}}</td>
                                <td>{{Str::limit($question->answer1)}}</td>
                                <td>{{Str::limit($question->answer2)}}</td>
                                <td>{{Str::limit($question->answer3)}}</td>
                                <td>{{Str::limit($question->answer4)}}</td>
                                <td><strong class="text-success">{{Str::substr($question->correct_answer,-1).'. Cevap'}}</strong></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form method="post" action="{{route('admin.questions.edit',$question->id)}}">
                                            @csrf @method('GET')
                                            <a href="{{route('admin.questions.edit',$question->id)}}" type="button" class="btn btn-sm btn-primary" title="Düzenle"><i class="fa fa-pen"></i></a>
                                        </form>
                                        <button class="btn btn-sm btn-danger" data-question-id="{{$question->id}}" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Sil"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $questions->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
    @include('admin.question.delete')
</x-app-layout>
