<?php

namespace App\Repository\Author;

use Illuminate\Support\Collection;

interface AuthorRepositoryInterface
{
    public function all(): Collection;
    public function create(array $attributes);
}
