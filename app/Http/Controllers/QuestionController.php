<?php

namespace App\Http\Controllers;
use App\Models\lesson;
use App\Models\question;
use App\Models\qoption;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorequestionRequest;
use App\Http\Requests\UpdatequestionRequest;
use Illuminate\Http\Request;
use Validator;
use App\Helpers\ValidationHelper;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $question = question::all();
        return response()->json(['status'=>true,'questions' => $question], 200);
    }

    public function lesson_questions($lesson_id, $chapter_id)
    {
        $lesson = lesson::find($lesson_id);
        $question = $lesson->questions;
        return response()->json(['status'=>true,'questions' => $question], 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'type' => 'required', 
        ]);
        if ($validator->fails()) {
             $errors = ValidationHelper::getValidationErrors($validator->errors());
            return response()->json(
                [
                    'status' => false,
                    'errors' => $errors
                ], 200);
        }
        
         $qustion = question::create([
             'title' => $request->title,
             "content" => $request->content,
         ]);
         

         $qustion->lesson()->attach($request->lesson_id);
         $qustion->qtype()->attach($request->type);

        if(isset($request['mcqs'])){
            foreach($request['mcqs'] as $mcq){
                $options = [
                    'question_id' => $qustion->id,
                    'title' => $mcq['answerOption'],
                    "status" => $mcq['status'],
                ];
                qoption::updateOrCreate($options,['id'=>$mcq['optionId']]);
            }
        }
        
        
         return response()->json(['status'=>true,'question' => $qustion], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $qustion = Question::find($id);
        $qustion['type'] = $qustion->qtype[0]->id;
       
        if($qustion->qtype[0]->id == 3){
            $opt = [];
            $correct = '';
            foreach($qustion->qoptions as $option){
                $opt[] = ['answerOption'=>$option->title, 'status'=> $option->status == 0 ? false : true,'optionId'=> $option->id];
                if($option->status == 1){
                    $correct = $option->title;
                    $qustion['correct'] = $correct;
                }
            }
            $qustion['selectedmcqs'] = $opt;
        }

        return response()->json(['status'=>true,'question' => $qustion], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'type' => 'required', 
        ]);
        if ($validator->fails()) {
             $errors = ValidationHelper::getValidationErrors($validator->errors());
            return response()->json(
                [
                    'status' => false,
                    'errors' => $errors
                ], 200);
        }

        // return $request;
        $update = Question::find($id);
        $update->title = $request['title'];
        $update->content = $request['content'];
        
        if($update->save()){
            $update->lesson()->sync($request->lesson_id);
            $update->qtype()->sync($request->type);

            if(isset($request['mcqs'])){
                foreach($request['mcqs'] as $mcq){
                    $options = [
                        'question_id' => $update->id,
                        'title' => $mcq['answerOption'],
                        "status" => $mcq['status'],
                    ];
                    qoption::updateOrCreate($options,['id'=> $mcq['optionId']]);
                }
            }
        }


        return response()->json(['status'=>true,'message' => 'updated successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatequestionRequest $request, question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(question $question)
    {
        //
    }
}
