<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\View;

class usercontroller extends Controller
{
    public function index(): View
    {
        $mytable = DB::table('dbo.OrderSLipDetails')->get();

        return view('main', ['dbo.OrderSLipDetails' => $mytable]);

        echo $mytable;
}

}
