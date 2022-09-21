<?php

use Illuminate\Database\Seeder;
use App\Dwelling;
use App\Perk;

class DwellingsPerksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dwellings = Dwelling::All();
        foreach ($dwellings as $dwelling) {
            $perks = [];
            for ($i=0; $i < 3; $i++) {
                $perk = Perk::inRandomOrder()->first()->id;
                array_push($perks, $perk);
            }
            $dwelling->perks()->attach($perks);
        }
    }
}
