<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('user')->latest()->get();
        return view('questions.index', compact('questions'));
    }

    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $validatedData['user_id'] = Auth::id();
        Question::create($validatedData);

        return redirect()->route('questions.index')->with('success', 'Question créée avec succès!');
    }

public function search(Request $request)
{
    $query = $request->input('query');
    $questions = Question::where('title', 'like', "%$query%")
                         ->orWhere('content', 'like', "%$query%")
                         ->with('user')
                         ->get();
    return view('questions.index', compact('questions', 'query'));
}
}