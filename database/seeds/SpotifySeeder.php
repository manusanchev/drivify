<?php

use Illuminate\Database\Seeder;

class SpotifySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Spotify::class, 2)->create();
    }
}
