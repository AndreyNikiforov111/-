<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class CreateController extends Controller
{
    public function __invoke()
    {
        $count = Client::count();
        return response()->json(['count' => $count]);
    }
}
