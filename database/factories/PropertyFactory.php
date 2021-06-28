<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->sentence(5),
            'bedrooms'=> $this->faker->numberBetween(1,5),
             'bathrooms'=> $this->faker->numberBetween(1,3),
             'price'=> $this->faker->numberBetween(1000, 99099),
             'address'=> $this->faker->sentence(4),
             'image'=> $this->faker->imageUrl(640, 480, 'real estate', true),
             'user_id'=> $this->faker->numberBetween(1,2),
        ];
    }
}
