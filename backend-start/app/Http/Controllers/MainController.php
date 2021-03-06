<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Staff;
use Carbon\Carbon;
use App\Models\Tests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MainController extends Controller{
    
    function changeNews(Request $req){
        date_default_timezone_set('Turkey');
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

    function editProfile(Request $req){
        $userr = Patient::where('id','=', session('userID'))->first();
        $req->validate([
            'email'=>'required|email|unique:patients,email,'.$userr->id,
            'height'=>'required|numeric',
            'blood_type'=>'required',
            'weight'=>'required|integer',
            'hescode'=>'required',
            'phone'=>'required|required',
            'profilephoto'=>'image|max:10000',
        ]);
        $succ = false;
        $user = Patient::where('id','=', session('userID'));    
        if($req->email != $userr->email){
            $succ = $user->update(['email' => $req->email]);
        }
        if($req->phone != $userr->phone){
            $succ = $user->update(['phone' => $req->phone]);
        }
        if($req->height != $userr->height){
            $succ = $user->update(['height' => $req->height]);
        }
        if($req->weight != $userr->weight){
            $succ = $user->update(['weight' => $req->weight]);
        }
        if($req->hescode != $userr->hescode){
            $succ = $user->update(['hescode' => $req->hescode]);
        }
        if($req->blood_type != $userr->blood_type){
            $succ = $user->update(['blood_type' => $req->blood_type]);
        }
        
        $file = $req->profilephoto;
        if(isset($file)){ 
            if(isset($userr->pp_path)){
                File::delete(public_path("users/$userr->bilkentID/$userr->pp_path"));
            }
            $fileName = time().'.'.$req->profilephoto->extension();
            $file->move(public_path("users/$userr->bilkentID"), $fileName);
            $succ = $user->update(['pp_path' => $fileName]);
        }
        if($succ){
            return back()->with('success','Profile editted successfully');
        }
        else{
            return back()->with('fail','You need to change a value to update.');
        }
    }


    function editProfileStaff(Request $req){
        date_default_timezone_set('Turkey');
        $userr = Staff::where('id','=', session('userID'))->first();
        $req->validate([
            'email'=>'required|email|unique:patients,email,'.$userr->id,
            'hescode'=>'required',
            'phone'=>'required|required',
            'profilephoto'=>'image|max:10000',
        ]);
        $succ = false;
        $user = Staff::where('id','=', session('userID'));    
        if($req->email != $userr->email){
            $succ = $user->update(['email' => $req->email]);
        }
        if($req->phone != $userr->phone){
            $succ = $user->update(['phone' => $req->phone]);
        }
        if($req->hescode != $userr->hescode){
            $succ = $user->update(['hescode' => $req->hescode]);
        }
        
        $file = $req->profilephoto;
        if(isset($file)){ 
            if(isset($userr->pp_path)){
                File::delete(public_path("users/$userr->bilkentID/$userr->pp_path"));
            }
            $fileName = time().'.'.$req->profilephoto->extension();
            $file->move(public_path("users/$userr->bilkentID"), $fileName);
            $succ = $user->update(['pp_path' => $fileName]);
        }
        if($succ){
            return back()->with('success','Profile editted successfully');
        }
        else{
            return back()->with('fail','You need to change a value to update.');
        }
    }

    function addTest(Request $req){
        $req->validate([
            'doctorID'=>'required|exists:staff,bilkentID',
            'patientID'=>'required|exists:patients,bilkentID',
            'requestedTest'=>'required',
        ],
        [
            'patientID.required' => 'Please enter petients name.',
        ]);

        $test = new Tests;

        $test->doctorID = $req->doctorID;
        $test->patientID = $req->patientID;
        $test->requestedTest = $req->requestedTest;

        $save = $test->save();
        
        if($save){
            return back()->with('success','New Test Request Added Successfully');
        }
        else{
            return back()->with('fail','Something went wrong please try again later.');
        }
    }


}