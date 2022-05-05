<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PdfUpload extends Controller
{
    public function pdfUpload(Request $request)
    {
        // $fileName = uniqid('',true).".".$request->file->getClientOriginalExtension();
        // $upload = $request->file->move(public_path('images'), $fileName);
        $file = $request->file('file');
        $fileSize = $file->getSize();
        $fileError = $file->getError();
        $fileExt = $file->getClientOriginalExtension();
        $fileActualExt = strtolower($fileExt);
        $allowed = array('pdf');

        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 1000000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
    
                    $upload = $file->move(public_path('PdfFiles'), $fileNameNew);
                    header("Location: index.php?uploadsuccess");
                }else{
                    echo "Your file is too big!";
                }
            }else{
                echo "There was an error uploading your file!";
            }
        }else{
            echo "You cannot upload files of this type!";
        }

        $userInfo = Patient::where('id','=', session('userID'))->first();
        return view('pdfupload.upload', compact('userInfo'));
    }
}
