<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Content;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
  {
    return view('admin.home.dashboard');
  }

  public function users()
  {
    $users = User::where('name')->get();

    return view('admin.adminusers', ['users' => $users]);
  }

  public function contents(Content $content)
  {
    $contents = DB::table('contents')
    ->join('likes', 'contents.content_id', '=', 'likes.content_id')
    ->orderBy('id', 'desc');      
   $contents = Content::orderBy('created_at', 'desc')->get(); 
   $user = Auth::user();
     
   return view('admin.admincontents', compact('contents', 'user')); 
    // $contents = Content::orderBy('created_at', 'desc')->get();
   
    // $user = User::where('id')->get();
    // $like = Like::where('content_id', $content->content_id)
    //                    ->where('user_id',  auth()->user()->id)->first();          
  
    // return view('admin.admincontents', 
    // [
    //   'contents' => $contents,
    //   'user' => $user,
    //   'like' => $like
    // ]);
  }

  public function destroy($id)
  {
    $content = Content::where('content_id', $id);
        $content->delete();

        return redirect()->route('admin.contents');
  }
}
