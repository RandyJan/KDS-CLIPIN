<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class productstatuscontroller extends Controller
{
    public function product(){
        $prodstats = DB::select('SELECT * FROM dbo.PartsLocation ORDER BY SHORTCODE ASC');
        return view ('prod_stats', ['prodstats'=>$prodstats]);
       }
}
