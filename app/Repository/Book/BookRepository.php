<?php

namespace App\Repository\Book;


use App\Repository\BaseRepository;
use Illuminate\Support\Collection;
use Modules\Book\Entities\Book;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Book $model
     */
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->booksWithAuthorPublisher();
    }

    // store new book
    public function store($request)
    {
        $item = $this->model->create($request->all());
        $authors = $request->get('authors');
        $item->authors()->sync($authors);
    }

    public function show($book)
    {
        return $this->bookWithAuthorPublisher($book);
    }

    public function edit($category)
    {
        return $category;
    }

    public function update($request, $book)
    {
        $item = $this->bookWithAuthorPublisher($book);
        $item->update($request->all());
        $authors = $request->get('authors');
        $item->authors()->sync($authors);
        return $item;

    }

    public function destroy($book)
    {
        $item = $this->bookWithAuthorPublisher($book);
        $item->authors()->detach();
        $item->delete();
    }

    public function booksWithAuthorPublisher()
    {
        return $this->model->with('authors', 'publisher')->get();
    }

    public function bookWithAuthorPublisher($book)
    {
        return $this->model->with('authors', 'publisher')->findOrFail($book);
    }
}
