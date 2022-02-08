<?php

namespace App\Services\Publisher;

use App\Repository\Publisher\PublisherRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class PublisherService
{

    protected $publisherRepository;

    public function __construct(PublisherRepository $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    public function all(): Collection
    {
        return $this->publisherRepository->all();
    }

    // store new category and add image category in storage folder
    public function store($request)
    {
        return $this->publisherRepository->store($request);
    }

    public function show($publisher)
    {
        try {
            $item = $this->publisherRepository->show($publisher);
            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Publisher : ' . $publisher->first_name . 'Not Found!', 'status' => 404]);
        }
    }

    public function edit($category)
    {
        return $this->publisherRepository->edit($category);
    }

    public function update($request, $publisher)
    {
        try {
            $item = $this->publisherRepository->update($request, $publisher);
            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Publisher : ' . $publisher->first_name . 'Not Found!', 'status' => 404]);
        }
    }

    public function destroy($publisher)
    {
        try {
            $this->publisherRepository->destroy($publisher);
            return $this->all();
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Publisher : ' . $publisher->first_name . 'Not Found!', 'status' => 404]);
        }

    }
}
