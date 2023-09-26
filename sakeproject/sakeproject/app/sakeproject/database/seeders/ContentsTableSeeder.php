<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Content;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('contents')->insert([
            'content_id' => '1',
            'user_id' => '1',
            'title' => 'めっちゃ美味しいカクテル！',
            'image' => '1',
            'comment' => '初めて作ったけど簡単でおいしい！',
            'base' => '9',
            'taste' => '2',
            'dosuu' => '2',
            'recipe' =>'・ピーチ・リキュール…45mlにおレンズジュース適量。',
        ]);

        \DB::table('contents')->insert([
            'content_id' => '2',
            'user_id' => '1',
            'title' => '青がきれい',
            'image' => '2',
            'comment' => '鮮やかな色がとても良い',
            'base' => '9',
            'taste' => '5',
            'dosuu' => '2',
            'recipe' =>'・ライチ・リキュール…30ml
            ・ブルーキュラソー（リキュール）…10ml
            ・グレープフルーツジュース…90ml',
        ]);
    }
}
