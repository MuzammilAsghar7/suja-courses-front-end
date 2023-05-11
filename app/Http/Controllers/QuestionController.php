<?php

namespace App\Http\Controllers;
use App\Models\question;
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
        $question = Question::all();
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
        return $request['mcqs'];
        // return $request->lesson_id;
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100|unique:questions',
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
        
         $qustion = Question::create([
             'title' => $request->title,
             "content" => $request->content,
         ]);

         $qustion->lesson()->attach($request->lesson_id);
         $qustion->qtype()->attach($request->type);
        //$file = $request->file()['file'];

         return response()->json(['status'=>true,'question' => $qustion], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $qustion = Question::find($id);
        return response()->json(['status'=>true,'question' => $qustion], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,Request $request)
    {
        // return $request;
        $update = Question::find($id);
        $update->title = $request['title'];
        $update->content = $request['content'];
        $update->save();
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
