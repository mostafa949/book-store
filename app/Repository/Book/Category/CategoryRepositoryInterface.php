<?php

namespace App\Repository\Book\Category;

use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function all(): Collection;
    public function create(array $attributes);
}
