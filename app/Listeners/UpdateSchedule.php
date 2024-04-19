<?php

namespace App\Listeners;

use App\Events\NewsletterUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Newsletter;
use DateTime;

class UpdateSchedule
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewsletterUpdated $event): void
    {
        $clients = Newsletter::all(); // Retrieve all clients
        //dd($clients[1]->date);

        foreach ($clients as $client) {
            $clientDate = new DateTime($client->date); // Преобразование строки даты в объект DateTime
            $day = $clientDate->format('d'); // Получаем день
            $month = $clientDate->format('m'); // Получаем месяц

            $event->call(function () use ($client) {


                // Отправляем SMS через сервис
                include_once "smsc_api.php";
                list($sms_id, $sms_cnt, $cost, $balance) = send_sms($client->phone, $client->newsletter[0]['content'], 1);


            })->yearlyOn($month, $day, $client->time);
        }
    }
}
