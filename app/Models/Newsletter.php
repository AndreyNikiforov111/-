<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sent;
use App\Models\News;

class Newsletter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dispatchesEvents = [
        'updated' => \App\Events\NewsletterUpdated::class,
    ];

    public function client(){
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    protected function news(){
        return $this->belongsTo(News::class, 'news_id', 'id');
    }
    public function sent()
    {
        return $this->hasOne(Sent::class, 'newsletter_id');
    }
}
