<?php

use App\Perk;
use Illuminate\Database\Seeder;

class PerksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perks = [ 'Piscina', 'Ascensore', 'Wi-Fi', 'Spiaggia', 'Black Jack', 'Squillo di lusso' ];
        $perks = [
            [
                'name' => 'Piscina',
                'icon' => '<i class="fa-solid fa-person-swimming"></i>'
            ],
            [
                'name' => 'Ascensore',
                'icon' => '<i class="fa-solid fa-elevator"></i>'
            ],
            [
                'name' => 'Wi-Fi',
                'icon' => '<i class="fa-solid fa-wifi"></i>'
            ],
            [
                'name' => 'Spiaggia',
                'icon' => '<i class="fa-solid fa-umbrella-beach"></i>'
            ],
            [
                'name' => 'Parcheggio',
                'icon' => '<i class="fa-solid fa-square-parking"></i>'
            ],
            [
                'name' => 'Aria condizionata',
                'icon' => '<i class="fa-solid fa-fan"></i>'
            ]
        ];

        foreach($perks as $perk){
            $new_perk = new Perk();
            $new_perk->icon = $perk['icon'];
            $new_perk->name = $perk['name'];
            $new_perk->save();
        }
    }
}
