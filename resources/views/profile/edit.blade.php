<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - LocalQ</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <!-- Navbar -->
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

    <div class="flex min-h-screen mt-2">
        <!-- Sidebar -->
        <aside class="w-1/4 bg-white p-6 shadow-md dark:bg-gray-800">
        <h2 class="text-xl font-semibold mb-4 dark:text-white">Filtres</h2>
        <ul class="space-y-2">
            <li>
                <a href="{{ route('home') }}" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600  p-2 rounded-lg dark:text-gray-300 dark:hover:text-blue-400">
                    <i class="fas fa-list"></i>
                    <span>Toutes les questions</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 p-2 rounded-lg dark:text-gray-300 dark:hover:text-blue-400">
                    <i class="fas fa-fire"></i>
                    <span>Populaires</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 p-2 rounded-lg dark:text-gray-300 dark:hover:text-blue-400">
                    <i class="fas fa-clock"></i>
                    <span>Récentes</span>
                </a>
            </li>
            <li>
            <a href="{{ route('profile.show') }}" class="flex filter-active items-center space-x-2 text-white hover:text-blue-600 p-2 bg-blue-500 rounded-lg dark:text-gray-300 dark:hover:text-blue-400">
                <i class="fas fa-user"></i>
                <span>Profil </span>
            </a>
        </li>
            <!-- Ajoutez d'autres filtres ici -->
        </ul>
        
    </aside>

        <!-- Contenu principal -->
        <main class="flex-1 p-8 max-w-full  bg-white dark:bg-gray-800 shadow-md ">
            <!-- Informations personnelles -->
            <section>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Informations du profil</h2>
                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-4">
                    @csrf
                    @method('patch')
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full p-2 border rounded-md">
                    </div>
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Sauvegarder</button>
                </form>
            </section>

            <!-- Changer le mot de passe -->
            <section class="mt-8">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Modifier le mot de passe</h2>
                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-4">
                    @csrf
                    @method('put')
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                        <input id="current_password" name="current_password" type="password" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                        <input id="password" name="password" type="password" class="w-full p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="w-full p-2 border rounded-md">
                    </div>
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Mettre à jour</button>
                </form>
            </section>
            <!-- Supprimer le compte -->
            <section class="space-y-6 mt-8">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>



        </main>
    </div>
</body>
</html>
