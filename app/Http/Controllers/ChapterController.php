<?php

namespace App\Http\Controllers;
use App\Models\chapter;
use App\Models\course;
use App\Models\qoption;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorechapterRequest;
use App\Http\Requests\UpdatechapterRequest;
use App\Models\Module;
use Illuminate\Http\Request;
use Validator;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Chapter::all();
        return response()->json($courses, 200);
    }

    public function options()
    {
        $options = qoption::all();
        $opt = [];
        foreach($options as $option){
            $opt[] = ['name'=>$option->title, 'code'=>$option->id, 'status'=>false];
        }
        return response()->json($opt, 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorechapterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module, Chapter $chapter)
    {
        $lessons = $chapter->lessons()->where('multiple', 1)->get();
        return View('pages.chapters.index',['chapter'=> $chapter, 'module' => $module, 'lessons' => $lessons]);
        
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(chapter $chapter)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, chapter $chapter)
    {
        return '123';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(chapter $chapter)
    {
        //
    }
     // api classess

     public function get_courses()
     {  
         
 
     }
 
     public function create_course(Request $request)
     {  
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'module_id' => 'required',
            "subtitle" => 'required',
            "icon" => "required",
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(
                [
                    'status' => false,
                    'error' => $validator->errors(),
                ], 200);
        }

        $parent = 0;
        if(isset($request->parent)){
            if($request->parent == true){
                $parent = 1;
            }   
        }

        $course = Chapter::create([
            'name' => $request->name,
            'title' => $request->title,
            'module_id' => $request->module_id,
            "icon" => $request->icon, 
            "subtitle" => $request->subtitle,
            "description" => $request->description,
            "parent" => $parent,
        ]);

        $file = $request->file('file');
        try{
            if($request->hasFile('file')){
                $file = $request->file('file');
                $file_name = time().'.'.$file->getClientOriginalName();
                $course->addMedia($file)->toMediaCollection('chapter_image');
            } 
        }
        catch(Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        } 
        return response()->json(['status'=>true,'course' => $course], 200);
    }


    public function create_option(Request $request)
     {  
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(
                [
                    'status' => false,
                    'error' => $validator->errors(),
                ], 200);
        }
        
         $option = qoption::create([
             'title' => $request->title,
         ]);
    }

    public function delete_option(Request $request)
     {  
        $res = qoption::where('id',$request->id)->delete();
        return response()->json(['status'=>true], 200);
    }
}
