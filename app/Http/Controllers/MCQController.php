<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\MCQ;
use App\Subject_Id;
use App\Module_Id;
use PDF;
use Redirect;

// ini_set('max_execution_time', -1);

class MCQController extends Controller
{
    public function index() {
    	
        $subject = Subject_Id::Select('*')->get();

        

        return view('mcqform', ['subject' => $subject]);
    }

    public function getModuleList($subjectid){
        $module = Module_Id::select('*')
                    ->where("subjectid",$subjectid)->get();
        // print_r($series_id);
            // sleep(2);
        // exit();
        return response()->json($module);
    }

    public function create(Request $request)
    {
        $date = date('d-m-Y');
        $institute_name = $request->institute_name;
    	$total_mcq_no = $request->total_mcq_no;
    	$type = $request->type;
        $subjectid = $request->subject;
        $moduleid = $request->module;

        // Creating Array of Subject Data
        $subjectid = $request->get('subject');

        $subject = Collection::make();
        foreach ($subjectid as $key => $value) {
            $result[$key] = Subject_Id::Select('*')->where('subjectid',$subjectid[$key])->get();
            $subject = $subject->merge($result[$key]);           
        }


        // Creating Array of Module Data
        $moduleid = $request->get('module');

        $module = Collection::make();
        foreach ($moduleid as $key => $value) {
            $result[$key] = Module_Id::Select('*')->where('moduleid',$moduleid[$key])->where('subjectid',$subjectid[$key])->get();
            $module = $module->merge($result[$key]);           
        }

        // Creating Array of No. of MCQ Data
        $mcqno = $request->get('mcqno');

        //echo "<pre>"; print_r($subjectid); print_r($moduleid); print_r($mcqno); exit();

        //Create Empty Collection
        $que = Collection::make();

        foreach ($subjectid as $key => $value) {
            $result[$key] = MCQ::Select('*')->where('subjectid',$subjectid[$key])->limit($mcqno[$key])->inRandomOrder()->get(); 
            $que = $que->merge($result[$key]);           
        }

    	//$que = MCQ::Select("*")->where("subjectid",$subjectid)->where("moduleid",$moduleid)->limit($total_mcq_no)->inRandomOrder()->get();
        // return view('mcq')->with('institute_name', $institute_name)
        //                 ->with('subject', $subject)
        //                 ->with('date', $date)
        //                 ->with('module', $module)
        //                 ->with('total_mcq_no', $total_mcq_no)
        //                 ->with('que', $que)
        //                 ->with('type', $type);
        
        //return view('mcq',  ['subject' => $subject], ['date' => $date], ['module' => $module], ['total_mcq_no' => $total_mcq_no], ['que' => $que], ['type' => $type]);        

        // echo "<pre>"; print_r($subject); 
        // exit();

        view()->share('institute_name', $institute_name);
        view()->share('subject', $subject);
        view()->share('date', $date);
        view()->share('module', $module);
        view()->share('total_mcq_no', $total_mcq_no);

        view()->share('que', $que);
        view()->share('type', $type);
        
        $name = sha1( time()).rand(10000,99999).".pdf";
        PDF::loadView('mcq')->save(public_path().'/pdf/'.$name);
        
        return $name;
        //$pdf = PDF::loadView('mcq');
        //return $pdf->download($name); 
    }

    /* Database Insert */
    public function get_index( $char ){
        switch ($char) {
            case 'A': return 3;
            case 'B': return 4;
            case 'C': return 5;
            case 'D': return 6;

        }
    }
    public function test()
    {
        $i = 0;
        if (($handle = fopen(public_path()."/a.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if( empty($data[2]) ){
                continue;
            }
            $i++;
            file_put_contents(public_path()."/status", $i);

            $in = $this->get_index( $data[7] );
            $ans = $data[ $in ];
            array_splice($data, $in ,1);

            //die(print_r($data));
            $mcq = new MCQ();
            $mcq->subjectid = $data[0];
            $mcq->moduleid = $data[1];
            $mcq->question = $data[2];
            $mcq->answer = $ans;
            $mcq->option1 = $data[3];
            $mcq->option2 = $data[4];
            $mcq->option3 = $data[5];
            $mcq->save();
        }
        fclose($handle);
        }
    }
    /*End - Database Insert */
}
