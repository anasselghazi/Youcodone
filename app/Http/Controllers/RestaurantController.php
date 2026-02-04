<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
class RestaurantController extends Controller
{
     

    public function index()
    {
        $restaurants = Restaurant::where('user_id', auth()->id())->get();
        return view('restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('restaurants.create');
    }

     
    public function store(Request $request)
    {
        $donneesValidees = $request->validate([
            'nom'      => 'required|max:255',
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
            'nom'      => 'required|max:255',
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
} 

