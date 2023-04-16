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

    public function show($id){
        $student=Student::find($id);
        if($student){
            return response()->json([
                'status'=>200,
                'student'=>$student
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Student not found'
            ],404);
        }
    }

    public function edit($id){
        $student=Student::find($id);
        if($student){
            return response()->json([
                'status'=>200,
                'student'=>$student
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'Student not found'
            ],404);
        }
    }

    public function update(Request $req,int $id){
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
            $student=Student::find($id);
            if ($student){
                $student->update([
                    'name'=>$req->name,
                    'course'=>$req->course,
                    'email'=>$req->email,
                ]);
                return response()->json([
                    'status'=>200,
                    'message'=>'Student updated successfully'
                ],200);

            }
                else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'No such student found'
                    ],404);
                }
    }

    public function destroy($id){
        $student=Student::find($id);
        if ($student){
            $student->delete();
            
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'No such student found'
            ],404);
        }
    }
}
