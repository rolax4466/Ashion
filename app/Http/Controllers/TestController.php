<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testConnection()
    {
        try {
            DB::connection()->getPdo();
            return 'Database connection is successful!';
        } catch (\Exception $e) {
            return 'Could not connect to the database. Please check your configuration. Error: ' . $e->getMessage();
        }
    }
}