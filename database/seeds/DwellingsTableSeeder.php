<?php

use App\Dwelling;
use Illuminate\Database\Seeder;

class DwellingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dwellings= config('dwellings');

        foreach($dwellings as $dwelling){
            $new_dwelling = new Dwelling();

            $new_dwelling->user_id = $dwelling['user_id'];
            $new_dwelling->name = $dwelling['name'];
            $new_dwelling->slug = Dwelling::generateSlug($new_dwelling->name);
            $new_dwelling->category = $dwelling['category'];
            $new_dwelling->rooms = $dwelling['rooms'];
            $new_dwelling->beds = $dwelling['beds'];
            $new_dwelling->bathrooms = $dwelling['bathrooms'];
            $new_dwelling->dimentions = $dwelling['dimentions'];
            $new_dwelling->long = $dwelling['long'];
            $new_dwelling->lat = $dwelling['lat'];
            $new_dwelling->address = $dwelling['address'];
            $new_dwelling->description = $dwelling['description'];
            $new_dwelling->visible = $dwelling['visible'];
            $new_dwelling->price = $dwelling['price'];

            $new_dwelling->save();

        }
    }
}
