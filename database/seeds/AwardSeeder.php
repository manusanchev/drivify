<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(\App\Award::class,10)->create();
        $blocks = [
            [
                "name" => "Nivel 1 - El viaje comienza",
                "price" => "5",
                "img" => "1.PNG"
            ],
            [
                "name" => "Nivel 2 - Un destino cerca",
                "price" => "10",
                "img" => "2.PNG"
            ],
            [
                "name" => "Nivel 3 - A la diana",
                "price" => "15",
                "img" => "3.PNG"
            ],
            [
                "name" => "Nivel 4 - La meta",
                "price" => "20",
                "img" => "4.PNG"
            ],
            [
                "name" => "Nivel 5 - Estrella2",
                "price" => "25",
                "img" => "5.PNG"
            ],
            [
                "name" => "Nivel 6 - Justo en el centro",
                "price" => "30",
                "img" => "6.PNG"
            ],
            [
                "name" => "Nivel 7 - Colonizando",
                "price" => "35",
                "img" => "7.PNG"
            ],
            [
                "name" => "Nivel 8 - kms y mas",
                "price" => "40",
                "img" => "8.PNG"
            ],
            [
                "name" => "Nivel 9 - El mejor driver",
                "price" => "45",
                "img" => "9.PNG"
            ],
            [
                "name" => "Nivel 10 - Al estrellato",
                "price" => "60",
                "img" => "10.PNG"
            ],
            [
                "name" => "Nivel 11 - Nada como this",
                "price" => "70",
                "img" => "11.PNG"
            ],
            [
                "name" => "Nivel 12 - Anfitrion 100%",
                "price" => "80",
                "img" => "12.PNG"
            ],
            [
                "name" => "Nivel 13 - El viaje largo",
                "price" => "90",
                "img" => "13.PNG"
            ],
            [
                "name" => "Nivel 14 - Superconductor",
                "price" => "200",
                "img" => "14.PNG"
            ],
            [
                "name" => "Nivel 15 - Hacia el infinito",
                "price" => "500",
                "img" => "15.PNG"
            ],
        ];
        foreach ($blocks as $block){
            DB::table('awards')->insert($block);
        }


    }
}
