<?php

namespace App\Services\Book\Category;

use App\Repository\Book\Category\CategoryRepository;
use App\Traits\general\MediaTrait;
use Illuminate\Support\Collection;

class CategoryService
{
    use MediaTrait;

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all(): Collection
    {
        return $this->categoryRepository->all();
    }

    // store new category and add image category in storage folder
    public function store($request)
    {
        return $this->categoryRepository->store($request);
    }

    public function show($category)
    {
        return $this->categoryRepository->show($category);
    }

    public function edit($category)
    {
        return $this->categoryRepository->edit($category);
    }

    public function update($request, $category)
    {
        return $this->categoryRepository->update($request, $category);
    }

    public function destroy($category)
    {
        return $this->categoryRepository->destroy($category);
    }
}
