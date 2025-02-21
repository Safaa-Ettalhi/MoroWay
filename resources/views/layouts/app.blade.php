<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocalQ - @yield('title', 'Questions et Réponses Locales')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .filter-active {
            background-color: #3b82f6;
            color: white;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6, #9333ea);
        }
        #map {
            height: 400px;
            border-radius: 12px;
        }
    </style>
    @yield('extra_css')
</head>
<body class="bg-gray-100 font-sans dark:bg-gray-900">
    <header class="bg-white shadow-md p-4 flex justify-between items-center dark:bg-gray-800">
        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
            <a href="{{ route('home') }}">LocalQ</a>
        </div>
        <div class="flex-grow mx-8">
            <form action="{{ route('questions.search') }}" method="GET">
                <input
                    type="text"
                    name="query"
                    placeholder="Rechercher des questions..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                />
            </form>
        </div>
        <div class="flex items-center space-x-4">
            @guest
                <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">S'inscrire</a>
                <a href="{{ route('login') }}" class="px-4 py-2 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 dark:text-blue-400 dark:border-blue-400 dark:hover:bg-gray-700">Connexion</a>
            @else
                <a href="{{ route('dashboard') }}" class="mr-4 px-4 py-2 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 dark:text-blue-400 dark:border-blue-400 dark:hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('questions.index') }}" class="mr-4 px-4 py-2 text-red-300 border border-red-400 rounded-lg hover:bg-red-50 dark:text-red-400 dark:border-red-400 dark:hover:bg-red-700">Questions</a>
                <a href="{{ route('questions.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Poser une question</a>
                <a href="{{ route('favorites.index') }}" class="px-4 py-2 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 dark:text-blue-400 dark:border-blue-400 dark:hover:bg-gray-700">Mes Favoris</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-red-600 border border-red-600 rounded-lg hover:bg-red-50 dark:text-red-400 dark:border-red-400 dark:hover:bg-gray-700">Déconnexion</button>
                </form>
            @endguest
        </div>
    </header>

    <main class="container mx-auto mt-8 flex">
        @yield('content')
    </main>

    <footer class="bg-white mt-8 py-6 shadow-md dark:bg-gray-800">
        <div class="container mx-auto text-center">
            <p class="text-gray-600 dark:text-gray-300">&copy; {{ date('Y') }} LocalQ. Tous droits réservés.</p>
          
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    @yield('extra_js')
</body>
</html>
