<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\User;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
       $owner = User::where('role', 'restaurateur')->first();

    if ($owner) {
        Restaurant::forceCreate([
            'name'      => 'Le Médina Safi',
            'ville'    => 'Safi',
            'capacity' => 50,
            'cuisine'  => 'Marocaine',
            'user_id'  => $owner->id,
        ]);

        Restaurant::forceCreate([
            'name'      => 'elghazi',
            'ville'    => 'Safi',
            'capacity' => 30,
            'cuisine'  => 'Poissons',
            'user_id'  => $owner->id,
        ]);
    }
}
}
        