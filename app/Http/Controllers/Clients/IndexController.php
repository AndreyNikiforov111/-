<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class IndexController extends Controller
{
    public function __invoke()
    {
        $clients =  Client::all();
        return  response()->json(['clients' => $clients]);

    }
}
