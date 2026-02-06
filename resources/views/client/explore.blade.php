 <x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold text-center mb-8">
            Explorer les restaurants
        </h1>

        <form action="{{ route('client.explore') }}" method="GET" class="mb-10 flex justify-center gap-3">
            <input type="text" 
                   name="q" 
                   value="{{ request('q') }}" 
                   placeholder="Rechercher par ville (ex: Marrakech)" 
                   class="w-full sm:w-1/2 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 outline-none">
            
            <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                Rechercher
            </button>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @forelse($restaurants as $restaurant)
                <div class="bg-white border rounded-xl shadow-sm overflow-hidden flex flex-col hover:shadow-lg transition-shadow">
                    
                    <img src="https://via.placeholder.com/400x200.png?text={{ urlencode($restaurant->nom) }}" 
                         alt="{{ $restaurant->nom }}" 
                         class="w-full h-44 object-cover">

                    <div class="p-5 flex flex-col flex-1">
                        <div class="flex justify-between items-start mb-3">
                            <h2 class="text-xl font-bold text-gray-800">{{ $restaurant->name }}</h2>

                            @if(auth()->user()?->role === 'client')
                                <form action="{{ route('favorite.toggle', $restaurant->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="focus:outline-none transform hover:scale-110 transition">
                                        @if(auth()->user()->favorites->contains($restaurant->id))
                                            <span class="text-red-500 text-2xl">❤️</span>
                                        @else
                                            <span class="text-gray-300 text-2xl">🤍</span>
                                        @endif
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="flex items-center gap-2 mb-2 text-gray-700">
                            <span class="text-lg">🍽️</span>
                            <span class="text-sm font-medium">Cuisine : </span>
                            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-bold uppercase">
                                {{ $restaurant->cuisine ?? 'Classique' }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2 mb-5 text-gray-600">
                            <span class="text-lg">📍</span>
                            <span class="text-sm">Ville : {{ $restaurant->ville }}</span>
                        </div>

                        <a href="#" class="mt-auto w-full text-center bg-black text-white py-2.5 rounded-lg font-bold hover:bg-gray-800 transition">
                            Réserver une table
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-gray-50 rounded-xl">
                    <p class="text-gray-500 text-xl font-semibold">Désolé, aucun restaurant trouvé.</p>
                    <a href="{{ route('explore') }}" class="text-green-600 underline mt-2 inline-block">Voir tous les restaurants</a>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $restaurants->links() }}
        </div>

    </div>
</x-app-layout>