<x-app-layout>
    <x-slot name="header">{{ __('Quiz İşlemleri Sayfasındasınız') }}</x-slot>
    <div class="sm:pt-14">
        <div class="card col-md-7 mx-auto overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="card-body">
                <div class="card-title">
                    <form class="row g-2" action="" method="GET">
                        <div class="col-md-2">
                            <input type="text" name="title" value="{{request()->get('title')}}" class="form-control" id="floatingInputGrid" placeholder="Quiz Ara...">
                            {{--  <label for="floatingInputGrid">Quiz Adı</label>--}}
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-select" onchange="this.form.submit()" id="floatingSelectGrid" aria-label="Floating label select example">
                                <option selected value="">Seçim Yapınız</option>
                                <option value="active">Aktif</option>
                                <option value="passive">Pasif</option>
                                <option value="draft">Taslak</option>
                            </select>
                            {{--<label for="floatingSelectGrid">Seçim yaparak çalışır</label>--}}
                        </div>
                        <div class="col-md-2">
                            @if (request()->get('title') or request()->get('status'))
                                <a href="{{route('admin.quizzes.index')}}" type="button" class="btn btn-outline-secondary" id="create">
                                    <i class="fa fa-search">&nbsp;</i>{{'Clear!'}}</a>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('admin.quizzes.create')}}" type="button" class="btn btn-success float-end" id="create">
                                <i class="fa fa-plus">&nbsp;</i>{{'Quiz Oluştur'}}
                            </a>
                        </div>
                    </form>
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
                            <th scope="col" width="7%">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($quizzes as $quiz)
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
                                {{-- <td>@if ($quiz->finished_at) {{date('d-m-Y H:i',strtotime($quiz->finished_at->diffForHumans()))}} @endif </td>--}}
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.add-question.create', $quiz->id) }}" type="button" class="btn btn-sm btn-warning" title="Quistion Ekle Düzenle"><i class="fa fa-question"></i></a>
                                        <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" type="button" class="btn btn-sm btn-primary" title="Düzenle"><i class="fa fa-pen"></i></a>
                                        <a class="btn btn-sm btn-danger" data-id="{{$quiz->id}}" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Sil"><i class="fa fa-times"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $quizzes->onEachSide(1)->withQueryString()->links() }}
            </div>
        </div>
    </div>
    @include('admin.quiz.delete')
</x-app-layout>




