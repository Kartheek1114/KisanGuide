<?php

namespace Database\Seeders;

use App\Models\Pest;
use Illuminate\Database\Seeder;

class PestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pests = [
            [
                'name' => 'Stem Borer',
                'target_crops' => ['Rice (Paddy)', 'Maize'],
                'humidity_threshold' => 80.0,
                'temp_threshold' => 28.0,
                'symptoms' => 'Boring at base of plants, drying of central shoots (known as "dead hearts" in young plants or "whiteheads" during flowering/grain filling stage).',
                'prevention_measures' => 'Set up pheromone traps to monitor moths, harvest crops closer to ground level to reduce overwintering larvae, and practice crop rotation.',
                'remedial_measures' => 'Deploy Trichogramma biological cards or apply systemic insecticides such as chlorantraniliprole 0.4% GR in case of high infestation.',
                'severity_level' => 'High',
            ],
            [
                'name' => 'Aphids',
                'target_crops' => ['Wheat', 'Tomato', 'Cotton', 'Potato'],
                'humidity_threshold' => 60.0,
                'temp_threshold' => 20.0,
                'symptoms' => 'Yellowing and curling of leaves, sticky honeydew residue on plants followed by black sooty mold, presence of clusters of tiny soft-bodied green or brown insects.',
                'prevention_measures' => 'Avoid excessive nitrogen fertilizers which promote soft green growth, protect natural predators like ladybugs, and plant companion crops.',
                'remedial_measures' => 'Spray organic neem oil (1500 ppm) at 5ml/litre of water, or apply chemical sprays like imidacloprid under heavy pressure.',
                'severity_level' => 'Medium',
            ],
            [
                'name' => 'Bollworm',
                'target_crops' => ['Cotton', 'Tomato'],
                'humidity_threshold' => 70.0,
                'temp_threshold' => 26.0,
                'symptoms' => 'Holes bored into squares, flowers, and bolls/fruits, internal tissue feeding, shedding of buds, and visible fecal pellets around feeding holes.',
                'prevention_measures' => 'Sow tolerant or Bt seed varieties, install pheromone traps, grow trap crops like marigold on the borders.',
                'remedial_measures' => 'Spray neem seed kernel extract (NSKE 5%) or apply bio-pesticides like Helicoverpa NPV, or synthetic pyrethroids if threshold exceeds.',
                'severity_level' => 'High',
            ],
            [
                'name' => 'Late Blight Fungus',
                'target_crops' => ['Potato', 'Tomato'],
                'humidity_threshold' => 90.0,
                'temp_threshold' => 18.0,
                'symptoms' => 'Pale green or dark water-soaked spots on leaves expanding rapidly, fine white fuzzy growth on the underside of leaves during damp mornings, rotting of tubers/fruit.',
                'prevention_measures' => 'Use certified disease-free seed tubers, maintain wide plant spacing for aeration, and avoid overhead sprinkler watering.',
                'remedial_measures' => 'Apply preventive contact fungicides like Mancozeb, or curative systemic sprays like Metalaxyl+Mancozeb immediately upon detecting symptoms.',
                'severity_level' => 'High',
            ],
        ];

        foreach ($pests as $pest) {
            Pest::create($pest);
        }
    }
}
