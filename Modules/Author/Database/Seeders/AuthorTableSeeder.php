<?php

namespace Modules\Author\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Author\Entities\Author;
use Modules\Book\Entities\Book;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Author::factory()->count(2)
            ->hasAttached(
                Book::factory()->count(5)
            )
            ->create();
    }
}
