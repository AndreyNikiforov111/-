<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'date' => 'required|date_format:Y-m-d',
        ]);

        $bd = Client::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'birthdate' => $data['date'],


        ]);
        return response()->json(['result' =>'Клиент создан']);
    }
}
