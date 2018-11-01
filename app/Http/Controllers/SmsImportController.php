<?php

namespace App\Http\Controllers;

use App\Importsm;
use App\Incoming;
use App\CsvData;
use App\Batch;
use App\Send;
use App\Outgoing;
use DB;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SmsImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	
    	$this->authorize("view", Importsm::class);

        $imports=Importsm::latest()->paginate();
    	return view('sms.index',compact('imports'));
    }

     public function incoming()
    {
        
        $this->authorize("view", Incoming::class);

        $incomings=Incoming::latest()->paginate();
        return view('sms.incomings',compact('incomings'));
    }


       public function bulk()
    {
        
        $this->authorize("view", Batch::class);

        $batches=Batch::latest()->paginate();
        return view('sms.bulks',compact('batches'));
    }

       public function createbatch()
    {
        
        $this->authorize("create", Batch::class);
        return view('sms.createbatch');
    }


       public function sendsingle()
    {
        
        
        return view('sms.sendsingle');
    }


       public function storesingle(Request $request)
    {
       
         $this->validate($request, [
            'send_to'     => 'required',
            'text' =>'required'
        ]);

        $sms = Send::create($request->only([
            "send_to",            
            "text"
            
        ]));

         $sms = Outgoing::create($request->only([
            "send_to",            
            "text"

        ]));
      
        return redirect()->route("sendsingle");
    }

      public function storebatch(Request $request)
    {
        $this->authorize("create", Batch::class);
         $this->validate($request, [
            'number'     => 'required'
        ]);
        $batch = Batch::create($request->only([
            "number",            
            "max_count",
            'description'
            
        ]));
      
        return redirect()->route("bulks");
    }

    public function showBatch($number)
    {
    $this->authorize("view", Batch::class);

    $batch=Batch::where('number',$number)->firstOrFail();
    return view('sms.bulksend',compact('batch'));

    }



    public function generate($batch)
    {
        $smsobj= new SmsImportController();
        $imports=Importsm::where("batch_id",$batch)->where('status','tosend')->get();

         /*
        if($smsobj->closedOpenedStatusCheck($payroll_id)=="Closed")
        {
          return redirect()->back()->with("status_error", "Cannot Generate payroll data, Payroll is already closed!"); 
            
        }
        */
       // $batchd = Send::findOrFail($batch);
       // $batchd->delete();

        $smsobj->prepareBatchData($batch,$imports);
        $smsobj->StoreSentBatchData($batch,$imports);
       
        return redirect()->back()->with("status", "Batch data successfully generated");
    }

    public function prepareBatchData($batch,$imports)
    {
        $smsobj= new SmsImportController();
        

     foreach($imports as $import) {
                  $inserts[] = [ 'sender' => $import->sender,
                                 'text' => $import->text,
                                 'send_to' => $import->send_to,
                                 'batch_id'   =>$import->batch_id,
                                 "creator_id" => auth()->id()
                               ]; 

                             $smsobj->updateImport($import->id);
                       }

              DB::table('sends')->insert($inserts);
              return redirect()->back()->with("status", "Batch Sent Successfully!");
    }



     public function StoreSentBatchData($batch,$imports)
    {
        $smsobj= new SmsImportController();
        

     foreach($imports as $import) {
                  $inserts[] = [ 'sender' => $import->sender,
                                 'text' => $import->text,
                                 'send_to' => $import->send_to,
                                 'batch_id'   =>$import->batch_id,
                                 'import_id' =>$import->id,
                                 "creator_id" => auth()->id()
                               ]; 
                       }

              DB::table('outgoings')->insert($inserts);
              return redirect()->back()->with("status", "Batch Sent Successfully!");
    }


     public function updateImport($id)
    {
        $sms=Importsm::where("id",$id)->firstOrFail();
        return $sms->update([
            "status" =>"sent"
            ]);
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
