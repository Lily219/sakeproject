<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function contents() {
        return $this->hasMany('App\Models\Content');
    }
 
    public function likes() {
        return $this->belongsToMany(Content::class, 'likes', 'user_id', 'content_id');
    }




    //↓いいねの記載
 //多対多のリレーションを書く
//  public function likes()
//  {
//      return $this->belongsToMany('App\Models\Content','likes','user_id','content_id')->withTimestamps();
//  }

//  //この投稿に対して既にlikeしたかどうかを判別する
//  public function isLike($contentId)
//  {
//    return $this->likes()->where('content_id',$contentId)->exists();
//  }

//  //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
//  public function like($contentId)
//  {
//    if($this->isLike($contentId)){
//      //もし既に「いいね」していたら何もしない
//    } else {
//      $this->likes()->attach($contentId);
//    }
//  }

//  //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
//  public function unlike($contentId)
//  {
//    if($this->isLike($contentId)){
//      //もし既に「いいね」していたら消す
//      $this->likes()->detach($contentId);
//    } else {
//    }
//  }

}
