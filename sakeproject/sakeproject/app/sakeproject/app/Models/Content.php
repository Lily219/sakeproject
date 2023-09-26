<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $primaryKey = 'content_id';

    public function user() {
        return $this->belongsTo(User::class);
    }
 
    public function likes() {
        return $this->hasMany(Like::class, 'content_id');
    }

     //後でViewで使う、いいねされているかを判定するメソッド。
     public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('content_id', $this->content_id)->first() !==null;
    }
    

    public function contentStore(Int $user_id, Array $data)
    {
       
        $this->user_id = $user_id;
        $this->title = $data['title'];
       //$this->image = $data['image'];
        $this->base = $data['base_category'];
        $this->taste = $data['taste_category'];
        $this->dosuu = $data['dosuu_category'];
        $this->comment = $data['comment'];
        $this->recipe = $data['recipe'];
        $this->save();

        return;
    }

    // public function contentUpdate(Int $user_id, Array $data)
    // {
    //     $this->user_id = $user_id;
    //     $this->title = $data['title'];
    //    //$this->image = $data['image'];
    //     $this->base = $data['base_category'];
    //     $this->taste = $data['taste_category'];
    //     $this->dosuu = $data['dosuu_category'];
    //     $this->comment = $data['comment'];
    //     $this->recipe = $data['recipe'];
    //     $this->save();
       
    //     return ;
    // }

   
}
