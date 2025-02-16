<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $anime['title'] }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Imagem e detalhes -->
                    <div class="flex flex-col md:flex-row items-center">
                        <img src="{{ $anime['images']['jpg']['image_url'] }}" alt="{{ $anime['title'] }}" class="w-72 h-auto object-cover rounded-lg shadow-lg">
                        <div class="ml-6">
                            <h3 class="text-2xl font-bold">{{ $anime['title'] }}</h3>
                            <p class="mt-2 text-gray-400">Episódios: {{ $anime['episodes'] ?? 'N/A' }}</p>
                            <p class="mt-2 text-gray-400">Nota: {{ $anime['score'] ?? 'N/A' }}</p>
                            <p class="mt-2 text-gray-400">Status: {{ $anime['status'] ?? 'Desconhecido' }}</p>
                            <p class="mt-2 text-gray-400">Ano: {{ $anime['year'] ?? 'N/A' }}</p>
                            <p class="mt-2 text-gray-400">Tipo: {{ $anime['type'] ?? 'N/A' }}</p>
                            <p class="mt-4">{{ $anime['synopsis'] ?? 'Sem descrição disponível.' }}</p>
                        </div>
                    </div>

                    <!-- Gêneros -->
                    <div class="mt-6">
                        <h4 class="text-lg font-semibold">Gêneros:</h4>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach ($anime['genres'] as $genre)
                                <span class="text-xs bg-blue-500 text-white px-3 py-1 rounded-full">{{ $genre['name'] }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
