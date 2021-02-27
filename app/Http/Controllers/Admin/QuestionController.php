<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\QuestionRequest;
    use App\Models\Question;
    use App\Models\Quiz;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
    use SebastianBergmann\CodeCoverage\Driver\Driver;

    class QuestionController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @param $id
         * @return Application|Factory|View
         */
        public function index($id)
        {
            $quiz = Quiz::whereId($id)->with('questions')->first() ?? abort(404, 'Quiz Bulunamadı...');

            $questions = Question::where('quiz_id', '=', $id)->paginate(5);

            return view('admin.question.index', compact('questions', 'quiz'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create($quiz_id)
        {

            $quiz = Quiz::whereId($quiz_id)->first() ?? abort(404, 'Quiz veya Questions Bulunamadı');
            return view('admin.question.create', compact('quiz'));

        }

        /**
         * Store a newly created resource in storage.
         *
         * @param QuestionRequest $request
         * @param $quiz
         * @return Response
         */
        public function store(QuestionRequest $request, $quiz)
        {


            if ($request->hasFile('image')) {
                // Resim için isim oluştur.
                $imgName = Str::slug($request->question) . '.' . $request->image->extension();
                // Resimi taşıma
                $imgPath = $request->image->storeAs('quiz-img', $imgName, 'public');

                // Resim yolu request e eklendi
                $request = $request->merge(['image' => $imgPath]);
            }

            Quiz::find($quiz)->questions()->create($request->post());

            return redirect()->route('admin.questions.index', $quiz)->withSuccess('Questions oluşturma başarılı.');
        }

        /**
         * Display the specified resource.
         *
         * @param Question $question
         * @return Response
         */
        public function show(Question $question)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param Quiz $quiz
         * @param Question $question
         * @return Quiz
         */
        public function edit($quiz, Question $question)
        {

            return view('admin.question.edit', compact('question')) ?? abort(404, 'Quiz veya Question Bulunamadı');
        }

        /**
         * Update the specified resource in storage.
         *
         * @param QuestionRequest $request
         * @param $quiz
         * @param Question $question
         * @return Question
         */
        public function update(QuestionRequest $request, $quiz, Question $question)
        {
            if ($request->hasFile('image')) {

                Storage::delete($question->image);

                $imgName = Str::slug($request->question) . '.' . $request->image->extension();

                $imgPath = $request->file('image')->storeAs('quiz-img', $imgName, 'public');


                $request = $request->merge(['image' => $imgPath]);
            }
            $question->update($request->post()) ?? abort(404, 'Quiz veya Question bulunamadı');

            return redirect()->route('admin.questions.index', $quiz)->withSuccess('Question düzenleme başarılı.');
        }


        /**
         * Remove the specified resource from storage.
         * @param Request $request
         * @return Question
         */
        public function destroy(Request $request)
        {
            $question =Question::find($request->question) ?? abort(404, 'Quiz veya Question bulunamadı');
            $question->delete();
            return back()->withSuccess('Question silme başarılı.');
        }
    }
