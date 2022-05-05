<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\File;

class PdfUpload extends Controller
{
    function pdfUpload(Request $req)
    {
        $userr = Patient::where('id','=', session('userID'))->first();
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
            return back()->with('success', 'PDF uploaded successfully');
        } else {
            return back()->with('fail', 'You need to change a value to update.');
        }
    }
}
