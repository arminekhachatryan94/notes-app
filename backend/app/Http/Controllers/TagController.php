<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\TagService;
use Exception;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(TagService $tagService)
    {
        $tags = $tagService->getAll();

        return response()->json([
            'tags' => $tags,
        ], 200);
    }

    public function store(Request $request, TagService $tagService)
    {
        $request->validate([
            'name' => 'required|string|unique:tags,name',
        ]);

        $tag = $tagService->create($request->name);

        return response()->json([
            'tag' => $tag,
        ], 201);
    }

    public function delete(Tag $tag, TagService $tagService)
    {
        try {
            $tagService->delete($tag);

            return response()->json([
                'message' => 'Successfully deleted tag.'
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'error' => 'Error occurred when trying to delete tag.'
            ], 408);
        }
    }
}
