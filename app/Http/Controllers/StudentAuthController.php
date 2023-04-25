<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentAuthController extends Controller
{
    //
    public function login(){
        return view("student.login");
    }
    public function registration(){

        $course=Course::get();
        return view("student.registration")->with('courses',$course) ;
        
    }



    public function registerUser(Request $request){

        // return $request;
       
        $validated=$request->validate([
            'name'=>'required',
            'email'=>'required |email|unique:students',
            'password'=>'required|min:4|max:12',
            'confirm-password'=>'required|same password',
            'contact'=>'required | max:10',
            
            
        ]);

        $student=new Student();
        $student->name=$request->name;
        $student->email=$request->email;
        $student->password=Hash::make($request->password);
        $student->contact=$request->contact;
        $student->course_id=$request->course;
        $res=$student->save();
        return redirect('login');
        if($res)
        {
            return back()->with('success','you have registered successfully !');
        }
        else
        {
            return back()->with('fail','Something Want wrong ?');
        }
  
    }

    public function loginUser(Request $request)
    {
       $validated=$request->validate([
        
        'email'=>'required |email',
        'password'=>'required|min:4|max:12',

       ]);

       $student = Student::where('email','=',$request->email)->first();
       
       if($student)
        {
            if(Hash::check($request->password,$student->password)){
                $request->session()->put('loginId',$student->id);
                return redirect('dashboard');
            }
            else
            {
                return back()->with('fail','Password Not Matched ');
            }
        }
        else
        {
            return back()->with('fail','This email is not registered ?');
        }
    }




    public function dashboard()
    {
        //return Session()->forget('loginId');


        $user_id=Session::get('loginId');
        $student=Student::find($user_id);
        $user_course=$student->course_id;
        $course_name = Course::find($user_course);

        $data = array();

        if(Session::has('loginId')){

            $data = Student::where('id','=',Session::get('loginId'))->first();
        
            
        }
        
        return view('dashboard')->with('data',$data)->with('course',$course_name);

    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
