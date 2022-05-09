<?php

namespace App\Http\Controllers;
use App\Models\Time;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\Tests;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Appointment;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAuth extends Controller
{
    function no404(){
        if(session('userID') !== null){
            return redirect(route('home'));
        }
        else{
            return redirect('/login');
        }
        
    }

    function login(){
        return view('login');
    }

    function register(){
        if(session('userJob') == 'administrator'){
            $userInfo = Admin::where('id','=', session('userID'))->first();
            return view('createuser',compact('userInfo'));
        }
        else{
            return redirect(route('home'));
        }
    }

    function registerStaff(){
        if(session('userJob') == 'administrator'){
            $userInfo = Admin::where('id','=', session('userID'))->first();
            return view('createstaff',compact('userInfo'));
        }
        else{
            return redirect(route('home'));
        }
    }

    function goAdmin(){
        if(session('userJob') == 'administrator'){
            $userInfo = Admin::where('id','=', session('userID'))->first();
            return view('adminpasschange',compact('userInfo'));
        }
        else{
            return redirect(route('home'));
        }
    }

    function manageUser(){
        if(session('userJob') == 'administrator'){
            $userInfo = Admin::where('id','=', session('userID'))->first();
            $patients = Patient::all();
            $staffList = Staff::all();
            return view('manageuser',compact('userInfo', 'patients', 'staffList'));
        }
        else{
            return redirect(route('home'));
        }
        
    }

    function dashboard(){
        if(session('userJob') == 'administrator'){
            $userInfo = Admin::where('id','=', session('userID'))->first();
            return view('roleMenus.admin',compact('userInfo'));
        }
        if(session('userJob') == 'bilkenter'){
            $userInfo = Patient::where('id','=', session('userID'))->first();
            $appointments = Booking::latest()->where('user_id','=',session('userID'))->get();
            
            if(request('date')){        //if there is input
            $doctors = $this->findDoctorsBasedOnDate(request('date'));
            return view('roleMenus.patientMain',compact('userInfo','appointments','doctors'));
            }
            $doctors = Appointment::orderBy('date','ASC')->get();
            
            return view('roleMenus.patientMain',compact('userInfo','appointments','doctors'));
        }
        
        if(session('userJob') == 'doctor'){
            $userInfo = Staff::where('id','=', session('userID'))->first();
            return view('roleMenus.doctor',compact('userInfo'));
        }
        if(session('userJob') == 'nurse'){
            $testList = Tests::all();
            $userInfo = Staff::where('id','=', session('userID'))->first();
            return view('roleMenus.nurse',compact('userInfo','testList'));
        }
        if(session('userJob') == 'secretary'){
            $userInfo = Staff::where('id','=', session('userID'))->first();
            return view('roleMenus.secretary',compact('userInfo'));
        }
    }

    function profilePage(){
        
        if(session('userJob') == 'bilkenter'){
            $userInfo = Patient::where('id','=', session('userID'))->first();
            return view('utilityPages.profilePage',compact('userInfo'));
        }
        if(session('userJob') == 'doctor'){
            $userInfo = Staff::where('id','=', session('userID'))->first();
            return view('utilityPages.profilePage',compact('userInfo'));
        }
        if(session('userJob') == 'nurse'){
            $userInfo = Staff::where('id','=', session('userID'))->first();
            return view('utilityPages.profilePage',compact('userInfo'));
        }
        if(session('userJob') == 'secretary'){
            $userInfo = Staff::where('id','=', session('userID'))->first();
            return view('utilityPages.profilePage',compact('userInfo'));
        }

        if(session('userJob') == 'administrator'){
            return redirect(route('home'));
        }
    }

    function profileEdit(){
        
        if(session('userJob') == 'bilkenter'){
            $userInfo = Patient::where('id','=', session('userID'))->first();
            return view('utilityPages.editProfile',compact('userInfo'));
        }
        if(session('userJob') == 'doctor'){
            $userInfo = Staff::where('id','=', session('userID'))->first();
            return view('utilityPages.editProfile',compact('userInfo'));
        }
        if(session('userJob') == 'nurse'){
            $userInfo = Staff::where('id','=', session('userID'))->first();
            return view('utilityPages.editProfile',compact('userInfo'));
        }
        if(session('userJob') == 'secretary'){
            $userInfo = Staff::where('id','=', session('userID'))->first();
            return view('utilityPages.editProfile',compact('userInfo'));
        }

        if(session('userJob') == 'administrator'){
            return redirect(route('home'));
        }
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

        $loginInfo = Patient::where('bilkentID', '=', $req->bilkentID)->first(); //Database querry to fetch the row with the entered bilkentID for patients table
        if (!$loginInfo) {
            $loginInfo = Staff::where('bilkentID', '=', $req->bilkentID)->first(); //Database querry to fetch the row with the entered bilkentID for staff table
            if (!$loginInfo) {
                $loginInfo = Admin::where('bilkentID', '=', $req->bilkentID)->first(); //Database querry to fetch the row with the entered bilkentID for admin table
                if (!$loginInfo) {
                    return back()->with('fail','Your Bilkent ID or Password is incorrect!');
                } else {
                    //Password Check
                    if (Hash::check($req->password, $loginInfo->password)) {
                        $req->session()->put('userID', $loginInfo->id);
                        $req->session()->put('userJob',$loginInfo->job);

                        if(Hash::check('true', $loginInfo->firstLogin)){
                            return redirect(route('auth.admin'))->with('fail','You need to change your default password!');;
                        }
                        else{
                            return redirect('dashboard');
                        }
                    } else {
                        //Password Incorrect
                        return back()->with('fail','Your Bilkent ID or Password is incorrect!');
                    } 
                }
            } else {
                //Password Check
                if (Hash::check($req->password, $loginInfo->password)) {
                    $req->session()->put('userID', $loginInfo->id);
                    $req->session()->put('userJob',$loginInfo->job);
                    return redirect('dashboard');
                } else {
                    //Password Incorrect
                    return back()->with('fail','Your Bilkent ID or Password is incorrect!');
                } 
            }
        } else {
            //Password Check
            if (Hash::check($req->password, $loginInfo->password)) {
                $req->session()->put('userID', $loginInfo->id);
                $req->session()->put('userJob',$loginInfo->job);
                return redirect('dashboard');
            } else {
                //Password Incorrect
                return back()->with('fail','Your Bilkent ID or Password is incorrect!');
            } 
        }
        
    }

    function createUser(Request $req){
        $req->validate([
            'bilkentID'=>'required|integer|unique:patients|unique:staff|unique:admins',
            'name'=>'required',
            'email'=>'required|email|unique:patients',
            'date'=>'required|date_format:m/d/Y',
            'gender'=>'required|in:Male,Female',
            'phone'=>'required',
            'password'=>'required'
        ],
        [
            'bilkentID.integer' => 'Bilkent ID needs to be an integer!',
            'bilkentID.required' => 'Please enter a Bilkent ID of the patient',
            'date.required'=>'Please enter the birthday of the patient',
            'date.date_format'=>'Date format needs to be mm/dd/yy!',
            'password.required' => 'Password cannot be blank!',
        ]);

        $user = new Patient;
        $user->bilkentID = $req->bilkentID;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->gender = $req->gender;
        $user->password = Hash::make($req->password);
        $user->birthday = Carbon::parse($req->date)->format('Y-m-d');
        $user->job = 'bilkenter';
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
            'bilkentID'=>'required|integer|unique:patients|unique:staff|unique:admins',
            'name'=>'required',
            'email'=>'required|email|unique:staff',
            'phone'=>'required',
            'job'=>'required|in:doctor,nurse,secretary',
            'location'=>'required|in:main,east',
            'password'=>'required'
        ],
        [
            'bilkentID.integer' => 'Bilkent ID needs to be an integer!',
            'bilkentID.required' => 'Please enter a Bilkent ID of the staff',
            'password.required' => 'Password cannot be blank!',
        ]);

        $user = new Staff;
        $user->bilkentID = $req->bilkentID;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->job = $req->job;
        $user->location = $req->location;
        $user->speciality = $req->speciality;
        $user->title = $req->title;
        $user->password = Hash::make($req->password);
        $save = $user->save();

        if($save){
            return back()->with('success','New Staff Member  has been successfuly added to database');
        }
        else{
            return back()->with('fail','Something went wrong please try again later.');
        }
    }

    function changeAdminPass(Request $request){
        //Validate requests
        $request->validate([
            'oldpassword'=>'required',
            'newpassword'=>'required|min:5|max:12'
        ]);

         //Insert data into database
         $admin = Admin::where('id','=', session('userID'))->first();
         $adminEdit = Admin::where('id','=', session('userID'));
         if(Hash::check($request->oldpassword, $admin->password)){
            if(!Hash::check($request->newpassword, $admin->password)){
                $adminEdit->update(['password'=>Hash::make($request->newpassword)]);
                $adminEdit->update(['firstLogin'=>Hash::make('false')]);
                return back()->with('success','Your password changed successfully');
            }
            else{
                return back()->with('fail','Your old password cannot be same with the new password');
            }
         }
         else{
            return back()->with('fail','Your current password is incorrect');
         }
         
    }

    function logout(){
        if(session()->has('userID')){
            session()->pull('userID');
            return redirect('login');
        }
    }

    //Manage User Post Request Handlers
    function deletePatient(Request $req){
        Patient::where('bilkentID','=', $req->bilkentID)->delete();
        return back();
    }

    function deleteStaff(Request $req){
        Staff::where('bilkentID','=', $req->bilkentID)->delete();
        return back();
    }
    public function findDoctorsBasedOnDate($date){

        $doctors = Appointment::where('date','=',$date)->get();         //date coming from filter
        return $doctors;
    }
}
