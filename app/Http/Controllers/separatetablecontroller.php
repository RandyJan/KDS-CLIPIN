<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class separatetablecontroller extends Controller
{
public function index(){
    $desc = DB::select('select * from dbo.parts');{

        return view ('stud_view',['desc'=>$desc]);
    }
}

}
