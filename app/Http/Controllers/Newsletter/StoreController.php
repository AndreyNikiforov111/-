<?php

namespace App\Http\Controllers\Newsletter;

use App\Models\Newsletter;
use App\Models\Client;
use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {

        try {
            DB::beginTransaction();
        $clients = Client::all();
        $news = News::create([
            'name' => $request->input('name'),
            'content' => $request->input('content'),

        ]);
        foreach ($clients as $client){
            if ($request->input('choice') === 'option2'){

                        $newDate = new DateTime($client['birthdate']);;
                    for ($i = 0; $i < 7; $i++) {
                        $newDate = $newDate->modify('-1 day'); // Вычитаем один день
                        Newsletter::create([
                            'client_id' => $client['id'],
                             'news_id' => $news['id'],
                            'time' => '10:30:00',
                            'date' => $newDate
                        ]);
                    }
                //}
            } else{
                Newsletter::create([
                    'client_id' => $client['id'],
                    'news_id' => $news['id'],
                    'time' => $request->input('time'),
                    'date' => Carbon::now()
                ]);
            }
        }
            DB::commit();
        }catch (\Exception $exception ){
            DB::rollBack();
            return $exception->getMessage();
        }

        return response()->json(['result' => 'Рассылка создана успешно']);
        //dd(Newsletter::find(1)->client['name']);
    }
}
