<?php
namespace Modules\Book\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Book\Entities\Book;
use Modules\Publisher\Entities\Publisher;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-1 day' );
        return [
            'isbn' => $this->faker->uuid,
            'name' => $this->faker->name,
            'year' => $this->faker->year,
            'page' => $this->faker->numberBetween(100, 600),
            'publisher_id' => Publisher::factory(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}

