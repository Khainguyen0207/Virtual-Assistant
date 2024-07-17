<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messageController()  {
        $file = fopen("open.txt", "a");
            fwrite($file , "Dô get\n");
            fclose($file);
        return view('welcome');
    }
    
    public function store(Request $request) {
        $file = fopen("open.txt", "a");
        fwrite($file , "$request\n");
        fclose($file);
    }
}
