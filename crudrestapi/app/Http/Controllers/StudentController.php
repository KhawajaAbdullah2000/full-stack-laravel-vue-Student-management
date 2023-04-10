<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
        #fetch all data
        $students=Student::all();
        if ($students->count()>0){
            return response()->json([
                'status'=>200,
                'students'=>$students
             ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'No record found'
             ],404);
        }
      

    }

    public function store(Request $req){
    $validator=Validator::make($req->all(),
    [
       'name'=>'required|string|max:20',
       'course'=>'required|string|max:20',
       'email'=>'required|email|unique:students|max:30',
    ]);
        if ($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }

        $student=Student::create([
            'name'=>$req->name,
            'course'=>$req->course,
            'email'=>$req->email,
        ]);
        if ($student){
            return response()->json([
                'status'=>200,
                'message'=>'Student created successfully'
            ],200);
        }
            else{
                return response()->json([
                    'status'=>500,
                    'message'=>'Something wrong occured'
                ],500);
            }

    }
}
