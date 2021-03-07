<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResult;
use App\Models\Answers;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function welcome(Request $request)
    {


        $timeOuts = Quiz::whereStatus('active')->where('finished_at', '<', now())->get();
        if ($timeOuts)
        {
            foreach ($timeOuts as $timeOut)
            {
                $timeOut->update(['status' => 'passive']);
            }
        }
        $quizzes = Quiz::where('status', 'active')->where(function ($query) {
            $query->whereNull('finished_at')->orWhere('finished_at', '>', now());
        })->withCount('quizList');

        if ($request->title)
        {
            $quizzes = $quizzes->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->status && !Auth::user())
        {
            return redirect('login');
        }
        if ($request->status == 'true')
        {
            $quizzes->withCount('my_result')->has('my_result');
        }
        elseif ($request->status == 'false')
        {
            $quizzes->withCount('my_result')->doesntHave('my_result');
        }

        $quizzes = $quizzes->orderBy('updated_at', 'desc')->paginate(5);
        return view('welcome', compact('quizzes'));
    }

    public function myQuizzes($user)
    {
        // Örnekler
        // Quizzes Tablosuna    Results tablosunu quizzes in id si results un quiz_id sine denk olanları ekledim ve user_id login olanın id sine denk olanlanları çağırdım
        // $quizzes = DB::table('quizzes')->join('results', 'results.quiz_id', 'quizzes.id')->where('user_id', auth()->user()->id)->orderBy('title', 'Asc')->get();
        // $quizzes = DB::table('quizzes')->join('results', 'results.quiz_id', '=', 'quizzes.id')->where('user_id', '=', auth()->user()->id)->paginate(3);

        $quizzes = Quiz::with('my_result')->withCount('quizList')->has('my_result')->orderBy('updated_at', 'desc')->paginate(5);

        return view('welcome', compact('quizzes',));
    }

    public function accessibleQuiz($user)
    {


        $quizzes = Quiz::where('status', 'active')->where(function ($query) {
            $query->whereNull('finished_at')->orWhere('finished_at', '>', now());
        })->with('my_result')->withCount('quizList')->doesntHave('my_result')->orderBy('updated_at', 'desc')->paginate(3);


        return view('welcome', compact('quizzes'));
    }

    public function quiz($slug)
    {
        $quiz = Quiz::whereSlug($slug)->withCount('quizList')->with('quizList.questionList', 'quizList.myAnswer', 'my_result')->first() ?? abort(404, 'Quiz bulunamadı');
        if ($quiz->my_result) return view('home.quiz_result', compact('quiz'));
        return view('home.quiz', compact('quiz'));
    }

    public function detail($slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('my_result', 'topTen.user')->withCount('quizList')->first() ?? abort(404, 'Quiz bulunamadı');
        return view('home.quiz_detail', compact('quiz'));
    }

    /**
     * @param CreateResult $request
     * @param $slug
     * @return CreateResult
     */
    public function result(CreateResult $request, $slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('quizList.questionList')->first() ?? abort(404, 'Quiz bulunamadı');

        $correct = 0;
        foreach ($quiz->quizList as $question)
        {
            Answers::create(['user_id' => auth()->user()->id,
                'question_id' => $question->question_id,
                'answer' => $request->post('question' . $question->question_id),
            ]);

            if ($question->questionList->correct_answer === $request->post('question' . $question->question_id))
            {
                $correct++;
            }
        }
        Result::create(['user_id' => auth()->user()->id,
            'quiz_id' => $quiz->id,
            'point' => round((100 / count($quiz->quizList)) * $correct),
            'correct' => $correct,
            'wrong' => count($quiz->quizList) - $correct,
        ]);
        return redirect()->route('home.quiz.detay', $quiz->slug)->withInput()->withSuccess('Quiz\i tamamladın. Puanın : ' . round((100 / count($quiz->quizList)) * $correct));
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
