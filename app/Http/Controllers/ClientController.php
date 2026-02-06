<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class ClientController extends Controller
{
    public function index(Request $request)
{
     $ville = $request->input('q');

     $restaurants = Restaurant::query()
        ->when($ville, function($query, $ville) {
             return $query->where('ville', 'like', "%$ville%");
        })
        ->paginate(9)    
        ->withQueryString();              

     return view('client.explore', compact('restaurants'));
}
    public function toggleFavorite($restaurantId)
    {
        if(auth()->user()->role !='client'){
            return back()->with('error' , 'Clients seulement');

        }
        
         auth()->user()->favorites()->toggle($restaurantId);
         return back();
    }
    
}
