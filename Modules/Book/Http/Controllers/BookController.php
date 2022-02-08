<?php

namespace Modules\Book\Http\Controllers;

use App\Services\Book\BookService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Book\Entities\Book;
use Modules\Book\Http\Requests\CreateBookRequest;
use Modules\Book\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{

    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     * @return Application|ResponseFactory|Response
     */
    public function index()
    {
        return $this->bookService->all();
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
     * @param CreateBookRequest $request
     * @return Application|Response|ResponseFactory
     */
    public function store(CreateBookRequest $request)
    {
        return $this->bookService->store($request);
    }

    /**
     * Show the specified resource.
     * @param $book
     * @return Application|Response|ResponseFactory
     */
    public function show($book)
    {
        return $this->bookService->show($book);
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
     * @param UpdateBookRequest $request
     * @param $book
     * @return Application|Response|ResponseFactory
     */
    public function update(UpdateBookRequest $request, $book)
    {
        return $this->bookService->update($request, $book);
    }

    /**
     * Remove the specified resource from storage.
     * @param Book $book
     * @return Application|Response|ResponseFactory
     */
    public function destroy(Book $book)
    {
        return $this->bookService->destroy($book);
    }
}
