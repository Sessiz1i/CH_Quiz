<x-app-layout>
    <x-slot name="header">{{ __('Quiz için Question İşlemleri') }}</x-slot>
    <div class="sm:pt-14">
        <div class="card col-md-7 mx-auto overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="card-body">
                <div class="card-title">
                    {{--     <form class="row g-2" action="" method="GET">
                             <div class="col-md-2">
                                 <input type="text" name="title" value="{{request()->get('title')}}" class="form-control" id="floatingInputGrid" placeholder="Quiz Ara...">
                             </div>
                             <div class="col-md-2">
                                 <select name="status" class="form-select" onchange="this.form.submit()" id="floatingSelectGrid" aria-label="Floating label select example">
                                     <option selected value="">Seçim Yapınız</option>
                                     <option value="active">Aktif</option>
                                     <option value="passive">Pasif</option>
                                     <option value="draft">Taslak</option>
                                 </select>
                             </div>
                             <div class="col-md-2">
                                 --}}{{--  @if (request()->get('title') or request()->get('status'))
                                       <a href="{{route('admin.quizzes.index')}}" type="button" class="btn btn-outline-secondary" id="create">
                                           <i class="fa fa-search">&nbsp;</i>{{'Clear!'}}</a>
                                   @endif--}}{{--
                             </div>
                             <div class="col-md-6">
                                 <a href="{{route('admin.quizzes.create')}}" type="button" class="btn btn-success float-end" id="create">
                                     <i class="fa fa-plus">&nbsp;</i>{{'Quiz Oluştur'}}
                                 </a>
                             </div>
                         </form>--}}
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col" width="2%">#</th>
                            <th scope="col">Quiz</th>
                            <th scope="col" width="4%">Soru</th>
                            <th scope="col" width="6%">Durum</th>
                            <th scope="col" width="11%">Bitiş Tarihi</th>
                            <th scope="col" width="16%">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">{{ $quiz->id }}</th>
                            <td>{{ $quiz->title }}</td>
                            <td>{{ $quiz->quiz_list_count}}</td>
                            <td>
                                @if ($quiz->status == 'active')
                                    <span style="width: 100%" class="badge bg-success">Aktif</span>
                                @endif
                                @if ($quiz->status == 'passive')
                                    <span style="width: 100%" class="badge bg-danger">Pasif</span>
                                @endif
                                @if ($quiz->status == 'draft')
                                    <span class="badge bg-warning text-dark">Taslak</span>
                                @endif
                            </td>
                            <td><span title="{{ $quiz->finished_at }}">{{$quiz->finished_at ? $quiz->finished_at->diffForHumans() : null }}</span></td>
                            <td>
                                <div class="btn-group d-flex" role="group">
                                    <a href="{{ route('admin.add-question.create', $quiz->id) }}" type="button" class="btn btn-sm btn-warning" title="Quistion Ekle">
                                        <i class="fa fa-question">&nbsp;</i></a>
                                    <a href="{{ route('admin.quizzes.edit', [$quiz->id,'submit=add-question']) }}" type="button" class="btn btn-sm btn-primary" title="Düzenle"><i class="fa fa-pen"></i></a>
                                    <button name="" class="btn btn-sm btn-danger" data-quiz-id="{{ $quiz->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Sil"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    @isset($listings[0])
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="9%">Resim</th>
                                <th scope="col" 25class="w-">Soru</th>
                                {{-- <th scope="col" class="w-auto">1. Cevap</th>
                                     <th scope="col" class="w-auto">2. Cevap</th>
                                     <th scope="col" class="w-auto">3. Cevap</th>
                                     <th scope="col" class="w-auto">4. Cevap</th>
                                     <th scope="col" width="8%">Doğru C.</th>--}}
                                <th scope="col" width="5%">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listings as $question)
                                <tr>
                                    <th scope="row">{{$question->questionList->id}}</th>
                                    <td>
                                        @if ($question->questionList->image)
                                            <a href="{{asset($question->questionList->image)}}" target="_blank"><img width="75" src="{{asset($question->questionList->image)}}" alt="{{Str::title($question->questionList->question)}}" title="{{Str::title($question->questionList->question)}}" class="img-thumbnail d-flex"></a>
                                        @endif
                                    </td>
                                    <td>{{Str::limit($question->questionList->question)}}</td>
                                    {{--      <td>{{Str::limit($question->questionList->answer1)}}</td>
                                          <td>{{Str::limit($question->questionList->answer2)}}</td>
                                          <td>{{Str::limit($question->questionList->answer3)}}</td>
                                          <td>{{Str::limit($question->questionList->answer4)}}</td>
                                          <td><strong class="text-success">{{Str::substr($question->questionList->correct_answer,-1).'. Cevap'}}</strong></td>--}}
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{route('admin.questions.edit',[$question->questionList->id,'submit=add-question','quiz='.$quiz->id])}}" type="button" class="btn btn-sm btn-primary" title="Düzenle"><i class="fa fa-pen"></i></a>
                                            <a href="{{ route('admin.questions.destroy',$question) }}" class="btn btn-sm btn-danger" title="Sil"><i class="fa fa-times"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    @include('admin.add-question.delete')
</x-app-layout>




