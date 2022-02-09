<?php

namespace Modules\Book\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Author\Entities\Author;
use Modules\Book\Database\factories\BookFactory;
use Modules\Publisher\Entities\Publisher;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'isbn',
        'slug',
        'title',
        'description',
        'image_path',
        'year',
        'page',
        'category_id',
        'publisher_id',
    ];

    protected static function newFactory(): BookFactory
    {
        return BookFactory::new();
    }

    /**
     * book's publisher
     *
     * @return BelongsTo
     */
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class)
            ->withDefault([
                'identifier' => 'WITHOUT ID',
                'first_name' => 'NOT FOUND',
                'last_name' => 'NOT FOUND',
            ]);
    }

    /**
     * book's authors
     *
     * @return BelongsToMany
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_authors')
            ->using(BookAuthor::class);
    }
}
