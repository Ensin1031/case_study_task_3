<?php

namespace App\Http\Controllers;

use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostTagController extends Controller
{

    public function store(Request $request)
    {
        $query = $request->query();
        $redirect_to = 'personal-blog';
        $parameters = [];
        if (array_key_exists("redirect_to", $query)) {
            $redirect_to = $query["redirect_to"];
        }
        if (array_key_exists("query_parameters", $query)) {
            $parameters = $query["query_parameters"];
        }

        $request->validate([
            'post_id' => 'integer',
            'title' => 'string',
        ]);

        $tag = Tag::firstOrCreate([
            'title' => $request->title
        ]);

        if (count(PostTag::where('tag_id', $tag->id)->where('post_id', $request->post_id)->get()) === 0) {
            PostTag::create([
                'post_id' => $request->post_id,
                'tag_id' => $tag->id,
            ]);
        }

        return redirect(route($redirect_to, $parameters, absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $query = $request->query();
        $redirect_to = 'personal-blog';
        $parameters = [];
        if (array_key_exists("redirect_to", $query)) {
            $redirect_to = $query["redirect_to"];
        }
        if (array_key_exists("query_parameters", $query)) {
            $parameters = $query["query_parameters"];
        }

        if ($request->tag_id && $request->post_id) {
            $posts = PostTag::where('tag_id', $request->tag_id)->where('post_id', $request->post_id)->get();
            for ($i = 0; $i < count($posts); $i++) {
                PostTag::destroy($posts[$i]->id);
            }
        }

        return redirect(route($redirect_to, $parameters, absolute: false));
    }

}
