<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Osake extends Model
{
    use HasFactory;

    protected $table = "osakes"; 

     //数字から実際の名前へと変換する
    public function getBaseNameAttribute()
    {
        return config('base_category.'.$this->base_category_id);
    }

    public function getTasteNameAttribute()
    {
        return config('taste_category.'.$this->taste_category_id);
    }

    public function getDosuuNameAttribute()
    {
        return config('dosuu_category.'.$this->dosuu_category_id);
    }
}

