<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\AskQuestionRequest;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        DB::enableQueryLog();
        $questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index',compact('questions'));
//        dd(DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title','body'));
        return  redirect()->route('questions.index')->with('success','Your question has been submitted.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');
        return view('questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
//        if(\Gate::allows('update-question',$question)) {
//            return view('questions.edit', compact('question'));
//        }
//        abort(403,'Access Denied.');
        $this->authorize('update',$question);
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        $this->authorize('update',$question);
        $question->update($request->only('title','body'));
        return redirect()->route('questions.index')->with('success','Your question has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
//        if(\Gate::allows('delete-question',$question)) {
//            $question->delete();
//            return back()->with('success','Your question has been deleted.');
//        }
//        abort(403,'Access Denied.');
        $this->authorize('delete',$question);
        $question->delete();
        return back()->with('success','Your question has been deleted.');
    }
}
