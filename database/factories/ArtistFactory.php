<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    /**
     * The name of the factory's corrosponding model.
     *
     * @var string
     */
    protected $model = Artist::class;

    /**
     * Defines the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'on_tour' => $this->faker->boolean()
        ];
    }
}
