@extends('layouts.app')

@section('title', 'Poser une question')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg dark:bg-gray-800 max-w-3xl mx-auto">
    <h1 class="text-4xl font-bold mb-6 text-center text-gray-900 dark:text-white">Poser une nouvelle question</h1>
    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label for="title" class="block text-lg font-semibold text-gray-700 dark:text-white mb-2">Titre</label>
            <input type="text" name="title" id="title" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-400" required>
        </div>
        <div class="mb-6">
            <label for="content" class="block text-lg font-semibold text-gray-700 dark:text-white mb-2">Contenu</label>
            <textarea name="content" id="content" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-400" required></textarea>
        </div>
        <div class="mb-6 grid grid-cols-2 gap-6">
            <div>
                <label for="latitude" class="block text-lg font-semibold text-gray-700 dark:text-white mb-2">Latitude</label>
                <input type="number" name="latitude" id="latitude" step="any" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-400" required>
            </div>
            <div>
                <label for="longitude" class="block text-lg font-semibold text-gray-700 dark:text-white mb-2">Longitude</label>
                <input type="number" name="longitude" id="longitude" step="any" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-400" required>
            </div>
        </div>
        <button type="submit" class="w-full py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400">Poser la question</button>
    </form>
</div>
@endsection
