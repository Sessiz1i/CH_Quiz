<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Listing;
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

    public function index()
    {
        $questions = Question::paginate(9);

        return view('admin.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionRequest $request
     * @return Response
     */
    public function store(QuestionRequest $request)
    {
        if ($request->hasFile('image'))
        {
            // Resim için isim oluştur.
            $imgName = Str::slug($request->question) . '.' . $request->image->extension();
            // Resimi taşıma
            $imgPath = $request->image->storeAs('quiz-img', $imgName, 'public');

            // Resim yolu request e eklendi
            $request = $request->merge(['image' => $imgPath]);
        }
        $update = Question::create($request->post());
        if ($update)
        {
            return redirect()->route('admin.questions.index')->withSuccess('Questions oluşturma başarılı.');
        }
        else
        {
            return redirect()->route('admin.questions.index')->withErrors('Questions oluşturma başarısız.');
        }

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
     * @param Question $question
     * @return Quiz
     */
    public function edit(Question $question)
    {
        return view('admin.question.edit', compact('question')) ?? abort(404, ' Question Bulunamadı');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionRequest $request
     * @param Question $question
     * @return Question
     */
    public function update(QuestionRequest $request, Question $question)
    {
        if ($request->hasFile('image'))
        {
            Storage::delete($question->image);

            $imgName = Str::slug($request->question) . '.' . $request->image->extension();

            $imgPath = $request->file('image')->storeAs('quiz-img', $imgName, 'public');

            $request = $request->merge(['image' => $imgPath]);
        }

        $update = $question->update($request->post()) ?? abort(404, 'Quiz veya Question bulunamadı');
        if ($update)
        {
            return redirect()->route('admin.questions.index')->withSuccess('Question düzenleme başarılı.');
        }
        else
        {
            return redirect()->route('admin.questions.index')->withSuccess('Bir Hata Oluştu.');
        }
    }


    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return Question
     */
    public function destroy(Request $request)
    {

        $question = Question::find($request->question) ?? abort(404, 'Question bulunamadı');
        $listings = Listing::where('question_id', $question->id)->get();
        Storage::delete($question->image);
        foreach ($listings as $listing){
            $listing->delete();
        }
        $question->delete();
        return back()->withSuccess('Question silme başarılı.');
    }
}
