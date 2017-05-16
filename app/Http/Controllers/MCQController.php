<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MCQ;
use PDF;
use Redirect;
use Hash;

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
        
        die($name);
        //$pdf = PDF::loadView('mcq');
        //return $pdf->download($name); 
    }
}
