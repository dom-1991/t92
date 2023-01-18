<?php

namespace App\Http\Controllers;

use App\Helpers\Common;
use App\Http\Requests\SavePostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index (Request $request)
    {
        $ip = Common::getClientIp();
        $posts = Post::with('reactions')->withCount('reactions');
        if ($request->search) {
            $posts->where('name', 'like', "%$request->search%");
        }
        $posts = $posts->orderBy('year')
            ->orderBy('month')
            ->get();
        return view('homepage', compact('posts', 'ip'));
    }

    public function store (SavePostRequest $request)
    {
        $ip = Common::getClientIp();
        $today = Carbon::now()->format('Y-m-d') . ' 00:00:00';
        if (Post::where('ip', $ip)->where('created_at', '>=', $today)->count() >= 5) {
            return redirect()->back()->withErrors(['message' => 'Bạn đã đăng 5 bài viết hôm nay rồi.']);
        }
        $imageUrl = '';
        if ($request->image) {
            $imageName = Storage::put('public/avatar', $request->image);
            $imageUrl = asset(str_replace('public/', 'storage/', $imageName));
        }
        Post::create([
            'name' => $request->name,
            'image' => $imageUrl,
            'body' => $request->body,
            'ip' => $ip,
            'month' => $request->month,
            'year' => $request->year,
            'price_estimate' => $request->price_estimate,
        ]);

        return redirect()->route('homepage', ['search' => $request->name])->with(['message' => 'Thêm thành công!']);
    }

    public function reaction($id)
    {
        $ip = Common::getClientIp();
        $today = Carbon::now()->format('Y-m-d') . ' 00:00:00';
        if(Reaction::where('post_id', $id)->where('ip', $ip)->where('created_at', '>=', $today)->count()) {
            return response()->json(['message' => 'Bạn đã tương tác bài viết này hôm nay rồi!'], 403);
        }

        Reaction::create(['post_id' => $id, 'ip' => $ip]);
        return response()->json(['message' => 'Thành công'], 201);
    }

    public function show ($id, Request $request)
    {
        $post = Post::withCount('reactions')->find($id);
        if ($post) {
            if($request->ajax()) {
                $data = [
                    'view' => view('blocks.post', compact('post'))->render()
                ];
                return response()->json($data, 200);
            }

            return view('posts.show', compact('post'));
        }
        return response()->json([
            'message' => 'Id không tồn tại!'
        ], 404);
    }

    public function comment($id, Request $request)
    {
        $ip = Common::getClientIp();
        Comment::create(['post_id' => $id, 'ip' => $ip, 'text' => $request->text]);
        return redirect()->route('homepage');
    }
}
