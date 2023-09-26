<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Osake;


class OsakeController extends Controller
{

    public function search(Request $request)
     {
       
        $bases = config('base_category');
        $tastes = config('taste_category');
        $dosuus = config('dosuu_category');
        $query = Osake::query();
        

        //$request->input()で検索時に入力した項目を取得。
        $keyword = $request->get('keyword');
        $base_category = $request->get('base_category');
        $taste_category = $request->get('taste_category');
        $dosuu_category = $request->get('dosuu_category');
       
        // フリーワード検索で入力した文字列を含むカラムを取得します
        if ($keyword!=null) {
           $query->where('title', 'like', "%$keyword%")->get();    
        }

        // プルダウンメニューで指定なし以外を選択した場合、$query->whereで選択したbaseと一致するカラムを取得します
        if ($base_category!=1) {
           $query->where('base_category_id', $base_category)->get();
        }
       

        // プルダウンメニューで指定なし以外を選択した場合、$query->whereで選択したtasteと一致するカラムを取得します
        if ($taste_category!=1) {
           $query->where('taste_category_id', $taste_category)->get();
        }
        

         // プルダウンメニューで指定なし以外を選択した場合、$query->whereで選択したdosuuと一致するカラムを取得します
         if ($dosuu_category!=1) {
           $query->where('dosuu_category_id', $dosuu_category)->get();
        }
       

        //$queryをosake_idの昇順に並び替えて$dataに代入
        $data = $query->orderBy('osake_id', 'asc')->paginate(15);

        return view('osakesearch',     
         [
            'keyword' => $keyword,
            'base_category' => $base_category,
            'taste_category' => $taste_category,
            'dosuu_category' => $dosuu_category,
            'data' => $data,
        ]);
    }

    public function show($id)
    {
       $result = Osake::where('osake_id', $id)->first();
       
       $base_category = [
         '2' => 'ジン',
         '3' => 'ウォッカ',
         '4' => 'ラム',
         '5' => 'テキーラ',
         '6' => 'ワイン',
         '7' => 'ビール',
         '8' => 'ウィスキー',
         '9' => 'リキュール',
         '10' => '日本酒',
         '11' => 'ノンアルコール'
       ];

       $taste_category = [
        '2' => '甘め',
        '3' => 'やや甘め',
        '4' => 'さっぱり',
        '5' => 'ややさっぱり',
        '6' => '辛め',
        '7' => 'やや辛め',
      ];

      $dosuu_category = [
         '2' => '0~10度',
         '3' => '11~20度',
         '4' => '21~30度',
         '5' => '31~40度',
         '6' => '41度以上',
      ];

       $data = [
         'title' => $result['title'],
         'base_category_name' => $base_category[$result['base_category_id']],
         'taste_category_name' => $taste_category[$result['taste_category_id']],
         'dosuu_category_name' => $dosuu_category[$result['dosuu_category_id']],
         'comment' => $result['comment'],
         'recipe' => $result['recipe'],
       ];
   
       return view('osakeshow', compact('data'));
    }
    
  
}
