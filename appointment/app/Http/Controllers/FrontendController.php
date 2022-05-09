<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Time;
use App\Models\Staff;
use App\Models\Booking;
use App\Models\Patient;
use Carbon\Carbon;

class FrontendController extends Controller
{

    public function show($doctorId,$date){
        
        $appointment = Appointment::where('user_id',$doctorId)->where('date',$date)->first();
        $times = Time::where('appointment_id',$appointment->id)->where('status',"created")->get();
        $userInfo = Patient::where('id','=', session('userID'))->first();
        $user = Staff::where('id',$doctorId)->first();
        $doctor_id = $doctorId;

        
    	
        return view('appointment',compact('times','date','user','doctor_id','userInfo'));
    }

    public function findDoctorsBasedOnDate($date){

        $doctors = Appointment::where('date',$date)->get();         //date coming from filter
        return $doctors;
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Turkey');
        $request->validate(['time'=>'required']);
        //$check=$this->checkBookingTimeInterval();
        //if($check){
        //    return back()->with('errmessage','You have already booked an appointment.(An appointment can be made every 24 hours.)');
        //}
        //store database
        Booking::create([
            'user_id'=> session('userID'),
            'doctor_id'=> $request->doctorId,
            'time'=> $request->time,
            'date'=> $request->date,
            'status'=>"created"
        ]);
        Time::where('appointment_id',$request->appointmentId)
            ->where('time',$request->time)
            ->update(['status'=>"booked"]);
        return back()->with('message','Successfully booked');
    }
    public function checkBookingTimeInterval()
    {
        //to check latest booking desc order is needed to book once in 24h
        //if book is exists same date return true
        return Booking::orderby('id','desc')
            ->where('user_id',session('userID'))
            ->whereDate('created_at',date('Y-m-d'))
            ->exists();
    }

    public function myBookings()
    {
        
        $userInfo = Patient::where('id','=', session('userID'))->first();
        $appointments = Booking::latest()->where('user_id','=',session('userID'))->get();
        if(session('userJob') == 'doctor'){
            $userInfo = Staff::where('id','=', session('userID'))->first();
            $date = Carbon::today()->toDateString();
            
            $appointments=Booking::where([['doctor_id','=',session('userID')],['date','=',$date]])->orderByRaw('CONVERT(time, DOUBLE) asc')->get();
            
        }
        
        return view('booking.index',compact('appointments','userInfo'));
    }
    public function acceptPatient(Request $request)
    {
       
        $appointmentId=Booking::where('id', '=', $request->appId);
        $appointmentId->update(['status'=>'Visited']);

        return redirect(route('my.booking'));
    }
}
