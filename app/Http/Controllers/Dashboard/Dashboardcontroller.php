<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Dashboardcontroller extends Controller
{
    public function index(){

        return view('dashboard.index');

    }//end of Index

}// end of Controller
