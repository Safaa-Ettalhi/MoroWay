<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        $answer = new Answer($validatedData);
        $answer->user_id = Auth::id();
        $question->answers()->save($answer);

        return redirect()->route('questions.show', $question);
    }
}