<?php

use App\Message;
use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
        for ($i=18; $i < 21; $i++) {
            $new_message = New Message();
            $new_message->dwelling_id = $i;
            $new_message->sender_email = 'bruttamail@yahoo.it';
            $new_message->text = 'Ciao bellofigogoo';
            $new_message->save();
        }
    }
}
