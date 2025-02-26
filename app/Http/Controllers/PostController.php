<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function personal_blog()
    {
        $user_id = request()->user()->id;
        $posts = Post::where('user_id', $user_id)->where('post_id', null)->get();
        $tags = Tag::all();
        return view('personal-blog', compact('posts', 'tags',));
    }

    public function view_posts()
    {
        $query = request()->query();
        $posts = Post::where('post_id', null);
        $tag_id = null;
        $user_id = null;
        if (array_key_exists("user", $query) && !!$query["user"]) {
            $user_id = $query["user"];
            $posts = $posts->where('user_id', $user_id);
        }
        if (array_key_exists("tag", $query) && !!$query["tag"]) {
            $tag_id = $query["tag"];
            $posts = $posts->whereHas('tags', fn($q) => $q->where('tag_id', $tag_id));
        }
        $posts = $posts->get();
        $tags = Tag::all();
        $users = User::all();

        return view('view-posts', compact('posts', 'users', 'tags', 'user_id', 'tag_id'));
    }

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
            'title' => 'string',
            'description' => 'string',
        ]);
        if (!$request->has('is_public')) {
            $request->merge(['is_public' => 0]);
        }

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_public' => !!$request->is_public,
            'user_id' => request()->user()->id,
            'post_id' => $request->post_id,
        ]);

        return redirect(route($redirect_to, $parameters, absolute: false));
    }

    public function update(Request $request): RedirectResponse
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

        if (!$request->has('is_public')) {
            $request->merge(['is_public' => 0]);
        }
        $post1 = Post::where('id', $request->id)->get()->first();
        if ($post1) {
            $post1->title = $request->title;
            $post1->description = $request->description;
            $post1->is_public = !!$request->is_public;

            $post1->save();
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

        $request->validate([
            'id' => 'integer',
        ]);

        $post1 = Post::where('id', $request->id)->get()->first();
        if ($post1) {
            $post1->delete();
        }

        return redirect(route($redirect_to, $parameters, absolute: false));
    }

}
