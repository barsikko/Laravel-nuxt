<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class NewsController extends Controller
{

    public function index(): JsonResource
    {
       $news = News::orderByDesc('created_at')->get();

       return NewsResource::collection($news);
    }

    public function store(CreateNewsRequest $request): JsonResource
    {
        $news = News::create($request->validated());

        return NewsResource::make($news);
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        $news->fill($request->all());

        if ($news->isClean()) {
            return response()->json("You didn't change the data", Response::HTTP_BAD_REQUEST);
        }

        $news->update($request->all());

        return NewsResource::make($news);
    }

    public function destroy(News $news): void
    {
        $news->delete();
    }
}
