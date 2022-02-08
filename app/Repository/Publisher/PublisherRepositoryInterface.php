<?php

namespace App\Repository\Publisher;

use Illuminate\Support\Collection;

interface PublisherRepositoryInterface
{
    public function all(): Collection;
    public function create(array $attributes);
}
