<?php

namespace App\Services\Author;

use App\Repository\Author\AuthorRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorService
{

    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function all()
    {
        $items = $this->authorRepository->all();
        return response(['data' => $items, 'status' => 200]);
    }

    // store new category and add image category in storage folder
    public function store($request)
    {
        $this->authorRepository->store($request);
        return $this->all();
    }

    public function show($author)
    {
        try {
            $item = $this->authorRepository->show($author);
            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Author : ' . $author->first_name . 'Not Found!', 'status' => 404]);
        }
    }

    public function edit($category)
    {
        return $this->authorRepository->edit($category);
    }

    public function update($request, $author)
    {
        try {
            $item = $this->authorRepository->update($request, $author);
            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Publisher : ' . $author->first_name . 'Not Found!', 'status' => 404]);
        }
    }

    public function destroy($author)
    {
        try {
            $this->authorRepository->destroy($author);
            return $this->all();
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Author : ' . $author->first_name . 'Not Found!', 'status' => 404]);
        }

    }
}
