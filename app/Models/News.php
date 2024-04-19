<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Newsletter;

class News extends Model
{
    use HasFactory;
    protected $guarded = ['id'];



    public function newsletter(){
        return $this->hasMany(Newsletter::class, 'news_id');
    }


}
