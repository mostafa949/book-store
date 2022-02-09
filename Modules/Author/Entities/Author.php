<?php

namespace Modules\Author\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Author\Database\factories\AuthorFactory;
use Modules\Book\Entities\BookAuthor;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'identifier',
        'first_name',
        'last_name',
        'description',
        'image_path',
        'admin_id',
    ];

    protected static function newFactory(): AuthorFactory
    {
        return AuthorFactory::new();
    }

    /**
     * author's books
     *
     * @return BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Author::class,'book_authors')->using(BookAuthor::class);
    }
}
