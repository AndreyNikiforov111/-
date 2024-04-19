<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CsvImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        // Handle date formatting if needed
        $birthdate = date('Y-m-d', strtotime("1899-12-30 + {$row['birthdate']} days"));

        // Perform data transformation and create the model instance
        return new Client([
            'name' => $row['name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'birthdate' => $birthdate,
        ]);
    }
}
