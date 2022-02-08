<?php

namespace Modules\Author\Http\Controllers;

use App\Services\Author\AuthorService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Author\Entities\Author;
use Modules\Author\Http\Requests\CreateAuthorRequest;
use Modules\Author\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{

    private $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     * @return Application|ResponseFactory|Response
     */
    public function index()
    {
        return $this->authorService->all();
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
     * @param CreateAuthorRequest $request
     * @return Application|Response|ResponseFactory
     */
    public function store(CreateAuthorRequest $request)
    {
        return $this->authorService->store($request);
    }

    /**
     * Show the specified resource.
     * @param $author
     * @return Application|Response|ResponseFactory
     */
    public function show($author)
    {
        return $this->authorService->show($author);
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
     * @param UpdateAuthorRequest $request
     * @param $author
     * @return Application|Response|ResponseFactory
     */
    public function update(UpdateAuthorRequest $request, $author)
    {
        return $this->authorService->update($request, $author);
    }

    /**
     * Remove the specified resource from storage.
     * @param Author $author
     * @return Application|Response|ResponseFactory
     */
    public function destroy(Author $author)
    {
        return $this->authorService->destroy($author);
    }
}
