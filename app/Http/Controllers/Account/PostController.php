<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\PostStoreRequest;
use App\Http\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $posts = Post::all();

        return view('post.index', compact('posts'));
    }

    public function create(Request $request): View
    {
        return view('post.create');
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {

        $post = Post::create(
            array_merge(
                $request->validated(),
                ['author_id' => $request->user()->id]
            )
        );



        return redirect()->route('posts.index')->with('success', __("label.model_created"));
    }

    public function show(Request $request, Post $post): View
    {
        return view('post.show', compact('post'));
    }

    public function edit(Request $request, Post $post): View
    {
        return view('post.edit', compact('post'));
    }

    public function update(PostUpdateRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());

        $request->session()->flash('post.id', $post->id);

        return redirect()->route('posts.index');
    }

    public function destroy(Request $request, Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
