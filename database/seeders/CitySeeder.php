<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Street;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list_of_cities_morocco = [
            [
                'name' => 'Casablanca',
                'streets' => [
                    'Ain Diab',
                    'Belvedere',
                    'Ain Sebaâ',
                    'Anfa',
                    'Al Qods'
                ]
            ],
            [
                'name' => 'Fez',
                'streets' => [
                    'Al Qods',
                    'Médina',
                    'Dhar El Mehraz',
                    'Saiss'
                ]
            ],
            [
                'name' => 'Kénitra',
                'streets' => [
                    'Médina',
                    'Hassan II',
                    'El Walili',
                    'Bir Rami'
                ]
            ],
            [
                'name' => 'Marrakech',
                'streets' => [
                    'Gueliz',
                    'Médina',
                    'Hivernage',
                    'Agdal'
                ]
            ],
            // Add more cities and streets as needed
        ];

        foreach ($list_of_cities_morocco as $cityData) {
            $city = City::create([
                'name' => $cityData['name']
            ]);

            foreach ($cityData['streets'] as $streetName) {
                Street::create([
                    'name' => $streetName,
                    'city_id' => $city->id
                ]);
            }
        }
    }
}
