<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Restaurants</h1>
                <p class="text-sm text-gray-500">Manage your restaurants</p>
            </div>

           <a href="{{ route('restaurants.create') }}"
   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
    </svg>
    + Nouveau
</a>
        </div>

        <div class="mb-4">
            <input
                id="search" 
                type="text"
                placeholder="Search by city or cuisine…"
                class="w-full max-w-md border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-black"
            >
            <select id="per-page" class="rounded border-gray-300">
             <option value="5">5</option>
             <option value="10" selected>10</option>
              <option value="25">25</option>
              </select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-t border-gray-200">
                <thead class="text-gray-500">
                    <tr>
                        <th class="py-3 text-left font-medium">Restaurant</th>
                        <th class="py-3 text-left font-medium">City</th>
                        <th class="py-3 text-left font-medium">Cuisine</th>
                        <th class="py-3 text-center font-medium">Capacity</th>
                        <th class="py-3 text-right font-medium">Actions</th>
                    </tr>
                </thead>

                <tbody id="restaurants-table" class="divide-y divide-gray-100">
                    @include('restaurants._liste')
                </tbody>
            </table>
        </div>

    </div>

    <script>
         const input = document.getElementById('search');
        let timer;

        input.addEventListener('input', () => {
            clearTimeout(timer);
            timer = setTimeout(async () => {
                const q = input.value;

                 const res = await fetch(`{{ route('restaurants.search') }}?q=${encodeURIComponent(q)}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                if (res.ok) {
                    const html = await res.text();
                    document.getElementById('restaurants-table').innerHTML = html;
                }
            }, 300);
        });
    </script>
</x-app-layout>