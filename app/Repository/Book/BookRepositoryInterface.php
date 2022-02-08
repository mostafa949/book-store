<?php

namespace App\Repository\Book;

use Illuminate\Support\Collection;

interface BookRepositoryInterface
{
    public function all(): Collection;
    public function create(array $attributes);
}
