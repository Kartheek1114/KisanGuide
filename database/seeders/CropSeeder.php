<?php

namespace Database\Seeders;

use App\Models\Crop;
use Illuminate\Database\Seeder;

class CropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $crops = [
            [
                'name' => 'Rice (Paddy)',
                'type' => 'Cereal',
                'description' => 'Rice is the primary staple food crop in Asia. It is a Kharif crop that thrives in high temperatures, high humidity, and requires substantial water or flooding.',
                'optimal_temp_min' => 20.0,
                'optimal_temp_max' => 37.0,
                'optimal_humidity_min' => 60.0,
                'optimal_humidity_max' => 85.0,
                'optimal_ph_min' => 5.5,
                'optimal_ph_max' => 6.5,
                'optimal_n' => 120,
                'optimal_p' => 60,
                'optimal_k' => 40,
                'soil_types' => ['Clayey', 'Loamy'],
                'water_requirement' => 'High (Constant irrigation / Flooding)',
                'harvest_days' => 120,
                'image_url' => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Wheat',
                'type' => 'Cereal',
                'description' => 'Wheat is the second most important cereal food crop. It is a Rabi crop requiring a cool growing season and bright sunshine during ripening.',
                'optimal_temp_min' => 10.0,
                'optimal_temp_max' => 25.0,
                'optimal_humidity_min' => 40.0,
                'optimal_humidity_max' => 60.0,
                'optimal_ph_min' => 6.0,
                'optimal_ph_max' => 7.5,
                'optimal_n' => 100,
                'optimal_p' => 50,
                'optimal_k' => 40,
                'soil_types' => ['Clay Loam', 'Sandy Loam'],
                'water_requirement' => 'Moderate (4-6 timely irrigations)',
                'harvest_days' => 130,
                'image_url' => 'https://images.unsplash.com/photo-1521335629791-ce4aec67dd8f?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Cotton',
                'type' => 'Cash Crop',
                'description' => 'Cotton is a premier commercial cash crop. It is highly sensitive to frost and waterlogging, requiring a dry harvesting period and clear sunny days.',
                'optimal_temp_min' => 21.0,
                'optimal_temp_max' => 30.0,
                'optimal_humidity_min' => 50.0,
                'optimal_humidity_max' => 70.0,
                'optimal_ph_min' => 5.8,
                'optimal_ph_max' => 8.0,
                'optimal_n' => 100,
                'optimal_p' => 50,
                'optimal_k' => 50,
                'soil_types' => ['Black Soil', 'Alluvial Soil'],
                'water_requirement' => 'Moderate (Sensitive to waterlogging)',
                'harvest_days' => 180,
                'image_url' => 'https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Tomato',
                'type' => 'Vegetable',
                'description' => 'Tomato is a widely grown warm-season vegetable. It requires stable warm temperatures, good organic soil drainage, and protection from heavy frost.',
                'optimal_temp_min' => 18.0,
                'optimal_temp_max' => 28.0,
                'optimal_humidity_min' => 50.0,
                'optimal_humidity_max' => 70.0,
                'optimal_ph_min' => 6.0,
                'optimal_ph_max' => 6.8,
                'optimal_n' => 80,
                'optimal_p' => 80,
                'optimal_k' => 100,
                'soil_types' => ['Sandy Loam', 'Loam'],
                'water_requirement' => 'Moderate (Regular light watering)',
                'harvest_days' => 85,
                'image_url' => 'https://images.unsplash.com/photo-1582515073494-1e8b5c5d3be0?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Maize',
                'type' => 'Cereal',
                'description' => 'Maize (Corn) is a versatile cereal grown as both food and fodder. It grows well in fertile alluvial soils and requires moderate, evenly spread rainfall.',
                'optimal_temp_min' => 18.0,
                'optimal_temp_max' => 27.0,
                'optimal_humidity_min' => 55.0,
                'optimal_humidity_max' => 75.0,
                'optimal_ph_min' => 5.8,
                'optimal_ph_max' => 7.0,
                'optimal_n' => 120,
                'optimal_p' => 60,
                'optimal_k' => 40,
                'soil_types' => ['Loamy Soil', 'Alluvial Soil'],
                'water_requirement' => 'Moderate (Sensitive to drought during flowering)',
                'harvest_days' => 100,
                'image_url' => 'https://images.unsplash.com/photo-1598462215875-84eeb7d4c6ec?q=80&w=1200&auto=format&fit=crop',
            ],
            [
                'name' => 'Potato',
                'type' => 'Vegetable',
                'description' => 'Potato is a cool-season tuber crop. It is highly valued as a staple carbohydrate and requires loose, well-drained loamy soils for proper tuber development.',
                'optimal_temp_min' => 15.0,
                'optimal_temp_max' => 20.0,
                'optimal_humidity_min' => 60.0,
                'optimal_humidity_max' => 80.0,
                'optimal_ph_min' => 5.2,
                'optimal_ph_max' => 6.0,
                'optimal_n' => 120,
                'optimal_p' => 120,
                'optimal_k' => 150,
                'soil_types' => ['Sandy Loam', 'Silt Loam'],
                'water_requirement' => 'Moderate (Consistent moisture essential)',
                'harvest_days' => 90,
                'image_url' => 'https://images.unsplash.com/photo-1518085250887-5c0e1b7e31a2?q=80&w=1200&auto=format&fit=crop',
            ],
        ];

        foreach ($crops as $crop) {
            Crop::create($crop);
        }
    }
}
