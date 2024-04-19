<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Newsletter;
use App\Models\User;
use App\Models\Sent;
use DateTime;
use App\Console\Commands\SendScheduledSmsCommand;
use App\Console\Command;
use Illuminate\Support\Facades\DB;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        Commands\SendScheduledSMS::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $clients = Newsletter::all();
        $filteredClients = $clients->reject(function ($client) {
            return Sent::where('newsletter_id', $client->id)->exists();
        });


        foreach ($filteredClients as $client) {
            $clientDate = new DateTime($client->date); // Преобразование строки даты в объект DateTime
            $day = $clientDate->format('d'); // Получаем день
            $month = $clientDate->format('m'); // Получаем месяц
            $time = \Carbon\Carbon::parse($client->time)->format('H:i');
            $id = $client['id'];
            $phone = $client->client['phone'];
            $content = $client->news['content'];


            $schedule->command('app:send-scheduled-sms', [ $id, $phone,  $content])
                     ->yearlyOn($month, $day, $time)
                     ->timezone('Asia/Omsk');
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
