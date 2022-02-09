<?php

namespace App\Repository\Book;


use App\Repository\BaseRepository;
use Cviebrock\EloquentSluggable\Services\SlugService;
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
    public function store($request, $imageName)
    {
        $book = new $this->model;
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        return $this->bookData($imageName, $book, $request);
    }

    public function show($book)
    {
        return $this->bookWithAuthorPublisher($book);
    }

    public function edit($book)
    {
        return $book;
    }

    public function update($request, $fileName, $book)
    {
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->slug = SlugService::createSlug($book, 'slug', $request->title);
        return $this->bookData($fileName, $book, $request);
    }

    public function destroy($book)
    {
        $book->authors()->detach();
        $book->delete();
        return $book->fresh();
    }

    public function booksWithAuthorPublisher()
    {
        return $this->model->with('authors', 'publisher')->get();
    }

    public function bookWithAuthorPublisher($book)
    {
        return $this->model->with('authors', 'publisher')->findOrFail($book);
    }

    /**
     * @param $fileName
     * @param $book
     * @param $request
     * @return mixed
     */
    protected function bookData($fileName, $book, $request)
    {
        $book->image_path = $fileName;
        $book->category_id = $request->input('category');
        if (!empty(auth('admin')->user()->id)) {
            $book->admin_id = auth('admin')->user()->id;
        }
        $book->save();
        $book->authors()->sync($request->get('authors'));
        return $book->fresh();
    }
}
