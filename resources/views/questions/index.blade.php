@extends('layouts.app')

@section('title', 'Questions récentes')

@section('content')
    <aside class="w-1/4 bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">Filtres</h2>
        <ul class="space-y-2">
    <li>
        <a href="{{ route('questions.index') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 p-2 rounded-lg dark:text-gray-300 dark:hover:text-blue-400 {{ request()->routeIs('questions.index') && !request()->has('filter') ? 'bg-blue-50 text-blue-600' : '' }}">
            <i class="fas fa-list"></i>
            <span>Toutes les questions</span>
        </a>
    </li>
    <li>
        <a href="{{ route('questions.popular') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 p-2 rounded-lg dark:text-gray-300 dark:hover:text-blue-400 {{ request()->routeIs('questions.popular') ? 'bg-blue-50 text-blue-600' : '' }}">
            <i class="fas fa-fire"></i>
            <span>Populaires</span>
        </a>
    </li>
    <li>
        <a href="{{ route('questions.recent') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 p-2 rounded-lg dark:text-gray-300 dark:hover:text-blue-400 {{ request()->routeIs('questions.recent') ? 'bg-blue-50 text-blue-600' : '' }}">
            <i class="fas fa-clock"></i>
            <span>Récentes</span>
        </a>
    </li>
    <li>
            <a href="{{ route('profile.show') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 p-2 rounded-lg dark:text-gray-300 dark:hover:text-blue-400">
                <i class="fas fa-user"></i>
                <span>Profil </span>
            </a>
        </li>
            <!-- Ajoutez d'autres filtres ici -->
        </ul>
        
    </aside>

    <section class="w-3/4 ml-8">
        <div id="map" class="mb-8 rounded-lg shadow-md"></div>

        <div class="space-y-4" id="questions-container">
            @foreach($questions as $question)
                <div class="bg-white p-6 rounded-lg shadow-md transition-all duration-300 card-hover dark:bg-gray-700">
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="data:image/jpeg;base64,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" alt="{{ $question->user->name }}" class="w-12 h-12 rounded-full">
                        <div>
                            <h3 class="font-semibold dark:text-white">{{ $question->user->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $question->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <h1 class="text-xl font-bold text-gray-600 ">{{ $question->title }}</h1>
                    <p class="mt-4 text-gray-700 dark:text-gray-300">{{ $question->content }}</p>
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

        <div class="flex items-center justify-center mt-6 space-x-2">
    {{-- Bouton précédent --}}
    @if ($questions->onFirstPage())
        <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-500">
            <i class="fas fa-chevron-left"></i>
        </span>
    @else
        <a href="{{ $questions->previousPageUrl() }}" class="px-4 py-2 text-gray-700 bg-white rounded-lg hover:bg-blue-50 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            <i class="fas fa-chevron-left"></i>
        </a>
    @endif

    {{-- Numéros de page --}}
    @foreach ($questions->getUrlRange(1, $questions->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="px-4 py-2 {{ $questions->currentPage() == $page ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-blue-50 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }} rounded-lg">
            {{ $page }}
        </a>
    @endforeach

    {{-- Bouton suivant --}}
    @if ($questions->hasMorePages())
        <a href="{{ $questions->nextPageUrl() }}" class="px-4 py-2 text-gray-700 bg-white rounded-lg hover:bg-blue-50 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            <i class="fas fa-chevron-right"></i>
        </a>
    @else
        <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed dark:bg-gray-700 dark:text-gray-500">
            <i class="fas fa-chevron-right"></i>
        </span>
    @endif
</div>
    </section>
@endsection

@section('extra_js')
<script>
    const map = L.map('map').setView([31.7917, -7.0926], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Ajoutez des marqueurs pour chaque question ici
    @foreach($questions as $question)
        L.marker([{{ $question->latitude }}, {{ $question->longitude }}]).addTo(map)
            .bindPopup('{{ $question->title }}');
    @endforeach

    // Animations GSAP
    gsap.from('#map', { opacity: 0, y: 50, duration: 1, delay: 0.5 });
    gsap.from('#questions-container', { opacity: 0, y: 50, duration: 1, delay: 1 });
</script>
@endsection