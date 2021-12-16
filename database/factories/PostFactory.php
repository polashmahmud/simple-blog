<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'        => $this->faker->sentence,
            'description'  => $this->faker->text,
            'user_id'      => User::all()->random()->id,
            'is_published' => $this->faker->boolean,
            'published_at' => $this->faker->dateTime,
        ];
    }
}
