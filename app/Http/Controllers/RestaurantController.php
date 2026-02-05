<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
class RestaurantController extends Controller
{
     

    public function index()
    {
         if (auth()->user()->role === 'restaurant') {
         $restaurants = Restaurant::where('user_id', auth()->id())->get();
    } else {
         $restaurants = Restaurant::all();
    }
        return view('restaurants.index', compact('restaurants'));
    }

    public function create()
    {
         if (auth()->user()->role !== 'restaurateur') {
        abort(403, "Accès refusé : Vous n'êtes pas un restaurateur.");
    }
        return view('restaurants.create');
    }

     
    public function store(Request $request)
    {
        $donneesValidees = $request->validate([
            'name'      => 'required|max:255',
            'ville'    => 'required|max:255',
            'capacity' => 'required|integer|min:1', 
            'cuisine'  => 'required|string',
        ]);

        
        $donneesValidees['user_id'] = auth()->id();

        Restaurant::create($donneesValidees);

        return redirect()->route('restaurants.index')
                         ->with('succes', 'Le restaurant a été ajouté avec succès !');
    }

    public function edit(Restaurant $restaurant)
    {
        
        if ($restaurant->user_id !== auth()->id()) {
            abort(403, 'Action non autorisée.');
        }

        return view('restaurants.edit', compact('restaurant'));
    }

    
    public function update(Request $request, Restaurant $restaurant)
    {
        if ($restaurant->user_id !== auth()->id()) {
            abort(403);
        }

        $donneesValidees = $request->validate([
            'name'      => 'required|max:255',
            'ville'    => 'required|max:255', 
            'capacity' => 'required|integer|min:1',
            'cuisine'  => 'required|string',
        ]);

        $restaurant->update($donneesValidees);

        return redirect()->route('restaurants.index')
                         ->with('succes', 'Le restaurant a été mis à jour.');
    }

    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->user_id !== auth()->id()) {
            abort(403);
        }

        $restaurant->delete();

        return redirect()->route('restaurants.index')
                         ->with('succes', 'Restaurant supprimé avec succès.');
    }
 

     public function search(Request $request)
{
     $q = $request->query('q');
     $parPage = $request->input('per_page', 10);

    $restaurants = Restaurant::where('user_id', Auth::id())
        ->when($q, function ($query, $q) {
             return $query->where(function($subQuery) use ($q) {
                $subQuery->where('ville', 'ilike', "%{$q}%")
                         ->orWhere('cuisine', 'ilike', "%{$q}%");
            });
        })

        ->paginate($parPage)
        ->withQueryString();

    if ($request->ajax()) {
         return view('restaurants._liste', compact('restaurants'))->render();
    }

    return view('restaurants.index', compact('restaurants'));
}

}