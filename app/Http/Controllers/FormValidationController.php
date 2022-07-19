<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormValidationController extends Controller
{
    public function index(){
        //return redirect('formvalidation');
    }
    public function create(){
        return view('formvalidation');
    }
}
