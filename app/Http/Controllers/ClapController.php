<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClapController extends Controller
{
    public function clap(Post $post)
    {
        $hasclapped = Auth::user()->hasClapped($post);

        if ($hasclapped) {
            $post->claps()->where('user_id', Auth::id())->delete();
        } else {
            $post->claps()->create([
                'user_id' => Auth::id(),
            ]);
        }
        return response()->json([
            'clapCount' => $post->claps->count()
        ]);
    }
}
