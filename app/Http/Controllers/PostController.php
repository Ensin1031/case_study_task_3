<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $post1 = Post::find(1);
        dump($post1);
        $posts = Post::where('user_id', 2)->get();
        dump($posts);
        $posts = Post::all();
        dump($posts);
        $post_tags = PostTag::where('post_id', 2)->get();
        dump($post_tags);
        return view('posts', compact('posts', 'post1'));
    }

    public function personal_blog()
    {
        $user_id = request()->user()->id;
        $posts = Post::where('user_id', $user_id)->where('post_id', null)->get();
        $tags = Tag::all();
        return view('personal-blog', compact('posts', 'tags',));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string',
            'description' => 'string',
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => request()->user()->id,
            'post_id' => $request->post_id,
        ]);

        return redirect(route('personal-blog', absolute: false));
    }

    public function update(Request $request): RedirectResponse
    {
        dump($request);

        return redirect(route('personal-blog', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        dump($request);

        return redirect(route('personal-blog', absolute: false));
    }

    public function createMMMMMMM()
    {
        $postsArr = [
            [
                'title' => 'YYYYyyyyRRRrrrr',
                'description' => 'rtyrtyrtyrtyrty rtyrtyrt rsd sdsd dsdsdsd sd sd  ds dty ryrt rty rtyryrty rty',
                'user_id' => 1,
            ],
            [
                'title' => 'YYYYyyyyRRRrrTTtttttRREeeeEEeerr',
                'description' => 'rtyrtyrtyrtyrty rtyrtyrt rsd sdsd dsdsdsd sd sd  ds dty ryrt rty rtyryrty rty fgd jukk  uykjukuiku uk uk ',
                'user_id' => 1,
            ],
            [
                'title' => 'TTtttttRREeeeEEeerr',
                'description' => 't rty rtyryrty rty fgd jukk  uykjukuiku uk uk ',
                'user_id' => 1,
            ],
        ];
        foreach ($postsArr as $post) {
            Post::create([
                'title' => $post['title'],
                'description' => $post['description'],
                'user_id' => $post['user_id'],
            ]);
        }
    }
}
