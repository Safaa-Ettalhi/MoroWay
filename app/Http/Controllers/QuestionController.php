<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
{
    $questions = Question::with('user')->latest()->paginate(5); // 10 questions par page
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
    
    $questions = Question::where(function($q) use ($query) {
        $q->where('title', 'like', "%{$query}%")
          ->orWhere('content', 'like', "%{$query}%");
    })
    ->with('user')
    ->latest()
    ->paginate(5);
    
    if($request->ajax()) {
        return response()->json([
            'questions' => $questions,
            'html' => view('questions._list', compact('questions'))->render()
        ]);
    }
    
    return view('questions.index', compact('questions', 'query'));
}
public function popular()
{
    $questions = Question::withCount('favorites')
        ->orderByDesc('favorites_count')
        ->paginate(3);
    
    return view('questions.index', [
        'questions' => $questions,
        'activeFilter' => 'popular'
    ]);
}

public function recent()
{
    $questions = Question::latest()
        ->paginate(4);
    
    return view('questions.index', [
        'questions' => $questions,
        'activeFilter' => 'recent'
    ]);
}
}