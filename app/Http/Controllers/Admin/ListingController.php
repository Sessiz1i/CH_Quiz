<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateListing;
use App\Models\Listing;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Requests\QuizEdit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $quiz
     * @return Quiz
     */
    public function index(Quiz $quiz)
    {

        $quiz = $quiz->withCount('quizList')->find($quiz->id);
        $listings = Listing::whereQuizId($quiz->id)->with('questionList')->get();
        return view('admin.add-question.index', compact('quiz', 'listings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param $quizId
     * @return void
     */
    public function create(Request $request, $quizId)
    {
        $quiz = Quiz::find($quizId) ?? abort(404, 'Quiz Bulunamadı');

        if ($request->title)
        {
            $questions = Question::where('question', 'LIKE', '%' . $request->title . '%')->get();
        }
        else
        {
            $questions = Question::all();
        }

        return view('admin.add-question.create', compact('quiz', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param CreateListing $request
     * @param Quiz $quiz
     * @return Quiz
     */
    public function store(CreateListing $request, Quiz $quiz)
    {
        $questions = Arr::except($request->post(), ['_token', 'quizid']);
        foreach ($questions as $question)
        {
            Listing::create([
                'quiz_id' => $request->quizid,
                'question_id' => $question,
            ]);
        }
        return redirect()->route('admin.add-question.index', compact('quiz'))->withSuccess('Questions ekleme Başarılı.');
    }

    /**
     * Display the specified resource.
     *
     * @param Listing $listing
     * @return Response
     */
    public function show(Listing $listing)
    {
        return $listing;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Quiz $quiz
     * @return Response
     */
    public function edit(Quiz $quiz)
    {
        $quiz = $quiz->withCount('quizList')->find($quiz->id);

        return view('admin.quiz.edit', compact('quiz'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Quiz $quiz
     * @return Quiz
     */
    public function update(Request $request, Quiz $quiz)
    {
        $quiz->update($request->post()) ?? abort(404, 'quiz bulunamadı');

        return redirect()->route('admin.add-question.index', compact('quiz'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param QuizEdit $request
     * @param Quiz $quiz
     * @return RedirectResponse
     */
    /*    public function update(QuizEdit $request, Quiz $quiz): RedirectResponse
        {
            $quiz->update($request->post()) ?? abort(404, 'Quiz Bulunamadı.');

            return redirect()->route('admin.quizzes.index',compact('quiz'))->withSuccess('Quiz güncelleme başarılı');
        }*/


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Quiz $quiz
     * @param $question
     * @return Request
     */
    public function destroy(Request $request, Quiz $quiz, $question)
    {
        $listings = Listing::whereQuizId($request->quiz)->get();
        foreach ($listings as $listing) $listing->delete();
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->withSuccess('quiz silme başarılı');
    }

}

