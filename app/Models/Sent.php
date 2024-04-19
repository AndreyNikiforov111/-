<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Newsletter;

class Sent extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class, 'newsletters_id', 'id');
    }

}
