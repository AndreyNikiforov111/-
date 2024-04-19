<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        // Convert the numeric date value to a proper date format
        $birthdate = ($row[3] - 25569) * 86400; // Convert Excel timestamp to Unix timestamp
        $birthdate = gmdate("Y-m-d", $birthdate); // Convert Unix timestamp to date format

        return new Client([

            'name'     => $row[0],
            'phone'    => $row[1],
            'email'    => $row[2],
            'birthdate'=> $birthdate,

        ]);
    }
}
