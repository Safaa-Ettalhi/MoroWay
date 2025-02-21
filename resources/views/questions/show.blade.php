@extends('layouts.app')

@section('title', $question->title)

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md w-full">
        <h1 class="text-3xl font-bold mb-4">{{ $question->title }}</h1>
        <p class="text-gray-600 mb-4">Posée par {{ $question->user->name }} le {{ $question->created_at->format('d/m/Y') }}</p>
        <p class="text-gray-800 mb-6">{{ $question->content }}</p>
        
        @auth
            <form action="{{ route('questions.favorite', $question) }}" method="POST" class="mb-6">
                @csrf
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    {{ Auth::user()->favorites->contains($question) ? 'Retirer des favoris' : 'Ajouter aux favoris' }}
                </button>
            </form>
        @endauth

        <h2 class="text-2xl font-semibold mb-4">Réponses</h2>
        
        @foreach($question->answers as $answer)
            <div class="bg-gray-100 p-4 rounded-lg mb-4 w-full">
                <p class="mb-2">{{ $answer->content }}</p>
                <p class="text-sm text-gray-600">Répondu par {{ $answer->user->name }} le {{ $answer->created_at->format('d/m/Y') }}</p>
            </div>
        @endforeach

        @auth
            <form action="{{ route('answers.store', $question) }}" method="POST" class="mt-6 w-full">
                @csrf
                <div class="mb-4 w-full">
                    <label for="content" class="block text-gray-700 font-bold mb-2">Votre réponse</label>
                    <textarea name="content" id="content" rows="4" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500" required></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Répondre</button>
            </form>
        @else
            <p class="mt-6 text-gray-600">Connectez-vous pour répondre à cette question.</p>
        @endauth
    </div>
@endsection
