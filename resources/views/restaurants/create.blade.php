 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un Restaurant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('restaurants.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label>Nom du restaurant</label>
                        <input type="text" name="name" class="border rounded w-full py-2 px-3">
                    </div>
                    
                    <div class="mb-4">
                        <label>Ville</label>
                        <input type="text" name="ville" class="border rounded w-full py-2 px-3">
                    </div>

                    <div class="mb-4">
                        <label>Capacité</label>
                        <input type="number" name="capacity" class="border rounded w-full py-2 px-3">
                    </div>

                    <div class="mb-4">
                        <label>Type de Cuisine</label>
                        <input type="text" name="cuisine" class="border rounded w-full py-2 px-3">
                    </div>

                     <button type="submit" style="background-color: black; color: white; padding: 10px; margin-top: 10px; display: block;">
    TESTER ENREGISTRER
</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>