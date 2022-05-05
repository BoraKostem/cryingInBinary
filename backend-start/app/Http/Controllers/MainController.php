<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller{
    
    function changeNews(Request $req){
        $req->validate([
            'messageText'=>'required'
        ],
        [
            'messageText.required' => 'Please enter a message to post the news.',
        ]);
        $newValue = $req->messageText;
        $current = Carbon::now();
        DB::table('data')->where('dataType', 'healthNews')->update(['value'=>$newValue, 'lastEdited'=>$current->format('F jS \- Y')]);

        return back()->with('success','Health Center News Changed');
    }
}
