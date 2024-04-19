<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\ClientImport;
use App\Imports\CsvImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function __invoke(Request $request)
    {
        $file = $request->file('file');
        //return response()->json(['file' => $file]);
        if ($request->hasFile('file') && $request->file('file')->getClientOriginalExtension() == 'csv') {
            $extension = 'csv';
        } elseif ($request->hasFile('file') && $request->file('file')->getClientOriginalExtension() == 'xlsx') {
            $extension = 'xlsx';
        } else {
            //dd($file);
            return response()->json(['error' => 'Invalid file format. Supported formats: CSV, Excel']);
        }

        // Based on the file format, conditionally call the appropriate import class
        if ($extension == 'csv') {

            //$importedData = Excel::toArray(new CsvImport, $request->file('file'));
            //dd($importedData);
            Excel::import(new CsvImport, $request->file('file'));
        } elseif ($extension == 'xlsx') {
            Excel::import(new ClientImport, $request->file('file'));
        }

        return response()->json(['result' => 'Импортировано успешно']);
    }
}
