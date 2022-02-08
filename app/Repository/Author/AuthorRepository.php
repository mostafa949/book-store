<?php

namespace App\Repository\Author;


use App\Repository\BaseRepository;
use Illuminate\Support\Collection;
use Modules\Author\Entities\Author;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Author $model
     */
    public function __construct(Author $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->authorWithBooks();
    }

    // store new book
    public function store($request)
    {
        return $this->model->create($request->all());
    }

    public function show($author)
    {
        return $this->authorWithBooks($author);
    }

    public function edit($category)
    {
        return $category;
    }

    public function update($request, $author)
    {
        $item = $this->authorWithBooks($author);
        $item->update($request->all());
        return $item;

    }

    public function destroy($author)
    {
        $item = $this->authorWithBooks($author);
        $item->books()->detach();
        $item->delete();
    }

    public function authorsWithBooks()
    {
        return $this->model->with('books')->get();
    }

    public function authorWithBooks($author)
    {
        return $this->model->with('books')->findOrFail($author);
    }
}
