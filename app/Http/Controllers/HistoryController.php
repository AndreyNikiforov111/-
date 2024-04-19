<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Sent;
use App\Models\Newsletter;

class HistoryController extends Controller
{
    public function __invoke(Request $request)
    {
        //dd($request->input('selectedDate'));
        $selectedDate = $request->input('selectedDate') ? $request->input('selectedDate') : 'sevenDays';
        $news = News::all();
        $sent = Sent::all();
        $data = [];
        $firstNewsletter = Newsletter::orderBy('created_at', 'asc')->first();

        $dateStart = $firstNewsletter ? $firstNewsletter->created_at->format('Y-m-d') : null;

        //$newsletters = News::find(1);
        //dd($dateStart);
        $dateStartObject = new \DateTime($dateStart);
        $dateEndObject = clone $dateStartObject; // Clone the initial date
        switch ($selectedDate){
            case 'sevenDays';
                $dateEndObject->modify('+7 days');
                $dateEnd = $dateEndObject->format('Y-m-d');
                break;
            case 'oneMonth';
                $dateEndObject->modify('+1 month');
                $dateEnd = $dateEndObject->format('Y-m-d');
                break;
            case 'threeMonth';
                $dateEndObject->modify('+3 month');
                $dateEnd = $dateEndObject->format('Y-m-d');
                break;
            case 'oneYear';
                $dateEndObject->modify('+1 year');
                $dateEnd = $dateEndObject->format('Y-m-d');
                break;
            default:
                $dateEnd = null;
                break;
        }
        //echo  $dateStart;
        //dd($dateEnd);
        foreach ($news as $item){

            //echo $item -> newsletter->count();
            $newslettersId = $item->newsletter;
            //dd($newslettersId);
            $sentRecordsCount =[];
            foreach ($newslettersId as $component){

                /*if ($selectedDate == 'oneYear'){
                    $sentRecordsCount[] = Sent::all();
                    dd($sentRecordsCount);
                }else{*/
                    $sentRecords = Sent::where('newsletter_id', $component->id)
                        ->whereBetween('created_at', [$dateStart, $dateEnd])
                        ->get();
                    if ($sentRecords->isNotEmpty()) {  // Check if the result set is not empty
                        $sentRecordsCount[] = $sentRecords;
                    }
                /*}*/
            }
            //dd($dateEnd, $dateStart,  $sentRecordsCount);
            //$sentRecords = Sent::where('newsletters_id', $newslettersId)->get(); // Поиск всех строк в таблице Sent с указанным news_id
            //$sentRecordsCount = $sentRecords->count();

            /*$filteredNewsLetters = $newslettersId->filter(function ($newsLetter) use ($sent) {
                return $sent->contains('id', $newsLetter->id);
            });*/
            /*$dateEndObject = new \DateTime($dateEnd);
            $newDateEnd = $dateEndObject->format('m-d');

            $dateStartObject = new \DateTime($dateStart);
            $newDateStart = $dateStartObject->format('m-d');
            //dd($dateEnd);

            $filteredNewsletters = $item->newsletter->filter(function ($newsletter) use ($newDateStart, $newDateEnd) {

                    $dateObject = new \DateTime($newsletter->date);
                    $date = $dateObject->format('m-d');

                $dateEndObject = new \DateTime($newDateEnd);
                $newDateEnd = $dateEndObject->format('m-d');

                $dateStartObject = new \DateTime($newDateStart);
                $newDateStart = $dateStartObject->format('m-d');
                    $currentDate = new \DateTime($date);

                    return $currentDate >= $newDateStart && $currentDate <= $newDateEnd;

            });*/
            /*$filteredNewsletters = $item->newsletter->filter(function ($newsletter) use ($dateStart, $dateEnd) {
                $dateObject = new \DateTime($newsletter->date);
                $currentDate = $dateObject->format('M-d');

                $startDate = new \DateTime($dateStart);

                $endDate = new \DateTime($dateEnd);

                return $currentDate >= $startDate->format('M-d') && $currentDate <= $endDate->format('M-d');
            });*/


                /*$filteredNewsletters = $item->newsletter->filter(function ($newsletter) use ($dateStart, $dateEnd) {
                    return $newsletter->date >= $dateStart && $newsletter->date <= $dateEnd;
                });*/
            /*if ($selectedDate === 'oneYear'){
                $monthDayEndAdd = new \DateTime($dateEnd);
                $monthDayEndAdd->modify("-1days");
                $dateEnd = $monthDayEndAdd->format('Y-m-d');
            }*/
            $monthDayStart = date('m-d', strtotime($dateStart));
            $monthDayEnd = date('m-d', strtotime($dateEnd));
            /*$carbonDate = Carbon::createFromFormat('Y-m-d', $monthDayEnd);
            $newDate = $carbonDate->subDay();
            $monthDayEnd = $newDate->format('m-d');*/

            //dd($monthDayStart, $monthDayEnd, $item->newsletter);
            if ($selectedDate === 'oneYear'){
                $filteredNewsletters = $item->newsletter;
            }else{
                $filteredNewsletters = $item->newsletter->filter(function ($newsletter) use ($monthDayStart, $monthDayEnd) {
                    $newsletterMonthDay = date('m-d', strtotime($newsletter->date));

                    return $newsletterMonthDay >= $monthDayStart && $newsletterMonthDay <= $monthDayEnd;
                });
            }




            //dd($filteredNewsletters);
            $data[] = [
                'id' =>  $item->id,
                'name' => $item->name,
                'total_newsletters' => $filteredNewsletters->count(),
                'send_newsletters' => count($sentRecordsCount),
                //'send_newsletters' => $filteredNewsLetters->count(),
            ];
        }
        /*$newsletters = [];
        foreach ($data as $item) {
            $newsletters[] = $item; // Просто копируем элементы, не меняя их структуру
        }*/


        /*$filteredNewsLetters = $newslettersId->filter(function ($newsLetter) use ($sent, $dateStart, $dateEnd) {
            return $sent->contains('id', $newsLetter->id) && ($newsLetter->created_at >= $dateStart && $newsLetter->created_at <= $dateEnd);
        });
        $filteredTotalNewsletters = $item->newsletter->filter(function ($newsletter) use ($dateStart, $dateEnd) {
            return $newsletter->created_at >= $dateStart && $newsletter->created_at <= $dateEnd;
        });

        $data[] = [
            'total_newsletters' => $filteredTotalNewsletters->count(),
            'send_newsletters' => $filteredNewsLetters->count(),
        ];*/
        //dd($data);
        return response()->json(['newsletters' => $data, 'dateStart' => $dateStart]);
    }
}
