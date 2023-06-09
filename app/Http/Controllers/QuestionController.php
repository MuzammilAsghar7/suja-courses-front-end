<?php

namespace App\Http\Controllers;
use App\Models\lesson;
use App\Models\question;
use App\Models\qoption;
use App\Models\Attempt;
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
        $allow_description = 0;
        if(isset($request->allow_description)){
            $allow_description = ($request->allow_description == 'true') ? 1 : 0;
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required',
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
             'allow_description' => $allow_description
         ]);
         

         $qustion->lesson()->attach($request->lesson_id);
         $qustion->qtype()->attach($request->type);

        if(isset($request['mcqs']) && $request->type == 3){
            foreach($request['mcqs'] as $mcq){
                $status = 0;
                if(isset($mcq['status'])){
                    $status = ($mcq['status'] == 'true') ? 1 : 0;
                }
                $options = [
                    'question_id' => $qustion->id,
                    'title' => $mcq['answerOption'],
                    "status" => $status,
                ];
                qoption::Create($options);
            }
        }

        try{
            if($request->hasFile('file')){
                $file = $request->file('file');
                $file_name = time().'.'.$file->getClientOriginalName();
                $qustion->addMedia($file)->toMediaCollection('question_image');
            } 
        }
        catch(Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ]);
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
        $allow_description = 0;
        if(isset($request->allow_description)){
            $allow_description = ($request->allow_description == 'true') ? 1 : 0;
        }

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
        $update->allow_description = $allow_description;
        
        if($update->save()){

            try{
                if($request->hasFile('file')){
                    $update->clearMediaCollection('question_image');
                    $file = $request->file('file');
                    $file_name = time().'.'.$file->getClientOriginalName();
                    $update->addMedia($file)->toMediaCollection('question_image');
                } 
            }
            catch(Exception $e){
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            } 

            $update->lesson()->sync($request->lesson_id);
            $update->qtype()->sync($request->type);

            if(isset($request['mcqs'])){
                foreach($request['mcqs'] as $mcq){
                    
                    $mcqStatus = 0;
                    if(isset($mcq['status'])){
                        $mcqStatus = ($mcq['status'] == 'true') ? 1 : 0;
                    }

                    $options = [
                        'question_id' => $update->id,
                        'title' => $mcq['answerOption'],
                        "status" => $mcqStatus,
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
    public function destroy($id)
    {
        $res=Question::where('id',$id)->delete();
        if ($res)
        {
          $data=[ 'status'=>'1','msg'=>'success'];
        }else
        {
          $data=['status'=>'0','msg'=>'fail'];
        }
        return response()->json($data);
    }

    public function delete($id)
    {
        $res=Question::find($id);
        if ($res)
        {
          $deletemedia = $res->clearMediaCollection('question_image');
          if($deletemedia){
            $data=[ 'status'=>'1','msg'=>'success'];
          } else{
            $data=['status'=>'0','msg'=>'fail'];
          }
        }else
        {
          $data=['status'=>'0','msg'=>'fail'];
        }
        return response()->json($data);
    }

    public function append_answer(Request $request)
    {
        $request->validate([
            'module_id' => 'required',
            'chapter_id' => 'required',
            'lesson_id' => 'required',
            'question_id' => 'required',
            'answer_id' => 'required',
            'status' => 'required',
        ]);

        if($request->status != 1){
            return response()->json(
                [
                    'status' => false,
                    'class' => 'incorrect'
                ], 200);
        }

        Attempt::updateOrCreate([
            'user_id' => auth()->user()->id,
            'module_id' => $request->module_id,
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
            'question_id' => $request->question_id,
            'qoption_id' => $request->answer_id,
        ]);
        return response()->json(
            [
                'status' => true,
                'class' => 'correct' 
            ], 200);
    }
}
