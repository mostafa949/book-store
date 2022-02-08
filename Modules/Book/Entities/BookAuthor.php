<?php

namespace Modules\Book\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookAuthor extends Pivot
{
    use HasFactory;

    protected $table = 'book_authors';
}
