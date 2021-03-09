<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizCreate;
use App\Http\Requests\QuizEdit;
use App\Models\Quiz;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Listing;
use App\Models\Question;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {

        $quizzes = Quiz::withCount('quizList');

        if ($request->title)
        {
            $quizzes = $quizzes->where('title', 'LIKE', '%' . $request->title . '%');
        }
        if ($request->status)
        {
            $quizzes = $quizzes->where('status', $request->status);
        }
        $quizzes = $quizzes->paginate(9);
        return view('admin.quiz.index', compact('quizzes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuizCreate $request
     * @return Response
     */
    public function store(QuizCreate $request)
    {
        Quiz::create($request->post()) ?? abort(404, 'Sayfa bulunamadı');
        return redirect()->route('admin.quizzes.index')->withSuccess('Quiz oluşturma başarılı.');
    }

    /**
     * Display the specified resource.
     *
     * @param Quiz $quiz
     * @return Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Quiz $quiz
     * @return void
     */
    public function edit(Request $request, Quiz $quiz)
    {
        $submit = $request->post('submit');
        $quiz = Quiz::withCount('quizList')->find($quiz->id);
        return view('admin.quiz.edit', compact('quiz', 'submit'))->withInput($quiz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuizEdit $request
     * @param Quiz $quiz
     * @return RedirectResponse
     */
    public function update(QuizEdit $request, Quiz $quiz)
    {
        $quiz->update($request->post()) ?? abort(404, 'Quiz Bulunamadı.');

        return redirect()->route('admin.' . $request->submit . '.index', compact('quiz'))->withSuccess('Quiz güncelleme başarılı');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Quiz $quiz
     * @return
     * @throws \Exception
     */
    public function destroy(Request $request, Quiz $quiz)
    {
        if (isset($request->quiz))
        {
            $listings = Listing::whereQuizId($request->quiz)->get();
            foreach ($listings as $listing) $listing->delete();
            $quiz->delete();
        }
        else
        {
            $question = Question::find($request->question);
            return $question;
            $request->question->delete();
        }

        return redirect()->route('admin.quizzes.index')->withSuccess('quiz silme başarılı');
    }
}
