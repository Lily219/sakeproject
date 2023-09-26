<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Like;
use App\Models\Osake;


class ContentController extends Controller
{
   
    public function index(Content $content)
    {
        $contents = Content::withCount('likes')
        ->orderBy('created_at', 'desc')
        ->get();
        $user = Auth::user();

        return view('content', compact('contents', 'user'));
    //     $contents = DB::table('contents')
    //      ->join('likes', 'contents.content_id', '=', 'likes.content_id')
    //      ->select('contents.content_id', DB::raw('count(likes.content_id) as count'))
    //      ->groupBy('likes.content_id')->get(); 
        
    //      //->orderBy('id', 'desc');      
    //     $contents = Content::orderBy('created_at', 'desc')->get(); 
       
    //     //dd($contents);
    //     $user = Auth::user();
          
    //     return view('content', compact('contents', 'user')); 
     } 


    public function like(Request $request)
    {
        try {
            $user_id = Auth::user()->id; //1.ログインユーザーのid取得
            $content_id = $request->content_id; //2.投稿idの取得
            $already_liked = Like::where('user_id', $user_id)->where('content_id', $content_id)->first(); //3.
        
            if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
                $like = new Like; //4.Likeクラスのインスタンスを作成
                $like->content_id = $content_id; //Likeインスタンスにreview_id,user_idをセット
                $like->user_id = $user_id;
                $like->save();
            } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
                Like::where('content_id', $content_id)->where('user_id', $user_id)->delete();
            }
           
            //5.この投稿の最新の総いいね数を取得

            $content_likes_count = DB::table('contents')
            ->leftJoin('likes', 'contents.content_id', '=', 'likes.content_id')
            ->select('contents.content_id', DB::raw('count(likes.content_id) as count'))
            ->groupBy('contents.content_id')
            ->get();

            $param = [
                'content_likes_count' => $content_likes_count,
            ];
            return response()->json($param); //6.JSONデータをjQueryに返す
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }


    public function show($id)
    {
        $result = Content::where('content_id', $id)->first();
       
        $data = [
          'title' => $result['title'],
          'base_category_name' => $result['base'],
          'taste_category_name' => $result['taste'],
          'dosuu_category_name' => $result['dosuu'],
          'comment' => $result['comment'],
          'recipe' => $result['recipe'],
        ];
       
       return view('contentshow', compact('data'));
    }
       

    public function create(Request $request)
    {
        $user = auth()->user();

        return view('contentcreate', [
            'user' => $user,
        ]);
    }

    public function store(Request $request, Content $content)
    {
        
        $data = $request->all();
       $user = auth()->user();
        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:50'],
            'comment' => ['required', 'string', 'max:100'],
            'recipe' => ['nullable', 'string', 'max:100']
        ]);
        
        $validator->validate();
        $content->contentStore($user->id, $data);

        return redirect("content");  
        
    }

    public function edit($id)
    {
        $content = Content::where('content_id', $id)->first();

        return view('contentedit', compact('content'));
    }


    public function update(Request $request)
    {
        //$contents = Content::all();
        $contents = $request->all();
        $validator = Validator::make($contents, [
            'title' => ['required', 'string', 'max:50'],
            'comment' => ['required', 'string', 'max:100'],
            'recipe' => ['nullable', 'string', 'max:100']
        ]);

        $validator->validate();
        Content::where('content_id', $request->content_id)->update([
            'title' => $request->title,
            'base' => $request->base_category,
            'taste' => $request->taste_category,
            'dosuu' => $request->dosuu_category,
            'comment' => $request->comment,
            'recipe' => $request->recipe,
        ]);


        //  $content = Content::select('contents.content_id')->first();
       
        // $user = auth()->user();
        // $data = $request->all();
       
        //      $validator = Validator::make($data, [
        //     'title' => ['required', 'string', 'max:50'],
        //     'comment' => ['required', 'string', 'max:100']
        // ]);
        
        // $validator->validate();
        // $content->contentUpdate($user->id, $data, $content_id);
       
        return redirect("content")->with([
            'contents' => $contents
            
        ]);  

    }

    public function destroy($id)
    {
        $content = Content::where('content_id', $id);
        $content->delete();

        return redirect("content");
    }


}
