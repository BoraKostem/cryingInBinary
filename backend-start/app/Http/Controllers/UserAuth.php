<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Staff;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UserAuth extends Controller
{
    function login()
    {
        return view('login');
    }

    function register()
    {
        return view('createuser');
    }

    function goAdmin()
    {
        return view('createadmin');
    }

    function upload(Request $req)
    {
        $userInfo = Patient::where('id', '=', session('userID'))->first();
        $healths = Patient::all();
        return view('pdfupload.upload', compact('userInfo', 'healths'));
    }

    function search(Request $req)
    {
        $userInfo = Patient::where('id', '=', session('userID'))->first();
        $search_text = $req->searchInput;
        $searchByID = Patient::where('bilkentID', 'LIKE', '%' . $search_text . '%')->get();
        $searchByName = Patient::where('name', 'LIKE', '%' . $search_text . '%')->get();
        if (sizeof($searchByID) > 0) {
            $healths = $searchByID;
        } else if (sizeof($searchByName) > 0) {
            $healths = $searchByName;
        } else {
            $healths = Patient::all();
        }

        return view('pdfupload.upload', compact('userInfo', 'healths'));
    }

    function dashboard()
    {
        if (session('userJob') == 'administrator') {
            $userInfo = Admin::where('id', '=', session('userID'))->first();
            return view('roleMenus.admin', compact('userInfo'));
        }
        if (session('userJob') == 'bilkenter') {
            $userInfo = Patient::where('id', '=', session('userID'))->first();
            return view('roleMenus.patientMain', compact('userInfo'));
        }
        if (session('userJob') == 'doctor') {
            $userInfo = Staff::where('id', '=', session('userID'))->first();
            return view('roleMenus.doctor', compact('userInfo'));
        }
        if (session('userJob') == 'nurse') {
            $userInfo = Staff::where('id', '=', session('userID'))->first();
            return view('roleMenus.nurse', compact('userInfo'));
        }
        if (session('userJob') == 'secretary') {
            $userInfo = Staff::where('id', '=', session('userID'))->first();
            return view('roleMenus.secretary', compact('userInfo'));
        }
    }

    function userLogin(Request $req)
    {
        $req->validate(
            [
                'bilkentID' => 'required|integer',
                'password' => 'required'
            ],
            [
                'bilkentID.integer' => 'Bilkent ID needs to be an integer!',
                'bilkentID.required' => 'Please enter your Bilkent ID or Staff ID',
                'password.required' => 'Password cannot be blank!',
            ]
        );

        $loginInfo = Patient::where('bilkentID', '=', $req->bilkentID)->first(); //Database querry to fetch the row with the entered bilkentID for patients table
        if (!$loginInfo) {
            $loginInfo = Staff::where('bilkentID', '=', $req->bilkentID)->first(); //Database querry to fetch the row with the entered bilkentID for staff table
            if (!$loginInfo) {
                $loginInfo = Admin::where('bilkentID', '=', $req->bilkentID)->first(); //Database querry to fetch the row with the entered bilkentID for admin table
                if (!$loginInfo) {
                    return back()->with('fail', 'Your Bilkent ID or Password is incorrect!');
                } else {
                    //Password Check
                    if (Hash::check($req->password, $loginInfo->password)) {
                        $req->session()->put('userID', $loginInfo->id);
                        $req->session()->put('userJob', $loginInfo->job);
                        return redirect('dashboard');
                    } else {
                        //Password Incorrect
                        return back()->with('fail', 'Your Bilkent ID or Password is incorrect!');
                    }
                }
            } else {
                //Password Check
                if (Hash::check($req->password, $loginInfo->password)) {
                    $req->session()->put('userID', $loginInfo->id);
                    $req->session()->put('userJob', $loginInfo->job);
                    return redirect('dashboard');
                } else {
                    //Password Incorrect
                    return back()->with('fail', 'Your Bilkent ID or Password is incorrect!');
                }
            }
        } else {
            //Password Check
            if (Hash::check($req->password, $loginInfo->password)) {
                $req->session()->put('userID', $loginInfo->id);
                $req->session()->put('userJob', $loginInfo->job);
                return redirect('dashboard');
            } else {
                //Password Incorrect
                return back()->with('fail', 'Your Bilkent ID or Password is incorrect!');
            }
        }
    }

    function createUser(Request $req)
    {
        $req->validate(
            [
                'bilkentID' => 'required|integer|unique:patients|unique:staff|unique:admins',
                'name' => 'required',
                'email' => 'required|email|unique:patients',
                'phone' => 'required',
                'password' => 'required'
            ],
            [
                'bilkentID.integer' => 'Bilkent ID needs to be an integer!',
                'bilkentID.required' => 'Please enter a Bilkent ID or Staff ID',
                'password.required' => 'Password cannot be blank!',
            ]
        );

        $user = new Patient;
        $user->bilkentID = $req->bilkentID;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->password = Hash::make($req->password);
        $user->job = 'bilkenter';
        $save = $user->save();

        if ($save) {
            return back()->with('success', 'New Patient has been successfuly added to database');
        } else {
            return back()->with('fail', 'Something went wrong please try again later.');
        }
    }

    function createStaff(Request $req)
    {
        $req->validate(
            [
                'bilkentID' => 'required|integer|unique:patients|unique:staff|unique:admins',
                'name' => 'required',
                'email' => 'required|email|unique:staff',
                'phone' => 'required',
                'job' => 'required',
                'location' => 'required',
                'password' => 'required'
            ],
            [
                'bilkentID.required' => 'Please enter a Bilkent ID or Staff ID',
                'password.required' => 'Password cannot be blank!',
            ]
        );

        $user = new Staff;
        $user->bilkentID = $req->bilkentID;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->job = $req->job;
        $user->location = $req->location;
        $user->password = Hash::make($req->password);
        $save = $user->save();

        if ($save) {
            return back()->with('success', 'New Staff Member  has been successfuly added to database');
        } else {
            return back()->with('fail', 'Something went wrong please try again later.');
        }
    }

    function createAdmin(Request $request)
    {

        //Validate requests
        $request->validate([
            'bilkentID' => 'required|unique:patients|unique:staff|unique:admins',
            'password' => 'required|min:5|max:12'
        ]);

        //Insert data into database
        $admin = new Admin;
        $admin->bilkentID = $request->bilkentID;
        $admin->password = Hash::make($request->password);
        $admin->job = 'administrator';
        $save = $admin->save();

        if ($save) {
            return back()->with('success', 'New Admin has been successfuly added to database');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }

    function logout()
    {
        if (session()->has('userID')) {
            session()->pull('userID');
            return redirect('login');
        }
    }
}
