<?php

namespace App\Repository\Book\Category;


use App\Repository\BaseRepository;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Collection;
use Modules\Book\Entities\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    // store new category and add image category in storage folder
    public function store($request)
    {
        $category = new $this->model;
        $category->title = $request->input('title');
        $category->description = $request->input('description');
        if (!empty(auth('admin')->user()->id)) {
            $category->admin_id = auth('admin')->user()->id;
        }
        $category->save();

        return $category->fresh();
    }

    public function show($category)
    {
        return $category;
    }

    public function edit($category)
    {
        return $category;
    }

    public function update($request, $category)
    {
        $category->title = $request->input('title');
        $category->description = $request->input('description');
        $category->slug = SlugService::createSlug($category, 'slug', $request->title);
        if (!empty(auth('admin')->user()->id)) {
            $category->admin_id = auth('admin')->user()->id;
        }
        $category->save();
        return $category->fresh();

    }

    public function destroy($category)
    {
        $category->delete();
        return $category->fresh();
    }
}
