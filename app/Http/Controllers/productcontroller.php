<?php
namespace App\Http\Controllers;

use App\Http\Resources\GroupCollection;
use App\Http\Resources\PartLocationCollection;
    use App\Models\Group;
use App\Models\PartLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productcontroller extends Controller
{
    public function sample()
    {
        try {
            $dbconnect = DB::connection()->getPDO();
            $dbname = DB::connection()->getDatabaseName();
            echo "Connected successfully to the database. Database name is :".$dbname;
         } catch(Exception $e) {
            echo "Error in connecting to the database";
         }
    }
    
}
