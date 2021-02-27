<x-app-layout>
    <x-slot name="header">{{ __('Quizler ve Quiz işlemleri') }}</x-slot>
    {{--    <div class="py-8">
            <div class="mx-auto sm:py-8 max-w-7xl sm:rounded-lg sm:px-6 lg:px-8">
                <div class="shadow alert alert-success ">

                </div>
            </div>
        </div>--}}
    <div class="mx-auto max-h-scrin sm:py-20 max-w-7xl sm:rounded-lg sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="sm:p-5 sm:pb-1 sm:pt-3 bg-white border-b border-gray-200">
                <div class="card-body">
                    <div class="card-title">
                    </div>
                    <form action="" method="GET">
                        <div class="row mb-3 g-2">
                            <div class="col-md-2">
                                <div class="">
                                    <input type="text" name="title" value="{{request()->get('title')}}" class="form-control" id="floatingInputGrid" placeholder="Quiz Adı">
                                    {{--  <label for="floatingInputGrid">Quiz Adı</label>--}}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="">
                                    <select name="status" class="form-select" onchange="this.form.submit()" id="floatingSelectGrid" aria-label="Floating label select example">
                                        <option selected value="">Seçim Yapınız</option>
                                        <option value="active">Aktif</option>
                                        <option value="passive">Pasif</option>
                                        <option value="draft">Taslak</option>
                                    </select>
                                    {{--<label for="floatingSelectGrid">Seçim yaparak çalışır</label>--}}
                                </div>
                            </div>
                            <div class="col-md-2">
                                @if (request()->get('title') or request()->get('status'))
                                    <div class="">
                                        <a href="{{route('admin.quizzes.index')}}" type="button" class="btn btn-outline-secondary" id="create">
                                            <i class="fa fa-search">&nbsp;</i>{{'Clear!'}}
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="float-end">
                                    <a href="{{route('admin.quizzes.create')}}" type="button" class="btn btn-success" id="create">
                                        <i class="fa fa-plus">&nbsp;</i>{{'Quiz Oluştur'}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col" width="2%">#</th>
                            <th scope="col">Quiz</th>
                            <th scope="col" width="4%">Soru</th>
                            <th scope="col" width="6%">Durum</th>
                            <th scope="col" width="10%">Bitiş Tarihi</th>
                            <th scope="col" width="7%">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($quizzes as $quiz)
                            <tr>
                                <th scope="row">{{ $quiz->id }}</th>
                                <td>{{ $quiz->title }}</td>
                                <td>{{ $quiz->questions_count}}</td>
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
                                        <a href="{{ route('admin.questions.index', $quiz->id) }}" type="button" class="btn btn-sm btn-warning" title="Düzenle"><i class="fa fa-question"></i></a>
                                        <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" type="button" class="btn btn-sm btn-primary" title="Düzenle"><i class="fa fa-pen"></i></a>
                                        <a class="btn btn-sm btn-danger" data-id="{{$quiz->id}}" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Sil"><i class="fa fa-times"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $quizzes->onEachSide(1)->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('admin.quiz.delete')
</x-app-layout>



