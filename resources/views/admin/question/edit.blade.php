<x-app-layout>
    <x-slot name="header">{{ __('Question Düzenleme Sayfasındasınız') }}</x-slot>
    <div class="sm:pt-14">
        <div class="card col-md-6 mx-auto overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="card-body">
                {{-- Image Input --}}
                @if ($question->image)
                    <div class="mb-3">
                        <a href="{{asset($question->image)}}" target="_blank"><img width="300" class="img-thumbnail" src="{{asset($question->image)}}" alt="{{Str::title($question->question)}}" title="{{Str::title($question->question)}}"></a>
                    </div>
                @endif
                <div class="card-title d-flex justify-content-end">
                    <a  href="{{ route('admin.questions.index') }}" class="btn btn-secondary">{{ __('Geri Dön') }}&nbsp;<i class="fa fa-share"></i></a>
                </div>
                <form method="POST" action="{{route('admin.questions.update',$question->id)}}" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf @method('PUT')
                    <div class="input-group mb-2">
                        <input id="imageInput" type="file" name="image" value="{{$question->image}}" class="form-control @error('image') is-invalid @enderror" placeholder="Resim seçiniz">
                        <label class="input-group-text" for="imageInput">{{ __('Resim ekleyebilirsiniz ( İsteğe bağlı )') }}</label></input>
                        @error('image')
                        <span class="invalid-feedback" role="alert"><strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong></span>
                        @enderror
                    </div>
                    {{-- Soru Input --}}
                    <div class="form-floating mb-2">
                        <textarea id="questionTextarea" name="question" value="{{old('question')}}" class="form-control @error('question') is-invalid @enderror " placeholder=" " style="height: 100px">{{$question->question}}</textarea>
                        <label for="questionTextarea">{{ __('Lütfen yeni bir Soru yazınız...') }}</label>
                        @error('question')
                        <span class="invalid-feedback" role="alert">
                        <strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong>
                    </span>
                        @enderror
                    </div>
                    {{-- Cevap Input --}}
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating mb-2">
                                <textarea id="answer1" name="answer1" class="form-control @error('answer1') is-invalid @enderror " placeholder=" " style="height: 100px">{{$question->answer1}}</textarea>
                                <label for="answer1">{{ __('Lütfen 1. Cevabı yazınız...') }}</label>
                                @error('answer1')
                                <span class="invalid-feedback" role="alert"><strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-2">
                                <textarea id="answer2" name="answer2" class="form-control @error('answer2') is-invalid @enderror " placeholder=" " style="height: 100px">{{$question->answer2}}</textarea>
                                <label for="answer2">{{ __('Lütfen 2. Cevabı yazınız...') }}</label>
                                @error('answer2')
                                <strong class="invalid-feedback" role="alert"><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating mb-2">
                                <textarea id="answer3" name="answer3" class="form-control @error('answer3') is-invalid @enderror " placeholder=" " style="height: 100px">{{$question->answer3}}</textarea>
                                <label for="answer3">{{ __('Lütfen 3. Cevabı yazınız...') }}</label>
                                @error('answer3')
                                <span class="invalid-feedback" role="alert"><strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-2">
                                <textarea id="answer4" name="answer4" class="form-control @error('answer4') is-invalid @enderror " placeholder=" " style="height: 100px">{{$question->answer4}}</textarea>
                                <label for="answer4">{{ __('Lütfen 4. Cevabı yazınız...') }}</label>
                                @error('answer4')
                                <strong class="invalid-feedback" role="alert"><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- Doğru Cevap Input --}}
                    <div class="form-floating mb-2">
                        <select name="correct_answer" class="form-select @error('correct_answer') is-invalid @enderror" id="status" aria-label="Floating label select example" required>
                            <option value="">Seçim için tıklayınız.</option>
                            <option @if($question->correct_answer === 'answer1') selected @endif value="answer1">1. Cevap</option>
                            <option @if($question->correct_answer === 'answer2') selected @endif value="answer2">2. Cevap</option>
                            <option @if($question->correct_answer === 'answer3') selected @endif value="answer3">3. Cevap</option>
                            <option @if($question->correct_answer === 'answer4') selected @endif value="answer4">4. Cevap</option>
                        </select>
                        <label>{{ __('Doğru Cevabı Seçiniz...') }}</label>
                        <div class="valid-feedback">
                            <strong><i class="fa fa-check">&nbsp;</i>{{ __('İyi Görünüyor!') }}</strong>
                        </div>
                        <div class="invalid-feedback">
                            <strong><i class="fa fa-times">&nbsp;</i>{{ __('Doğru cevap gereklidir') }}</strong>
                        </div>
                        @error('correct_answer')
                        <span class="invalid-feedback" role="alert"><strong><i class="fa fa-times">&nbsp;</i>{{ Str::title($message) }}</strong></span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success float-end">{{ __('Düzenle') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

