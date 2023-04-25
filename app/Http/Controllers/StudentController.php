<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Student;
use App\Models\QuizQuestion;
use App\Models\StudentQuiz;
use App\Models\QuizQuestionAttempt;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    
    public function start_quiz()
    {
        //insert data into this table

        //save data and get insert id

        //store this id into session


        $student_id=Session::get('loginId');
        $student=Student::find($student_id);
        $student_course=$student->course_id;

        $store = new StudentQuiz();
        $store->marks = "";
        $store->student_id = $student_id;
        $store->total_attempt = 0;
        $store->save();

        $quiz_id = StudentQuiz::get('id')->last();
        Session::put('quiz_id', $quiz_id);

        // $students =QuizQuestion::where('course_id',$user_course)->get();
        $students =QuizQuestion::where('course_id',$student_course)->limit(1)->get();
        // $students =QuizQuestion::where('course_id',$user_course)->simplePaginate(1);
        return view('status', ['display'=>$students]);

    }

    public function add(Request $request)
    {

        $isCorrect=false;
        $student_id=Session::get('loginId');
        $student=Student::find($student_id);
        $student_course=$student->course_id;

        $demo=Session::get('quiz_id')->id; 
            
        $question_id=$request->input('ques->id');
        $option_id=$request->input('option_id');

        
       
        $store_quiz_question=new QuizQuestionAttempt();
        $store_quiz_question->selected_ans=$option_id;
        $store_quiz_question->isCorrect=$isCorrect;
        $store_quiz_question->question_id=$question_id;
        $store_quiz_question->quiz_id=$demo;
        $store_quiz_question->save();

        // if($question_id !=0)
        // {
        //     $questions= QuizQuestion::where('course_id',$student_course)->whereNotIn('id',function($q)use($demo){
        //         $q->select('question_id')->from('quiz_question_attempts')->where('quiz_id',$demo);
        //         })->limit(1)->get();
        //         return view('status', ['display'=>$questions]);
                
        // }
        // else
        // {
        //     return view('submit');
        //     // return "quiz over";
        // }


        $questions=$this->fetch_question($demo);
  
        if(count($questions)>0)
        {
            return view('status', ['display'=>$questions]);

        }
        else
        {
             return view('submit');
            // return "quiz over";
        }       
                 
     }



     public function fetch_question($demo)
     {

        $student_id=Session::get('loginId');
        $student=Student::find($student_id);
        $student_course=$student->course_id;
        
        $questions= QuizQuestion::where('course_id',$student_course)->whereNotIn('id',function($q)use($demo){
            $q->select('question_id')->from('quiz_question_attempts')->where('quiz_id',$demo);
            })->limit(1)->get();

        return $questions;
     }



     public function isCorrectMethod(){

        $student_id=Session::get('loginId');
        $student=Student::find($student_id);
        $student_course=$student->course_id;

        $demo=Session::get('quiz_id')->id;

        $demo=DB::table('quiz_question_attempts')
        ->join('quiz_questions','quiz_question_attempts.question_id','=','quiz_questions.id')
        ->where('quiz_question_attempts.quiz_id',$demo)
        ->select('quiz_question_attempts.selected_ans','quiz_question_attempts.isCorrect','quiz_questions.answer','quiz_questions.question_name')
        ->get();
        // return $demo;


        return view('crosscheck')->with('value',$demo);
     }

     public function evaluate(Request $request)
     {

          
            $student_id=Session::get('loginId');
            $student=Student::find($student_id);
            $student_course=$student->course_id;

            $demo=Session::get('quiz_id')->id;
            // return $demo;

            $correct = 0;
            $result = 0;
            $incorrect = 0;
            $no_attempt=0;
            $grade = "";

            $response=DB::table('quiz_question_attempts')
                ->join('quiz_questions','quiz_question_attempts.question_id','=','quiz_questions.id')
                ->where('quiz_question_attempts.quiz_id',$demo)
                ->select('quiz_question_attempts.selected_ans','quiz_question_attempts.isCorrect','quiz_questions.answer')
                ->get();
            // return $response;


            foreach ($response as $res) {
                if($res->selected_ans == $res->answer)
                {
                    $correct++;

                }
                elseif ($res->selected_ans == 0) 
                {
                    $no_attempt++;
                }
                else
                {
                    $incorrect++;
                 
                }
            }

            $result  = ($correct * 2);
            if($result >= 4 ){
                $grade = "Pass";

            }
            else
            {
                $grade = "Fail";
            }

        $respo=DB::table('quiz_question_attempts')
                ->join('quiz_questions','quiz_question_attempts.question_id','=','quiz_questions.id')
                ->where('quiz_question_attempts.quiz_id',$demo)
                ->whereRaw('quiz_question_attempts.selected_ans = quiz_questions.answer')
                ->update(['quiz_question_attempts.isCorrect' =>true]);

            $store_quiz = new QuizResult();
            $store_quiz->result = $result;
            $store_quiz->marks = $grade;
            $store_quiz->correct= $correct;
            $store_quiz->Incorrect = $incorrect;
            $store_quiz->No_Attempt = $no_attempt;
            $store_quiz->student_id = Session::get('loginId');
            $store_quiz->save();


            //update the marks and attempt column in StudentQuiz Table
           
            $updt=StudentQuiz::find($demo);
            $updt->marks=$grade;
            $updt->total_attempt=1;
            $updt->save();
            

            $score = [];

            $score['result']= $result;
            $score['marks'] = $grade; 
            $score['correct'] = $correct;
            $score['incorrect'] = $incorrect;
            $score['no_attempt'] = $no_attempt;
            $score['user_id'] = Session::get('loginId');
            $score['time'] = $store_quiz->get('created_at')->last();
            return view("result", ['scores'=>$score]);


     }


    // Fetching the data from a particular user 
    public function showResult(Request $request){

        $student_id=Session::get('loginId');

        $student_name=Student::find($student_id);


        $data = array();
        if(Session::has('loginId')){
            $data = QuizResult::where('student_id','=',Session::get('loginId'))->get();
        }
        // return $data;
        // return $student_name;
        return view("history")->with('data',$data)->with('name',$student_name);
    }


    // Show the leaderboard 
    public function showHistory(){

                
        $ans = QuizResult::all()->sortByDesc('result');

        // return view("StudentsScore", compact('ans'));
        // return $ans;
        $name=QuizResult::with('student')->get();
        return view('studentscore')->with('ans',$ans)->with('ans',$name);
    }

}
