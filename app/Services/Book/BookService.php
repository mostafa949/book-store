<?php

namespace App\Services\Book;

use App\Repository\Book\BookRepository;
use App\Traits\general\MediaTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class BookService
{

    use MediaTrait;

    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function all()
    {
        $items = $this->bookRepository->all();
        return response(['data' => $items, 'status' => 200]);
    }

    // store new category and add image category in storage folder
    public function store($request)
    {
        if ($file = $request->file('image')) {
            $imageName = $this->uploads($file, 'images/books/', $request->title);
            $this->bookRepository->store($request, $imageName);
        }
        return $this->all();
    }

    public function show($book)
    {
        try {
            $item = $this->bookRepository->show($book);
            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Book Not Found!', 'status' => 404]);
        }
    }

    public function edit($book)
    {
        return $this->bookRepository->edit($book);
    }

    public function update($request, $book)
    {
        try {
            if ($file = $request->file('image')) {
                $this->delete('images/books/', $book->image_path);
                $fileName = $this->updateUpload($file, $book->image_path, 'images/blog/categories/');
            } else {
                $fileName = $book->image_path;
            }
            $book = $this->bookRepository->update($request, $fileName, $book);
            return response(['data' => $book, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Book Not Found!', 'status' => 404]);
        }
    }

    public function destroy($book)
    {
        try {
            $this->bookRepository->destroy($book);
            return $this->all();
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Book Not Found!', 'status' => 404]);
        }

    }
}
