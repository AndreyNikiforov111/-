<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Newsletter;
use App\Models\Sent;
use Illuminate\Http\Request;
use App\Http\Controllers\Services\SMSCenter;
use DateTime;

class TestController extends Controller
{
    public function __invoke()
    {
        //include_once "smsc_api.php";
        $client = Client::find(11);
        $NL = Newsletter::find(1);
        $id = 1;
        Sent::create([
            'newsletters_id' =>  $id
        ]);

        dd($NL->news['content']);
        $clientDate = new DateTime($client->newsletter[0]['date']); // Преобразование строки даты в объект DateTime
        $day = $clientDate->format('d');
        //dd($day);
        //$url = "https://smsc.ru/sys/send.php?login=kef&psw=Vf@gW2\$iutcUGA&phones=".$client->phone."&mes=".urlencode($client->newsletter[0]['content']);
        // Отправляем SMS через сервис
        //$response = file_get_contents($url); // Выполняем запрос для отправки SMS
        //dd($client->phone);
        //$smsCenter = new SMSCenter('kef', 'Vf@g$W2$iutcUGA');
        //$response = $smsCenter->sendSMS($client->phone, $client->newsletter[0]['content']);
        //send_sms($client->phone, $message);
        //dd($client->newsletter[0]['content']);
        list($sms_id, $sms_cnt, $cost, $balance) = send_sms($phone, $content, 1);

    }
}
