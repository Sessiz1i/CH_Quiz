<x-app-layout>
    <x-slot name="header">{{ __('Quizler ve Quiz işlemleri') }}</x-slot>
    <div class="sm:pt-14">
        <div class="col-md-6 p-1 mx-auto overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="card-body">
                <div class="card-title gap-2 d-flex justify-content-end mb-3">
                    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary">{{'Quizlere Dön'}}&nbsp;<i class="overflow fa fa-share"></i></a>
                </div>
                <form method="POST" action="{{route('admin.quizzes.store')}}" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-floating mb-3">
                        {{--Titile--}}
                        <input id="e-title" type="text" name="title" value="{{old('title')}}" placeholder=" " class=" form-control @error('title') is-invalid @enderror" minlength="10" maxlength="150" required>
                        <label for="e-title">{{ __('Quiz Başlığı') }}</label></input>
                        <div class="valid-feedback">
                            <strong><i class="fa fa-check">&nbsp;</i>{{ __('İyi Görünüyor!') }}</strong>
                        </div>
                        <div class="invalid-feedback">
                            <strong><i class="fa fa-times">&nbsp;</i>{{ __('Quiz Başlığı Gereklidir. En Az 10, En Çok 150 Karakter Olmalıdır') }}</strong>
                        </div>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                <strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong> </span>
                        @enderror
                        <div class="form-check mt-3">
                            <input @if (old('description')) checked @endif class="form-check-input" type="checkbox" id="e-checkDesc">
                            <label class="form-check-label" for="e-checkDesc">{{ __('Quiz Açıklaması Olsunmu?') }}</label>
                            </input>
                        </div>
                    </div>
                    <div class="form-floating mt-3" id="e-divDesc">
                            <textarea id="e-desc" name="description" @if (!old('description') or old('description') ==='') disabled @endif placeholder=" " class="form-control @error('description') is-invalid @enderror" style="height: 150px" minlength="10" maxlength="500">{{old('description')
                            }}</textarea>
                        <label for="e-desc">{{'Quiz Açıklaması İsteğe Bağlı'}}</label>
                        <div class="valid-feedback">
                            <strong><i class="fa fa-check">&nbsp;</i>{{ __('İyi Görünüyor!') }}</strong>
                        </div>
                        <div class="invalid-feedback">
                            <strong><i class="fa fa-times">&nbsp;</i>{{ __('Quiz Açıklaması En Az 10, En Çok 500 Karakter Olmalıdır') }}</strong>
                        </div>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                        <strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-check mt-3">
                                <input type="checkbox" id="e-checkStatus" class="form-check-input"
                                    {{(!old('status') || old('status') === 'draft') ? :'checked'}}>
                                <label class="form-check-label" for="e-checkStatus">{{ __('Quiz Yayınlansın mı?') }}</label>
                                </input>
                            </div>
                            <input type="hidden" name="status" value="draft">
                            <div class="form-floating mt-3" id="e-divStatus">
                                <input type="hidden" id="hiddenStatus" name="status" value="draft">
                                <select name="status" @if (!old('status') || old('status') !== 'draft')  @else disabled @endif class="form-select @error('status') is-invalid @enderror" id="e-status" aria-label="Floating label select example" required>
                                    <option @if(old('status') == 'draft') selected @endif value="draft">Taslak</option>
                                    <option @if(old('status') == 'active') selected @endif value="active">Aktif</option>
                                    <option @if(old('status') == 'passive') selected @endif value="passive">Pasif</option>
                                </select>
                                <label>Bir Durum Seçiniz</label>
                                <div class="valid-feedback">
                                    <strong><i class="fa fa-check">&nbsp;</i>{{ __('İyi Görünüyor!') }}</strong>
                                </div>
                                <div class="invalid-feedback">
                                    <strong><i class="fa fa-times">&nbsp;</i>{{ __('Quiz Durumu Gereklidir') }}</strong>
                                </div>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong>
                                 </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check mt-3">
                                <input @if (old('finished_at')) checked @endif class="form-check-input" type="checkbox" id="e-checkFinis">
                                <label class="form-check-label" for="e-checkFinis">{{ __('Quiz Bitiş Tarihi Olsunmu?') }}</label>
                                </input>
                            </div>
                            <div class="form-floating mt-3" id="e-divFinis">
                                <input id="e-finis" type="datetime-local" name="finished_at" value="{{old('finished_at')}}" @if (!old('finished_at')) disabled @endif class="form-control @error('finished_at') is-invalid @enderror">
                                <label for="e-finis">{{ __('Bitiş Tarihi') }}</label>
                                @error('finished_at')
                                <span class="invalid-feedback blog" role="alert"><strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="gap-2 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success">{{ __('Düzenle') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        /* Edit Modal */
        $('#e-checkDesc').change(function () {
            if ($('#e-checkDesc').is(':checked')) {
                $('#e-desc').prop("disabled", false);
            } else {
                $('#e-desc').prop("disabled", true);
            }
        })
        $('#e-checkStatus').change(function () {
            if ($('#e-checkStatus').is(':checked')) {
                $("#e-status").prop("disabled", false);
                $('#e-status').val('active');
                $('#hiddenStatus').val('draft');
            } else {
                $("#e-status").prop("disabled", true);
                $('#e-status').val('draft');
                $('#hiddenStatus').val('draft');
            }
        })
        $('#e-checkFinis').change(function () {
            if ($('#e-checkFinis').is(':checked')) {
                $('#e-finis').prop("disabled", false);
            } else {
                $("#e-finis").prop("disabled", true);
            }
        })
    </script>
</x-app-layout>

