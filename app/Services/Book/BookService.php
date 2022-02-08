<?php

namespace App\Services\Book;

use App\Repository\Book\BookRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class BookService
{

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
        $this->bookRepository->store($request);
        return $this->all();
    }

    public function show($book)
    {
        try {
            $item = $this->bookRepository->show($book);
            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Book : ' . $book->name . 'Not Found!', 'status' => 404]);
        }
    }

    public function edit($category)
    {
        return $this->bookRepository->edit($category);
    }

    public function update($request, $book)
    {
        try {
            $item = $this->bookRepository->update($request, $book);
            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Publisher : ' . $book->name . 'Not Found!', 'status' => 404]);
        }
    }

    public function destroy($book)
    {
        try {
            $this->bookRepository->destroy($book);
            return $this->all();
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Book : ' . $book->name . 'Not Found!', 'status' => 404]);
        }

    }
}
