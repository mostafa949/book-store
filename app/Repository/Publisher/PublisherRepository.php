<?php

namespace App\Repository\Publisher;


use App\Repository\BaseRepository;
use Illuminate\Support\Collection;
use Modules\Publisher\Entities\Publisher;

class PublisherRepository extends BaseRepository implements PublisherRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Publisher $model
     */
    public function __construct(Publisher $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->with('books')->get();
    }

    // store new category and add image category in storage folder
    public function store($request)
    {
        return $this->model->create($request->all());
    }

    public function show($publisher)
    {
        $item = $this->withBook($publisher);
        return $item->fresh();
    }

    public function edit($category)
    {
        return $category;
    }

    public function update($request, $publisher)
    {
        $item = $this->withBook($publisher);
        $item->update($request->all());
        return $item->fresh();

    }

    public function destroy($publisher)
    {
        $item = $this->withBook($publisher);
        $item->delete();
        return $item->fresh();
    }

    public function withBook($publisher)
    {
        return $this->model->with('books')->findOrFail($publisher);
    }
}
