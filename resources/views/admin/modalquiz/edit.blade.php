<x-app-layout>
    <x-slot name="header">{{ __('Quizler ve Quiz işlemleri') }}</x-slot>
    {{--    <div class="py-8">
            <div class="mx-auto sm:py-8 max-w-7xl sm:rounded-lg sm:px-6 lg:px-8">
                <div class="shadow alert alert-success ">

                </div>
            </div>
        </div>--}}
    <div class="mx-auto sm:py-20 max-w-7xl sm:rounded-lg sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="sm:p-5 sm:pb-1 sm:pt-3 bg-white border-b border-gray-200">
                <div class="card-body">
                    <div class="card-title gap-2 d-flex justify-content-end mb-3">
                        <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary">{{'Quizlere Dön'}}&nbsp;<i class="overflow fa fa-share"></i></a>
                    </div>
                    <form method="POST" action="{{route('admin.quizzes.update',$quiz->id)}}" class="needs-validation" novalidate>
                        @csrf @method('put')
                        {{--Title--}}
                        <div class="form-floating mb-3">
                            <input type="text" name="title" id="title" placeholder=" " minlength="10" maxlength="150" required class=" form-control @error('title') is-invalid @enderror"
                                   @if(old('title')) value="{{old('title')}}" @else value="{{$quiz->title}}" @endif> <label for="title">{{ __('Quiz Başlığı') }}</label></input>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong> </span>
                            @enderror
                        </div>
                        {{--Description--}}
                        <div class="form-check mt-3">
                            <input type="checkbox" name="description" id="checkDesc" class="form-check-input" @if(old('description')) checked @elseif($quiz->description) checked @endif>
                            <label class="form-check-label" for="checkDesc">{{ __('Quiz Açıklaması Olsunmu?') }}</label></input>
                        </div>
                        <div class="form-floating mt-3" id="divDesc">
                            <textarea name="description" id="desc" placeholder=" " class="form-control @error('description') is-invalid @enderror" minlength="10" maxlength="500" style="height: 150px"
                                      @if($quiz->description or !old('description') ==='') checked @endif>@if(old('description')){{old('description')}}@else{{$quiz->description}}@endif</textarea>
                            <label for="desc">{{'Quiz Açıklaması İsteğe Bağlı'}}</label>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong><i class="fa fa-times">&nbsp;</i>{{Str::title($message)}}</strong></span>
                            @enderror
                        </div>
                        {{--Status--}}
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-check mt-3">
                                    <input type="checkbox" name="status" id="checkStatus" class="form-check-input" @if($quiz->status or old('status')) checked @endif>
                                    <label class="form-check-label" for="checkStatus">{{ __('Quiz Yayınlansın mı?') }}</label></input>
                                </div>
                                <div class="form-floating mt-3">
                                    <input type="hidden" name="status" value="draft">
                                    <select name="status" id="status" required class="form-select @error('status') is-invalid @enderror" aria-label="Floating label select example">
                                        <option value="">Seçim için tıklayınız.</option>
                                        @if(!$quiz->questions_count < 4)
                                            <option disabled class="text-danger" value="">Aktif edilemez. Soru Sayısı yetersiz...</option>
                                        @elseif(old('status') === 'active' or $quiz->status === 'active' && $quiz->questions_count >= 4)
                                            <option selected value="active">Aktif</option>
                                        @endif
                                        <option @if(old('status') === 'passive' or $quiz->status === 'passive') selected @endif value="passive">Pasif</option>
                                        <option @if(old('status') === 'draft' or $quiz->status === 'draft') selected @endif value="draft">Taslak</option>


                                    </select>
                                    <label>Bir Durum Seçiniz</label>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-check mt-3">
                                    <input type="checkbox" name="finished_at" id="checkFinis" class="form-check-input" @if($quiz->finished_at or old('finished_at')) checked @endif>
                                    <label class="form-check-label" for="checkFinis">{{ __('Quiz Bitiş Tarihi Olsunmu?') }}</label></input>
                                </div>
                                <div class="form-floating mt-3" id="divFinis">
                                    <input type="hidden" name="finished_at" @if(!'checked') value="" @endif >
                                    <input type="datetime-local" name="finished_at" id="finis" class="form-control @error('finished_at') is-invalid @enderror"
                                           @if(old('finished_at')) value="{{date('Y-m-d\TH:i',strtotime(old('finished_at')))}}" @elseif($quiz->finished_at) value="{{date('Y-m-d\TH:i',strtotime($quiz->finished_at))}}" @endif>
                                    <label for="finis">{{ __('Bitiş Tarihi') }}</label>
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
    </div>
    {{--SweetAlert--}}
    {{--   <script>
           if('{{old('description') || $quiz->description}}')
           {
               $('#checkDesc').prop('checked', true);
               $('#desc').prop('disabled', false);
           }
           else
           {
               $('#checkDesc').prop('checked', false);
               $('#desc').prop('disabled', true);
           }
           if ('{{$quiz->status == 'draft'}}')
           {
               $('#checkStatus').prop('checked', false);
               $('#status').prop('disabled', true);
           }
           else
           {
               $('#checkStatus').prop('checked', true);
               $('#status').prop('disabled', false);
           }
           if ('{{$quiz->finished_at ===null || $quiz->finished_at === ''}}') {
               $('#checkFinis').prop('checked', false);
               $('#finis').prop('disabled', true);

           } else {
               $('#checkFinis').prop('checked', true);
               $('#finis').prop('disabled', false);
           }
       </script>--}}
    <script>
        /* Edit Modal */
        $('#checkDesc').change(function () {
            if ($('#checkDesc').is(':checked')) {
                $('#desc').prop("disabled", false);
            } else {
                $('#desc').prop("disabled", true);
                $('#desc').val(null);
                /*   $('#hDesc').val(null);*/
            }
        })
        $('#checkStatus').change(function () {
            if ($('#checkStatus').is(':checked')) {
                $("#status").prop("disabled", false);
                $('#status').val('active');

            } else {
                $("#status").prop("disabled", true);
                $("#status").val('draft');
            }
        })
        $('#checkFinis').change(function () {
            if ($('#checkFinis').is(':checked')) {
                $('#finis').prop("disabled", false);
            } else {
                $("#finis").prop("disabled", true);
                $('#finis').val(null);
            }
        })
    </script>
</x-app-layout>

