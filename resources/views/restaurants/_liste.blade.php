@forelse($restaurants as $restaurant)
    <tr class="border-b hover:bg-gray-50">
        <td class="px-6 py-4 font-medium text-gray-900">{{ $restaurant->name }}</td>
        <td class="px-6 py-4">{{ $restaurant->ville }}</td>
        <td class="px-6 py-4">{{ $restaurant->cuisine }}</td>
        <td class="px-6 py-4 text-center">{{ $restaurant->capacity }}</td>
        <td class="px-6 py-4 text-right">
            <div class="flex justify-end gap-2">
                <a href="{{ route('restaurants.edit', $restaurant) }}" class="text-blue-600 hover:text-blue-900">Modifier</a>
                
                <form action="{{ route('restaurants.destroy', $restaurant) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Aucun restaurant trouvé.</td>
    </tr>
@endforelse