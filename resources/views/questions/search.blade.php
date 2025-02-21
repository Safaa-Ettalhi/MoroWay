@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Résultats de recherche pour "{{ $query }}"</h1>

    @if($questions->count() > 0)
        @foreach($questions as $question)
            <div class="bg-white p-4 rounded shadow mb-4">
                <h2 class="text-xl font-bold mb-2">
                    <a href="{{ route('questions.show', $question) }}">{{ $question->title }}</a>
                </h2>
                <p class="text-gray-600 mb-2">Posée par {{ $question->user->name }} le {{ $question->created_at->format('d/m/Y') }}</p>
                <p class="mb-2">{{ Str::limit($question->content, 100) }}</p>
                <a href="{{ route('questions.show', $question) }}" class="text-blue-500">Lire la suite</a>
            </div>
        @endforeach
    @else
        <p>Aucun résultat trouvé pour "{{ $query }}".</p>
    @endif
@endsection