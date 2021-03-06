<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {

        $question->answers()->create($request->validate([

            'description' => 'required'
        ])+ [

            'user_id'    => Auth::id()

            ]);

        return back()->with('success',"Your answer has been submitted successfully");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question,  Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->validate([
            'description' => 'required'
        ]));

        return redirect()->route('questions.show', $question->slug)
            ->with('success', 'Your answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();
        return back()->with('success',  'Your answer been removed');
    }
}

//
//$request->validate([
//    'description' => 'required'
//]);
//
//$question->answers()->create([
//    'description'=> $request->description,
//    'user_id'    => \Auth::id()
//]);