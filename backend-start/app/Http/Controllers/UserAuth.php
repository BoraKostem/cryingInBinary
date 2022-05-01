<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UserAuth extends Controller
{
    function login(){
        return view('login');
    }

    function register(){
        return view('createuser');
    }

    function goAdmin(){
        return view('createadmin');
    }

    function dashboard(){
        $userInfo = Patient::where('id','=', session('userID'))->first();
        return view('roleMenus.patientMain',compact('userInfo'));
    }

    function userLogin(Request $req){
        $req->validate([
            'bilkentID'=>'required|integer',
            'password'=>'required'
        ],
        [
            'bilkentID.integer' => 'Bilkent ID needs to be an integer!',
            'bilkentID.required' => 'Please enter your Bilkent ID or Staff ID',
            'password.required' => 'Password cannot be blank!',
        ]);

        $loginInfo = Patient::where('bilkentID', '=', $req->bilkentID)->first(); //Database querry to fetch the row with the entered bilkentID
        if (!$loginInfo) {
            return back()->with('fail','Your Bilkent ID or Password is incorrect!');
        } else {
            //Password Check
            if (Hash::check($req->password, $loginInfo->password)) {
                $req->session()->put('userID', $loginInfo->id);
                return redirect('dashboard');
            } else {
                //Password Incorrect
                return back()->with('fail','Your Bilkent ID or Password is incorrect!');
            }
            
        }
        
    }

    function createUser(Request $req){
        $req->validate([
            'bilkentID'=>'required|integer|unique:patients',
            'name'=>'required',
            'email'=>'required|email|unique:patients',
            'phone'=>'required',
            'password'=>'required'
        ],
        [
            'bilkentID.integer' => 'Bilkent ID needs to be an integer!',
            'bilkentID.required' => 'Please enter a Bilkent ID or Staff ID',
            'password.required' => 'Password cannot be blank!',
        ]);

        $user = new Patient;
        $user->bilkentID = $req->bilkentID;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->password = Hash::make($req->password);
        $save = $user->save();

        if($save){
            return back()->with('success','New Patient has been successfuly added to database');
        }
        else{
            return back()->with('fail','Something went wrong please try again later.');
        }
    }

    function createStaff(Request $req){
        $req->validate([
            'staffID'=>'required|integer|unique:staff',
            'name'=>'required',
            'email'=>'required|email|unique:staff',
            'phone'=>'required',
            'job'=>'required',
            'location'=>'required',
            'password'=>'required'
        ],
        [
            'staffID.required' => 'Please enter a Bilkent ID or Staff ID',
            'password.required' => 'Password cannot be blank!',
        ]);

        $user = new Staff;
        $user->staffID = $req->staffID;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->job = $req->job;
        $user->location = $req->location;
        $user->password = Hash::make($req->password);
        $save = $user->save();

        if($save){
            return back()->with('success','New Staff Member  has been successfuly added to database');
        }
        else{
            return back()->with('fail','Something went wrong please try again later.');
        }
    }

    function createAdmin(Request $request){
        
        //Validate requests
        $request->validate([
            'adminID'=>'required|unique:admins',
            'password'=>'required|min:5|max:12'
        ]);

         //Insert data into database
         $admin = new Admin;
         $admin->adminID = $request->adminID;
         $admin->password = Hash::make($request->password);
         $save = $admin->save();

         if($save){
            return back()->with('success','New Admin has been successfuly added to database');
         }else{
             return back()->with('fail','Something went wrong, try again later');
         }
    }

    function logout(){
        if(session()->has('userID')){
            session()->pull('userID');
            return redirect('login');
        }
    }
}
