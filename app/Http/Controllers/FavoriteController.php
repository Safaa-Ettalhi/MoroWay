<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
  
    public function index()
    {
        $favorites = Auth::user()->favorites()->with('user')->get();
        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Question $question)
    {
        Auth::user()->favorites()->toggle($question);
        return back();
    }
}