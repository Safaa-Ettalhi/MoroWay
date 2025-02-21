<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Answer;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $userQuestionsCount = $user->questions()->count();
        $userAnswersCount = $user->answers()->count();
        $userFavoritesCount = $user->favorites()->count();
        $userPoints = $userQuestionsCount * 10 + $userAnswersCount * 5; 

        $userQuestions = $user->questions()->latest()->get(); 
        $recentQuestions = Question::with('user')->latest()->take(10)->get();

        $mostAnsweredQuestions = Question::withCount('answers')
            ->orderBy('answers_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'userQuestionsCount',
            'userAnswersCount',
            'userFavoritesCount',
            'userPoints',
            'userQuestions',
            'recentQuestions',
            'mostAnsweredQuestions'
        ));
    }
}
