<?php

use Illuminate\Database\Seeder;
use App\Sponsorisation;

class SponsorisationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorisations = [
            [
                'name' => 'Base',
                'price' => 2,99,
                'time' => 24
            ],
            [
                'name' => 'Pro',
                'price' => 5,99,
                'time' => 72
            ],
            [
                'name' => 'Platinum',
                'price' => 9,99,
                'time' => 144
            ],
        ];

        foreach($sponsorisations as $sponsorisation){
            $new_sponsorisation = new Sponsorisation();
            $new_sponsorisation->time = $sponsorisation['time'];
            $new_sponsorisation->price = $sponsorisation['price'];
            $new_sponsorisation->name = $sponsorisation['name'];
            $new_sponsorisation->save();
        }
    }
}
