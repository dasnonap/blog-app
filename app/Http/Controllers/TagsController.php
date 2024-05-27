<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    private function prepareTagResponseArray($tag, $request)
    {
        return [
            'success' => true,
            'tag' => (new TagResource($tag))->toArray($request)
        ];
    }

    //Create
    function create(Request $request)
    {
        $request->validate([
            'name' => 'required:string'
        ]);

        if ($tag = Tag::where('name', $request->name)->get()->first()) {
            return response()->json(
                $this->prepareTagResponseArray($tag, $request),
                200
            );
        }

        $tag = new Tag([
            'name' => $request->name,
        ]);

        $tag->save();

        return response()->json(
            $this->prepareTagResponseArray($tag, $request),
            200
        );
    }
}
