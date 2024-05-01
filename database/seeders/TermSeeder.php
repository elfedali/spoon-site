<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceTerms = [
            'Surplace',
            'Livraison',
            'Emporter',
        ];

        $kitchenTermFr = [
            'Méditerranéenne',
            'Marocaine',
            'Asiatique',
            'Italienne',
            'Française',
            'Espagnole',
            'Américaine',
            'Mexicaine',

        ];
        foreach ($serviceTerms as $term) {
            \App\Models\Term::factory()->create([
                'name' => $term,
                'taxonomy' => \App\Models\Term::TYPE_SERVICE,
            ]);
        }

        foreach ($kitchenTermFr as $term) {
            \App\Models\Term::factory()->create([
                'name' => $term,
                'taxonomy' => \App\Models\Term::TYPE_KITCHEN,
            ]);
        }
    }
}
