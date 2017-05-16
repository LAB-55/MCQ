<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MCQ;
use PDF;
use Redirect;
use Hash;
  ini_set('max_execution_time', -1);
class MCQController extends Controller
{
    public function index() {
    	return view('mcqform');
    }

    public function create(Request $request)
    {
    	$mcq_no = $request->mcq_no;
    	$type = $request->type;

    	$que = MCQ::Select("*")->limit($mcq_no)->inRandomOrder()->get();
        //return view('mcq', ['que' => $que], ['type' => $type]);
        $name = sha1( time()).rand(10000,99999).".pdf";
        // echo "<pre>";
        // print_r($name);
        // exit();

    	view()->share('que', $que);
    	view()->share('type', $type);
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
