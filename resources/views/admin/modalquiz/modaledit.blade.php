


<!-- Edit Modal -->
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>{{ __('Quiz Düzenle') }}</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('admin.quizzes.update',"id")}}" class="needs-validation" novalidate>
                @csrf @method('patch')
                <div class="modal-body p-4">
                    <div class="form-floating mb-3">
                        {{--Titile--}}
                        <input type="hidden" name="id" id="id" value="{{old('id')}}">
                        <input type="text" name="title" value="{{old('title')}}" class=" form-control @error('title') is-invalid @enderror" id="e-title" placeholder="Quiz Başlığı" minlength="10" maxlength="150" required>
                        <label for="e-title">{{ __('Quiz Başlığı') }}</label>
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
                    <div class="form-check mt-3">
                        <input @if(old('description')) checked @endif class="form-check-input" type="checkbox" id="e-checkDesc">
                        <label class="form-check-label" for="e-checkDesc">{{ __('Quiz Açıklaması Olsunmu?') }}</label>
                        </input>
                    </div>
                    <div class="form-floating mt-3" id="e-divDesc">
                        <textarea id="e-desc" name="description" value="{{old('title')}}" placeholder=" " class="form-control @error('description') is-invalid @enderror" style="height: 150px" minlength="10" maxlength="500">{{old('description')}}</textarea>
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
                                <input @if(old('status')) checked @endif class="form-check-input" type="checkbox" id="e-checkStatus">
                                <label class="form-check-label" for="e-checkStatus">{{ __('Quiz Yayınlansın mı?') }}</label>
                                </input>
                            </div>
                            <div class="form-floating mt-3" id="e-divStatus">
                                <input type="hidden" id="hiddenStatus" name="status">
                                <select name="status" class="form-select @error('status') is-invalid @enderror" id="e-status" aria-label="Floating label select example" required>
                                    <option value="">Seçim için tıklayınız.</option>
                                    <option @if(old('status') == 'active') value="{{ old('status') }}" selected @endif value="active">Aktif</option>
                                    <option @if(old('status') == 'passive') value="{{ old('status') }}" selected @endif value="passive">Pasif</option>
                                    <option @if(old('status') == 'draft') value="{{ old('status') }}" selected @endif value="draft">Taslak</option>
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
                                <input @if(old('finished_at')) checked @endif class="form-check-input" type="checkbox" id="e-checkFinis">
                                <label class="form-check-label" for="e-checkFinis">{{ __('Quiz Bitiş Tarihi Olsunmu?') }}</label>
                                </input>
                            </div>
                            <div class="form-floating mt-3" id="e-divFinis">
                                <input id="e-finis" type="datetime-local" name="finished_at" class="form-control @error('finished_at') is-invalid @enderror">
                                <label for="e-finis">{{ __('Bitiş Tarihi') }}</label>
                                @error('finished_at')
                                <span class="invalid-feedback blog" role="alert"><strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Kapat') }}</button>
                    <button type="submit" for="submit" class="btn btn-success">{{ __('Düzenle') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    /* Modal Script Edit */
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var title = button.data('title')
        var status = button.data('status')
        var desc = button.data('desc')
        var finish = button.data('finish')
        var modal = $(this)

        if (!desc || desc ==='') {
            $('#e-checkDesc').prop('checked', false);
            $('#e-desc').val(null);
            $('#e-desc').prop('disabled', true);

        } else {
            $('#e-checkDesc').prop('checked', true);
        }
        if (status === 'draft') {
            $('#e-checkStatus').prop('checked', false);
            $('#e-status').prop('disabled', true);
        } else {
            $('#e-checkStatus').prop('checked', true);
            $('#e-status').prop('disabled', false);

        }
        if (finish === '') {
            $('#e-checkFinis').prop('checked', false);
            $('#e-finis').prop('disabled', true);

        } else {
            $('#e-checkFinis').prop('checked', true);
            $('#e-finis').prop('disabled', false);
        }

        if (id > 0) {
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #e-title').val(title);
            modal.find('.modal-body #e-status').val(status);
            modal.find('.modal-body #hiddenStatus').val(status);
            modal.find('.modal-body #e-desc').val(desc);
            modal.find('.modal-body #e-finis').val(finish);
        }
    })
    /* Edit Modal */
    $('#e-checkDesc').change(function () {
        if ($('#e-checkDesc').is(':checked')) {
            $('#e-desc').prop("disabled", false);
        } else {
            $('#e-desc').prop("disabled", true);
            $('#e-desc').val(null);
        }
    })
    $('#e-checkStatus').change(function () {
        if ($('#e-checkStatus').is(':checked')) {
            $("#e-status").prop("disabled", false);
            $('#e-status').val('active');
            $('#hiddenStatus').val('active');
        } else {
            $("#e-status").prop("disabled", true);
            $('#e-status').val('passive');
            $('#hiddenStatus').val('passive');
        }
    })
    $('#e-checkFinis').change(function () {
        if ($('#e-checkFinis').is(':checked')) {
            $('#e-finis').prop("disabled", false);
        } else {
            $("#e-finis").prop("disabled", true)
            $('#e-finis').val(null);
        }
    })
</script>
@if (auth()->user()->role == 'admin')

@else
    <script>
        $('#e-checkStatus').prop('disabled', false);
        $('#e-status').prop('disabled', false);
    </script>
@endif



