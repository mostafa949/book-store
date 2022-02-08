<?php
namespace Modules\Publisher\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Publisher\Entities\Publisher;

class PublisherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Publisher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-1 day' );
        return [
            'identifier' => $this->faker->uuid,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}

