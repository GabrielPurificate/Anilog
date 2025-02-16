<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <h3 class="text-2xl font-bold mb-6">Lista de Animes</h3>

                    <!-- Grid de Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($animes as $anime)
                            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow-md">
                                <a href="{{ $anime['url'] }}" target="_blank">
                                    <img src="{{ $anime['images']['jpg']['image_url'] }}" alt="{{ $anime['title'] }}" class="w-full h-60 object-cover rounded-md">
                                </a>
                                <h3 class="text-lg font-semibold mt-3">
                                    <a href="{{ route('anime.details', ['id' => $anime['mal_id']]) }}" class="hover:underline">
                                        {{ $anime['title'] }}
                                    </a>
                                </h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Episódios: {{ $anime['episodes'] ?? 'N/A' }}</p>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Nota: {{ $anime['score'] ?? 'N/A' }}</p>
                                <div class="mt-3">
                                    @foreach ($anime['genres'] as $genre)
                                        <span class="text-xs bg-blue-500 text-white px-2 py-1 rounded-full">{{ $genre['name'] }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginação -->
                    <div class="mt-8 flex justify-center space-x-4">
                        @if ($pagination['current_page'] > 1)
                            <a href="{{ route('dashboard', ['page' => $pagination['current_page'] - 1]) }}" class="px-4 py-2 bg-gray-700 text-white rounded">Anterior</a>
                        @endif

                        <span class="px-4 py-2 bg-gray-300 text-gray-800 rounded">
                            Página {{ $pagination['current_page'] }} de {{ $pagination['last_visible_page'] }}
                        </span>

                        @if ($pagination['has_next_page'])
                            <a href="{{ route('dashboard', ['page' => $pagination['current_page'] + 1]) }}" class="px-4 py-2 bg-gray-700 text-white rounded">Próxima</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
