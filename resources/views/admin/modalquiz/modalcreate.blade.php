<!-- Create Modal -->
<div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>{{ __('Quiz Oluştur') }}</strong></h5>
                <a href="{{route('admin.quizzes.index')}}"  class="btn-close" aria-label="Close"></a>
            </div>
            <form method="POST" action="{{route('admin.quizzes.store')}}" class="needs-validation" novalidate>
                @csrf

                <div class="modal-body p-4">
                    <div class="form-floating mb-3">
                        {{--Titile--}}
                        <input type="text" name="title" value="{{old('title')}}" class=" form-control @error('title') is-invalid @enderror" id="c-title" placeholder="Quiz Başlığı" minlength="10" maxlength="150" required>
                        <label for="c-title">{{ __('Quiz Başlığı') }}</label>
                        <div class="valid-feedback">
                            <strong><i class="fa fa-check">&nbsp;</i>{{ __('İyi Görünüyor!') }}</strong>
                        </div>
                        <div class="invalid-feedback">
                            <strong><i class="fa fa-times">&nbsp;</i>{{ __('Quiz Başlığı Gereklidir. En Az 10, En Çok 150 Karakter Olmalıdır') }}</strong>
                        </div>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                        <strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong>
                        </span>
                        @enderror
                    </div>
                    {{-- Description--}}
                    <div class="form-check mt-3">
                        <input @if(old('description')) checked @endif class="form-check-input" type="checkbox" id="c-checkDesc" style="cursor: pointer;">
                        <label class="form-check-label" for="c-checkDesc" style="cursor: pointer;">{{ __('Quiz Açıklaması Olsun mu?') }}</label>
                        </input>
                    </div>
                    <div @if(!old('description'))  style="display: none" @endif id="c-divDesc" class="form-floating mt-3">
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"  id="c-Desc" style="height: 150px" minlength="10" placeholder=" "
                                  maxlength="500">{{old('description')}}</textarea>
                        <label for="c-desc">{{ __('Quiz Açıklaması') }}</label>
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
                    {{--Finished At--}}
                    <div class="form-check mt-3">
                        <input @if(old('finished_at')) checked @endif class="form-check-input" type="checkbox" id="c-checkFinis">
                        <label class="form-check-label" for="c-checkFinis">{{ __('Quiz Bitiş Tarihi Olsun mu?') }}</label>
                        </input>
                    </div>
                    <div @if(!old('finished_at'))  style="display: none" @endif id="c-divFinis" class="form-floating mt-3">
                        <input type="datetime-local" name="finished_at" value="{{old('finished_at')}}" class="form-control @error('finished_at') is-invalid @enderror" id="c-Finis" placeholder="Quiz Başlığı">
                        <label for="c-inputFinis">{{ __('Bitiş Tarihi') }}</label>
                        @error('finished_at')
                        <span class="invalid-feedback blog" role="alert">
                        <strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>
                {{--Button--}}
                <div class="modal-footer">
                    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary" >{{ __('Kapat') }}</a>
                    <button type="submit" for="submit" class="btn btn-success">{{ __('Oluştur') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    /* Create Modal */
    $('#c-checkDesc').change(function () {
        if ($('#c-checkDesc').is(':checked')) {
            $('#c-divDesc').show();
        } else {
            $('#c-divDesc').hide();
            $('#c-Desc').val(null);
        }
    })
    $('#c-checkFinis').change(function () {
        if ($('#c-checkFinis').is(':checked')) {
            $('#c-divFinis').show();
        } else {
            $('#c-divFinis').hide();
            $('#c-Finis').val(null);
        }
    })
</script>


