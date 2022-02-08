<?php

namespace Modules\Publisher\Http\Controllers;

use App\Services\Publisher\BookService;
use App\Services\Publisher\PublisherService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Modules\Publisher\Entities\Publisher;
use Modules\Publisher\Http\Requests\CreatePublisherRequest;
use Modules\Publisher\Http\Requests\UpdatePublisherRequest;

class PublisherController extends Controller
{

    private $publisherService;

    public function __construct(PublisherService $publisherService)
    {
        $this->publisherService = $publisherService;
    }

    /**
     * Display a listing of the resource.
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->publisherService->all();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('publisher::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreatePublisherRequest $request
     */
    public function store(CreatePublisherRequest $request)
    {
       return $this->publisherService->store($request);
    }

    /**
     * Show the specified resource.
     * @param Publisher $publisher
     * @return Application|Response|ResponseFactory
     */
    public function show(Publisher $publisher)
    {
        return $this->publisherService->show($publisher);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('publisher::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param UpdatePublisherRequest $request
     * @param Publisher $publisher
     * @return Application|Response|ResponseFactory
     */
    public function update(UpdatePublisherRequest $request, Publisher $publisher)
    {
        return $this->publisherService->update($request, $publisher);
    }

    /**
     * Remove the specified resource from storage.
     * @param Publisher $publisher
     * @return Application|Collection|ResponseFactory|Response
     */
    public function destroy(Publisher $publisher)
    {
        return $this->publisherService->destroy($publisher);
    }
}
