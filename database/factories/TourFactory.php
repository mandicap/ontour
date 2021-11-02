<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourFactory extends Factory
{
    /**
     * The name of the factory's corrosponding model.
     *
     * @var string
     */
    protected $model = Tour::class;

    /**
     * Defines the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'active' => $this->faker->boolean()
        ];
    }
}
