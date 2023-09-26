<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Content;
use App\Models\Like;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    // public function index(Content $content)
    // {
    //     //$user = auth()->user();
    //    // $contents = Content::where('user_id', \Auth::user()->id)->get();
    //     $user = Auth::user()->id;
    //     $contents = Content::all();
    //     $like = Like::all();
    //    // dd($like);  
    //     return view('mypage', 
    //     [
    //         'contents' => $contents,
    //         'user' => $user,   
    //         'like' => $like
    //     ]);

    // }
    public function index()
    {
        // タブAの内容を取得するクエリ
       $contents = Content::where('user_id', Auth::id())->get();

        // タブBの内容を取得するクエリ（自分がいいねした投稿を取得する例）
       $likes = Auth::user()->likes; // "likes" は User モデル内のリレーションであると仮定しています
//dd($likes);
       return view('mypage', compact('contents', 'likes'));
    }
}
