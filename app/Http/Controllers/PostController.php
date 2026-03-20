<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use function Termwind\render;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // \DB::listen(function ($query) {
        //     \Log::info($query->sql);
        // });

        $user = Auth::user();
        $query = Post::with(['user', 'media'])
            ->withCount('claps')
            ->latest();
        if ($user) {
            $ids = $user->following()->pluck('users.id');
            $query->whereIn('user_id', $ids);
        }

        $posts = $query->simplePaginate(10);
        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();

        // $image = $data['image'];
        // unset($data['image']);
        $data['user_id'] = Auth::id();
        // $data['slug'] = Str::slug($data['title']);


        // $imagePath = $image->store('posts', 'public');
        // $data['image'] = $imagePath;

        $post = Post::create($data);

        $post->addMediaFromRequest('image')
            ->toMediaCollection();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $username, Post $post)
    {
        $post->claps_count = $post->claps()->count();
        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $categories = Category::get();
        return view('post.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        // dd($post->user_id);
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validated();

        // $image = $data['image'];
        // unset($data['image']);
        // $data['user_id'] = Auth::id();
        // $data['slug'] = Str::slug($data['title']);

        // $imagePath = $image->store('posts', 'public');
        // $data['image'] = $imagePath;

        $post->update($data);

        if ($data['image'] ?? false) {
            $post->addMediaFromRequest('image')
                ->toMediaCollection();
        }

        return redirect()->route('myposts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('myposts');
    }

    public function category(Category $category)
    {
        // \DB::listen(function ($query) {
        //     \Log::info($query->sql);
        // });

        $posts = $category->posts()
            ->with(['user', 'media'])
            ->withCount('claps')
            ->latest()
            ->simplePaginate(10);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    public function myPosts()
    {
        // \DB::listen(function ($query) {
        //     \Log::info($query->sql);
        // });
        $user = Auth::user();
        $posts = $user->posts()
            ->with(['user', 'media'])
            ->withCount('claps')
            ->latest()
            ->simplePaginate(10);

        return view('post.index', [
            'posts' => $posts,
        ]);
    }
}
