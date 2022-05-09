<?php
namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::get();
        return view('admin.doctor.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this-> validateStore($request);

        $data = $request->all(); //requestteki bütün datayı alıyor
        
        $image = $request->file('image');
        $imageName = $image->hashName();
        $destination = public_path('/images');
        $image->move($destination,$imageName);   //destinationa imageı store et

        $data['image'] = $imageName;
        $data['password']= bcrypt($request->password);

        User::create($data);

        return redirect()->back()->with('message','Doctor added succesfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //1
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //1/edit
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
    public function validateStore($request){
        return  $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:6|max:25',
            'gender'=>'required',
            'education'=>'required',
            'address'=>'required',
            'phone_number'=>'required|numeric',
            'image'=>'mimes:jpeg,jpg,png',
            'role_id'=>'required',
            'description'=>'required',
        ]);
    }
}
