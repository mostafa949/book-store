<?php

namespace Modules\Book\Http\Controllers;


use App\Services\Book\Category\CategoryService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Modules\Book\Entities\Category;
use Modules\Book\Http\Requests\CreateCategoryRequest;
use Modules\Book\Http\Requests\UpdateCategoryRequest;

class CategoriesController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->categoryService->all();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('book::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateCategoryRequest $request
     * @return Application|Response|ResponseFactory
     */
    public function store(CreateCategoryRequest $request)
    {
        return $this->categoryService->store($request);
    }

    /**
     * Show the specified resource.
     * @param $category
     * @return Application|Response|ResponseFactory
     */
    public function show($category)
    {
        return $this->categoryService->show($category);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('book::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCategoryRequest $request
     * @param $category
     * @return Application|Response|ResponseFactory
     */
    public function update(UpdateCategoryRequest $request, $category)
    {
        return $this->categoryService->update($request, $category);
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return Application|Response|ResponseFactory
     */
    public function destroy(Category $category)
    {
        return $this->categoryService->destroy($category);
    }
}
