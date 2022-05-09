<?php

namespace App\Http\Controllers;

use App\Models\HealthHistory;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Admin;
use App\Models\Staff;
use App\Models\Tests;
use Illuminate\Support\Facades\File;

class PdfUpload extends Controller
{
    function pdfUpload(Request $req)
    {   
        date_default_timezone_set('Turkey');
        if(session('userJob') == 'administrator'){
            $userr = Admin::where('id', '=', session('userID'))->first();
        }

        else{
            $userr = Staff::where('id', '=', session('userID'))->first();
        }


        $req->validate([
            'healthhistory' => 'required|mimes:pdf|max:10000',
        ]);
        $succ = false;
        $file = $req->healthhistory;
        if (isset($file)) {
            $fileName = time() . '.' . $req->healthhistory->extension();
            $path = public_path() . '/users/' . $req->hiddenID;
            if (!File::isDirectory($path)) {
                File::makeDirectory($path);
            }
            $succ = $file->move(public_path("users/$req->hiddenID"), $fileName);
        }
        if ($succ) {
            $user = new HealthHistory;
            $user->bilkentID = $req->hiddenID;
            $user->type = $req->file;
            $user->path = $path;
            $user->name = $fileName;
            $user->uploaderID = $userr->bilkentID;
            $save = $user->save();

            if ($save) {
                return back()->with('success', 'Result auccessfully added to patients Health History');
            } else {
                return back()->with('fail', 'Something went wrong please try again later.');
            }
        } else {
            return back()->with('fail', 'You need to change a value to update.');
        }
    }

    function pdfUploadNurse(Request $req)
    {   
        $userr = Staff::where('id', '=', session('userID'))->first();

        $req->validate([
            'results' => 'required|mimes:pdf|max:10000',
        ]);

        $succ = false;
        $file = $req->results;
        if (isset($file)) {
            $fileName = time() . '.' . $req->results->extension();
            $path = public_path() . '/users/' . $req->hiddenID;
            if (!File::isDirectory($path)) {
                File::makeDirectory($path);
            }
            $succ = $file->move(public_path("users/$req->hiddenID"), $fileName);
        }

        Tests::where('id','=', $req->testID)->delete();

        if ($succ) {
            $user = new HealthHistory;
            $user->bilkentID = $req->hiddenID;
            $user->type = $req->file;
            $user->path = $path;
            $user->name = $fileName;
            $user->uploaderID = $userr->bilkentID;
            $save = $user->save();

            if ($save) {
                return back()->with('success', 'Result auccessfully added to patients Health History');
            } else {
                return back()->with('fail', 'Something went wrong please try again later.');
            }
        } else {
            return back()->with('fail', 'Something went wrong please try again later.');
        }
    }
}
