@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 dark:text-white">Tableau de bord</h1>

    <!-- Statistiques de l'utilisateur -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Statistique 1: Questions posées -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-700 dark:text-white">Questions posées</h2>
                <p class="text-2xl font-bold dark:text-white">{{ $userQuestionsCount }}</p>
            </div>
            <div>
                <i class="fas fa-question-circle text-blue-500 dark:text-blue-400 text-3xl"></i>
            </div>
        </div>

        <!-- Statistique 2: Réponses données -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-700 dark:text-white">Réponses données</h2>
                <p class="text-2xl font-bold dark:text-white">{{ $userAnswersCount }}</p>
            </div>
            <div>
                <i class="fas fa-comment-dots text-green-500 dark:text-green-400 text-3xl"></i>
            </div>
        </div>

        <!-- Statistique 3: Favoris -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-700 dark:text-white">Favoris</h2>
                <p class="text-2xl font-bold dark:text-white">{{ $userFavoritesCount }}</p>
            </div>
            <div>
                <i class="fas fa-star text-yellow-500 dark:text-yellow-400 text-3xl"></i>
            </div>
        </div>

        <!-- Statistique 4: Points -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-700 dark:text-white">Points</h2>
                <p class="text-2xl font-bold dark:text-white">{{ $userPoints }}</p>
            </div>
            <div>
                <i class="fas fa-trophy text-purple-500 dark:text-purple-400 text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Liste des questions de l'utilisateur -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold mb-6 dark:text-white border-b-2 border-gray-200 dark:border-gray-700 pb-4">Vos questions récentes</h2>
    @if($userQuestions->count() > 0)
        <div class="space-y-6">
            @foreach($userQuestions as $question)
              <div class="bg-white p-6 rounded-lg shadow-md transition-all duration-300 card-hover dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700 pb-6">
    <h3 class="text-lg font-semibold dark:text-white">
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="data:image/jpeg;base64,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" alt="{{ $question->user->name }}" class="w-12 h-12 rounded-full">
                        <div>
                            <h3 class="font-semibold dark:text-white">{{ $question->user->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $question->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
        <a href="{{ route('questions.show', $question) }}" class="hover:text-blue-600 text-gray-700 dark:hover:text-blue-400 transition-colors duration-300 mt-4">
            {{ $question->title }}
        </a>
    </h3>
    <p class="text-gray-600 dark:text-gray-400 mt-2">{{ Str::limit($question->content, 100) }}</p>
    <div class="flex justify-between items-center mt-4">
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $question->created_at->diffForHumans() }}</span>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $question->answers->count() }} réponses</span>
    </div>

    <div class="mt-4 flex space-x-4">
        <a href="{{ route('questions.show', $question) }}" class="text-blue-600 hover:text-blue-700 flex items-center space-x-2 dark:text-blue-400 dark:hover:text-blue-500">
            <i class="fas fa-eye"></i>
            <span>Voir plus</span>
        </a>

        @auth
            <form action="{{ route('questions.favorite', $question) }}" method="POST">
                @csrf
                <button type="submit" class="text-yellow-600 hover:text-yellow-700 flex items-center space-x-2 dark:text-yellow-400 dark:hover:text-yellow-500">
                    <i class="fas fa-star"></i>
                    <span>{{ Auth::user()->favorites->contains($question) ? 'Retirer des favoris' : 'Ajouter aux favoris' }}</span>
                </button>
            </form>
        @endauth
    </div>
</div>

            @endforeach
        </div>
        
    @else
        <p class="text-gray-600 dark:text-gray-400">Vous n'avez pas encore posé de questions.</p>
    @endif
</div>
<!-- Questions les plus répondues -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mt-4">
    <h2 class="text-xl font-semibold mb-6 dark:text-white border-b-2 border-gray-200 dark:border-gray-700 pb-4">Questions les plus répondues</h2>
    @if($mostAnsweredQuestions->count() > 0)
        <div class="space-y-6">
            @foreach($mostAnsweredQuestions as $question)
                <div class="bg-white p-6 rounded-lg shadow-md transition-all duration-300 card-hover dark:bg-gray-700 border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h3 class="text-lg font-semibold dark:text-white">
                        <div class="flex items-center space-x-4 mb-4">
                            <img src="data:image/jpeg;base64,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" alt="{{ $question->user->name }}" class="w-12 h-12 rounded-full">
                            <div>
                                <h3 class="font-semibold dark:text-white">{{ $question->user->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $question->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <a href="{{ route('questions.show', $question) }}" class="hover:text-blue-600 text-gray-700 dark:hover:text-blue-400 transition-colors duration-300 mt-4">
                            {{ $question->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">{{ Str::limit($question->content, 100) }}</p>
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $question->created_at->diffForHumans() }}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $question->answers->count() }} réponses</span>
                    </div>

                    <div class="mt-4 flex space-x-4">
                        <a href="{{ route('questions.show', $question) }}" class="text-blue-600 hover:text-blue-700 flex items-center space-x-2 dark:text-blue-400 dark:hover:text-blue-500">
                            <i class="fas fa-eye"></i>
                            <span>Voir plus</span>
                        </a>

                        @auth
                            <form action="{{ route('questions.favorite', $question) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-yellow-600 hover:text-yellow-700 flex items-center space-x-2 dark:text-yellow-400 dark:hover:text-yellow-500">
                                    <i class="fas fa-star"></i>
                                    <span>{{ Auth::user()->favorites->contains($question) ? 'Retirer des favoris' : 'Ajouter aux favoris' }}</span>
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600 dark:text-gray-400">Aucune question n'a encore reçu de réponse.</p>
    @endif
</div>

</div>
@endsection
