<?php

namespace Modules\Publisher\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Book\Entities\Book;
use Modules\Publisher\Database\factories\PublisherFactory;

class Publisher extends Model
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

    protected static function newFactory(): PublisherFactory
    {
        return PublisherFactory::new();
    }

    /**
     * publisher's books
     *
     * @return HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'publisher_id');
    }
}
