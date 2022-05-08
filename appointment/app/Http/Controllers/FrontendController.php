<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Time;
use App\Models\User;
use App\Models\Booking;
class FrontendController extends Controller
{
    public function index(){
        date_default_timezone_set('Turkey');
        if(request('date')){        //if there is input
            $doctors = $this->findDoctorsBasedOnDate(request('date'));
            return view('welcome',compact('doctors'));
        }
        $doctors = Appointment::where('date',date('Y-m-d'))->get();
        //return $doctors;
    	return view('welcome',compact('doctors'));
    }

    public function show($doctorId,$date){
        
        $appointment = Appointment::where('user_id',$doctorId)->where('date',$date)->first();
        $times = Time::where('appointment_id',$appointment->id)->where('status',"created")->get();
        
        $user = User::where('id',$doctorId)->first();
        $doctor_id = $doctorId;

        
    	
        return view('appointment',compact('times','date','user','doctor_id'));
    }

    public function findDoctorsBasedOnDate($date){

        $doctors = Appointment::where('date',$date)->get();         //date coming from filter
        return $doctors;
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Turkey');
        $request->validate(['time'=>'required']);
        $check=$this->checkBookingTimeInterval();
        if($check){
            return redirect()->back()->with('errmessage','You have already booked an appointment.(An appointment can be made every 24 hours.)');
        }
        //store database
        Booking::create([
            'user_id'=> auth()->user()->id,
            'doctor_id'=> $request->doctorId,
            'time'=> $request->time,
            'date'=> $request->date,
            'status'=>"created"
        ]);
        Time::where('appointment_id',$request->appointmentId)
            ->where('time',$request->time)
            ->update(['status'=>"booked"]);
        return redirect()->back()->with('message','Successfully booked');
    }
    public function checkBookingTimeInterval()
    {
        //to check latest booking desc order is needed to book once in 24h
        //if book is exists same date return true
        return Booking::orderby('id','desc')
            ->where('user_id',auth()->user()->id)
            ->whereDate('created_at',date('Y-m-d'))
            ->exists();
    }

    public function myBookings()
    {
        $appointments = Booking::latest()->where('user_id',auth()->user()->id)->get();
        return view('booking.index',compact('appointments'));
    }
}
