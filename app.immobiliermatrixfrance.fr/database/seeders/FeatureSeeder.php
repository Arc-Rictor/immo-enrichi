<?php

namespace Database\Seeders;

use App\Actions\Feature\CreateFeature;
use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            'Land', 'Swimming pool', 'Parking', 'Balcony', 'New build',
            'Retirement home', 'Guest house', 'Stables', 'Home cinema',
            'Garden', 'Stone', 'Revenue generating', 'Off-street parking',
            'Driveway', 'Renovated/Restored', 'Countryside view', 'Sea views',
            'Character', 'Sauna', 'Hot Tub/Jacuzzi'
        ];

        foreach ($features as $feature) {
            (new CreateFeature())->execute(['name' => $feature]);
        }
    }
}
