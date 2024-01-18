<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = tap(News::orderBy('created_at', 'DESC')->simplePaginate(
            $request->size ? $request->size : 5, // per page (may be get it from request)
            ['*'], // columns to select from table (default *, means all fields)
            'page', // page name that holds the page number in the query string
            $request->page ? $request->page : 1 // current page, default 1
        ), function ($paginatedInstance) {
            return $paginatedInstance->getCollection()->transform(function ($value) {
                $value->created_at_for_humans = $value->created_at->diffForHumans();

                return $value;
            });
        });

        return response()->json([
            'data' => $news
        ], 200);
    }

    public function show($id)
    {
        return response()->json([
            'data' => News::find($id),
        ]);
    }
}
