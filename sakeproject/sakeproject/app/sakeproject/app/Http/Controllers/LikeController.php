<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    // public function like($contentId)
    // {
    //     Auth::user()->like($contentId);
    //     return 'ok!'; //レスポンス内容
    // }

    // public function unlike($contentId)
    // {
    //     Auth::user()->unlike($contentId);
    //     return 'ok!'; //レスポンス内容
    // }
//↑js使う記載


        public function like(string $content_id)
        {
        $like=New Like();
        $like->content_id=$content_id;
      
        $like->user_id = Auth::user()->id;

        if(Auth::check()){
            $like->user_id=Auth::user()->id;
        }
        $like->save();
        
        return back();
    }

    public function unlike(string $content_id){
        $user=Auth::user()->id;
        $like=Like::where('content_id', $content_id) 
                     ->where('user_id', $user)->first();
        $like->delete();
        return back();
    }
}
