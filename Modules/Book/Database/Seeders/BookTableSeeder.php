<?php

namespace Modules\Book\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Author\Entities\Author;
use Modules\Book\Entities\Book;
use Modules\Publisher\Entities\Publisher;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Book::factory()->count(5)
            ->for(Publisher::factory())
            ->hasAttached(
                Author::factory()->count(5),
                [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            )
            ->create();
    }
}
