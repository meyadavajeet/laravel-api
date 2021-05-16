<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DummyApi extends Controller
{
    //write your code here

    public function getDummyApi()
    {
        // echo((DB::connection())?"database connected":"uable to coonect to db");
        if (DB::connection()->getDatabaseName()) {
            // echo "Connected sucessfully to database " . DB::connection()->getDatabaseName() . ".";
            Log::error("Connected successfully".DB::connection()->getDatabaseName());
        }    

        
        return ["name" => "kajal", "title" => "Yadav", "degree" => "matriculation"];
    }

    public function checkDbConnection()
    {
        if(DB::connection()->getDatabaseName()){
          echo "Connected sucessfully to database " . DB::connection()->getDatabaseName() . ".";  
        }
    }


}
