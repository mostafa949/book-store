<?php

namespace Modules\Book\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Book\Database\factories\CategoryFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['slug', 'title', 'description', 'admin_id'];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }
}
