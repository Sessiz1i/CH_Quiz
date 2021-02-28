<?php

    namespace App\Http\Controllers;

    use App\Models\Answers;
    use App\Models\Quiz;
    use App\Models\Result;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Contracts\View\View;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\DB;

    class HomeController extends Controller
    {
        public function welcome()
        {
            $quizzes = Quiz::where('status', 'active')->withCount('questions')->paginate(3);
            return view('welcome', compact('quizzes'));
        }

        public function myQuiz()
        {
            return Quiz::where('finished_at', now());
        }

        public function quiz($slug)
        {
        $quiz = Quiz::whereSlug($slug)->withCount('questions')->with('questions.myAnswer','my_result')->first() ?? abort(404, 'Quiz buşlumnalamdı');
            if ($quiz->my_result) return view('home.quiz_result', compact('quiz'));
            return view('home.quiz', compact('quiz'));
        }

        public function detail($slug)
        {

            $quiz = Quiz::whereSlug($slug)->with('my_result', 'topTen.user')->withCount('questions')->first() ?? abort(404, 'Quiz buşlumnalamdı');
            return view('home.quiz_detail', compact('quiz'));
        }

        public function result(Request $request, $slug)
        {

            $quiz = Quiz::whereSlug($slug)->with('questions')->first() ?? abort(404, 'Quiz buşlumnalamdı');

            $correct = 0;
            foreach ($quiz->questions as $question) {
                Answers::create([
                    'user_id' => auth()->user()->id,
                    'question_id' => $question->id,
                    'answer' => $request->post($question->id),
                ]);
                if ($question->correct_answer === $request->post($question->id)) {
                    $correct++;
                }
            }
            Result::create([
                'user_id' => auth()->user()->id,
                'quiz_id' => $quiz->id,
                'point' => round((100 / count($quiz->questions)) * $correct),
                'correct' => $correct,
                'wrong' => count($quiz->questions) - $correct,
            ]);
            return redirect()->route('home.quiz.detay', $quiz->slug)->withInput()->withSuccess('Quiz\i tamamladın. Puanın : ' . round((100 / count($quiz->questions)) * $correct));
        }


        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
            return 'create';
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return Response
         */
        public function store(Request $request)
        {
            return 'store';
        }

        /**
         * Display the specified resource.
         *
         * @param $slug
         * @return Application|Factory|View|Response
         */
        public function show()
        {

        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return Response
         */
        public function edit($id)
        {
            return 'edit';
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return Response
         */
        public function update(Request $request, $id)
        {
            return 'update';
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return Response
         */
        public function destroy($id)
        {
            //
        }
    }
