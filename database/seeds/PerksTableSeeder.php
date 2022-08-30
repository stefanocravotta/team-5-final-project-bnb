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

        foreach($perks as $perk){
            $new_perk = new Perk();
            $new_perk->icon = $perk;
            $new_perk->name = $perk;
            $new_perk->save();
        }
    }
}
