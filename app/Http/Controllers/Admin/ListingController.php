<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateListing;
use App\Models\Listing;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        //
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
     * @param $quizId
     * @return Quiz
     */
    public function store(CreateListing $request, $quizId)
    {


        $questions = Arr::except($request->post(),['_token','quizid']);
        foreach ($questions as $question)
        {
            Listing::create([
                'quiz_id' => $request->quizid, 'question_id' => $question
            ]);
        }
        return redirect()->route('admin.quizzes.index')->withSuccess('Questions ekleme Başarılı.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        return 'Burda';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
