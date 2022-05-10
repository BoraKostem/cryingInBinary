<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Time;
use App\Models\Staff;
class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userInfo = Staff::where('id','=', session('userID'))->first();
        $appointments = Appointment::where('user_id',session('userID'))->orderBy('date', 'asc')->get();
        
        return view('admin.appointment.index',compact('appointments','userInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userInfo = Staff::where('id','=', session('userID'))->first();
        return view('admin.appointment.create',compact('userInfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
         //to test dd($request->all());   
         $this->validate($request,[
            'date'=>'required|unique:appointments,date,NULL,id,user_id,'.session('userID'), //to prevent same day appointment
            'time'=>'required'
        ]);
         $appointment = Appointment::create([
             'user_id' => session('userID'),
             'date' => $request->date
         ]);
         // to take one by one
         foreach($request->time as $time){
             Time::create([
                 'appointment_id'=> $appointment->id,
                 'time' => $time,
                 //'status' => "created"
             ]);
             
         }
  
         return redirect()->back()->with('message','Shift created successfully for'.
         $request->date);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function check(Request $request)
    {
        $date=$request->date;
        $appointment=Appointment::where('date',$date)->where('user_id',session('userID'))->first(); //get the first item
        $userInfo = Staff::where('id','=', session('userID'))->first();
        if(!$appointment){   
            return redirect()->to('/appointment')->with('errmessage','Appointment time not created for this date');
        }
        $appointmentID=$appointment->id;
        $times=Time::where('appointment_id',$appointmentID)->get();
        //return $times;
        return view('admin.appointment.index',compact('times','appointmentID','date','userInfo')); //compact creates an array from existing variables given as string arguments to it.
    }

    public function updateTime(Request $request)
    {
        //$userInfo = Staff::where('id','=', session('userID'))->first();
        $appointmentID=$request->appointmentID;
        $appointment= Time::where('appointment_id',$appointmentID)->delete();
        foreach($request->time as $time){
            Time::create([
                'appointment_id'=>$appointmentID,
                'time'=>$time,
                'status'=>"created"
            ]);
        }
        return redirect()->route('appointment.index')->with('message','Appointment updated!');
    }
    

}
