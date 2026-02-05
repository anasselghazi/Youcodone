<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le restaurant : {{ $restaurant->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                
                <form action="{{ route('restaurants.update', $restaurant) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block">Nom :</label>
                        <input type="text" name="name" value="{{ $restaurant->name }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block">Ville :</label>
                        <input type="text" name="ville" value="{{ $restaurant->ville }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block">Capacité :</label>
                        <input type="number" name="capacity" value="{{ $restaurant->capacity }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block">Cuisine :</label>
                        <input type="text" name="cuisine" value="{{ $restaurant->cuisine }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mt-6">
                         <button type="submit" style="background-color: #2563eb !important; color: white !important; display: block !important; padding: 10px 20px; border-radius: 5px;">
                        Mettre à jour (TEST)
                        </button>
                        <a href="{{ route('restaurants.index') }}" class="ml-4 text-gray-600">Annuler</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>