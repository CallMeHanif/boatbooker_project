<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::create([
            'name'  =>  'Kapal Pesiar',
            'category' =>  'Kapal Besar',
            'capacity' =>  123,
            'fuel'  =>  'solar',
            'price'  =>  1000000,
            'boat_img'  => "",
            'boat_vid'  => "",
            'status' => 'Tersedia',
        ]);
    }
}
