<?php

namespace App\Http\Controllers;

use App\Importsm;
use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SmsImportController extends Controller
{
    public function index()
    {
    	
    	$this->authorize("view", Importsm::class);

        $imports=Importsm::latest()->paginate();
    	return view('sms.index',compact('imports'));
    }
    public function getImport()
    {
        return view('sms.import');
    }

    public function parseImport(CsvImportRequest $request)
    {

        $path = $request->file('csv_file')->getRealPath();

        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }

        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0, count($data));

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('sms.import_fields', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));

    }

    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $importsm = new Importsm();
            foreach (config('app.sms_fields') as $index => $field) {
                if ($data->csv_header) {
                    $importsm->$field = $row[$request->fields[$field]];
                } else {
                    $importsm->$field = $row[$request->fields[$index]];
                }
            }
            $importsm->save();
        }

        return view('sms.import_success');
    }

}
