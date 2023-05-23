<?php

namespace App\Http\Controllers;
use App\Models\lesson;
use App\Models\{ chapter,Attempt, Module };
use App\Http\Controllers\Controller;
use App\Http\Requests\StorelessonRequest;
use App\Http\Requests\UpdatelessonRequest;
use Illuminate\Http\Request;
use Validator;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Lesson::all();
        return respopnse()->json([
            'status' => true,
            'data' => $lessons
        ]);
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:200',
            'chapter_id' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(
                [
                    'status' => false,
                    'error' => $validator->errors(),
                ], 200);
        }

        try{
            if($request->hasFile('file')){
                $file = $request->file('file');
                $file_name = time().'.'.$file->getClientOriginalName();

                $lesson = Lesson::create([
                    'title' => $request->title,
                    'subtitle' => $request->excerpt,
                    'description' => $request->description,
                    'status' => $request->status,
                ]);
                $lesson->chapter()->attach($request->chapter_id);

                $lesson->addMedia($file)->toMediaCollection('lesson_image');

                return response()->json([
                    'status' => 'success',
                ], 200);
            } 
            else{
                $lesson = Lesson::create([
                    'title' => $request->title,
                    'subtitle' => $request->excerpt,
                    'description' => $request->description,
                    'status' => $request->status,
                ]);
                $lesson->chapter()->attach($request->chapter_id);
                return response()->json([
                    'status' => 'success',
                ], 200);
            }
        }
        catch(Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $chapter = Chapter::find($id);
        $lessons = $chapter->lessons()->withCount('questions')->get();
        return response()->json(
            [
                'status' => true,
                'data' => $lessons
            ], 200);
    }

    public function shown(Module $module, Chapter $chapter, Lesson $lesson)
    {
        $questions = $lesson->questions;
        $lessons = $chapter->lessons;
        $chapters = $module->chapters;
        $modules = Module::all();

        $next_lesson = $lessons->where('id', '>', $lesson->id)->first();
        $next_chapter = $chapters->where('id', '>', $chapter->id)->first();
        $next_module = $modules->where('id', '>', $module->id)->first();

        if($next_lesson)
        {
            $module_id = $module->id;
            $chapter_id = $chapter->id;
            $lesson_id = $next_lesson->id;
            $url = '/'.$module_id.'/'.$chapter_id.'/'.$lesson_id;
            // dd($lesson->toArray());
            return View('pages.lessons.index',['chapter'=> $chapter, 'module' => $module, 'lesson' => $lesson, 'questions' => $questions, 'next_page' => $url, 'next_name' => $next_lesson->title]);
        }
        else if($next_chapter)
        {
            $module_id = $module->id;
            $chapter_id = $next_chapter->id;
            $lesson_id = $next_chapter->lessons->first()->id;
            $url = '/'.$module_id.'/'.$chapter_id.'/'.$lesson_id;
            return View('pages.lessons.index',['chapter'=> $chapter, 'module' => $module, 'lesson' => $lesson, 'questions' => $questions, 'next_page' => $url, 'next_name' => $next_chapter->lessons->first()->title]);
        }
        else if($next_module)
        {
            $url = '/';
            return View('pages.lessons.index',['chapter'=> $chapter, 'module' => $module, 'lesson' => $lesson, 'questions' => $questions, 'next_page' => $url, 'next_name' => 'Home']);
        }
        
        // return $id;
        // $chapter = Chapter::find($id);
        // $lessons = $chapter->lessons()->withCount('questions')->get();
        // return response()->json(
        //     [
        //         'status' => true,
        //         'data' => $lessons
        //     ], 200);
    }
    public function childshown(Module $module, Chapter $chapter, Lesson $parentlesson, Lesson $childlesson)
    {
        return $childlesson->questions;
        // return $id;
        // $chapter = Chapter::find($id);
        // $lessons = $chapter->lessons()->withCount('questions')->get();
        // return response()->json(
        //     [
        //         'status' => true,
        //         'data' => $lessons
        //     ], 200);
    }

    public function lesson($id)
    {
        // return $id;
        $lesson = Lesson::find($id);
        return response()->json(
            [
                'status' => true,
                'data' => $lesson
            ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lesson = Lesson::find($id);
        try{
            if($request->hasFile('file')){
                $lesson->clearMediaCollection('lesson_image');
                $file = $request->file('file');
                $file_name = time().'.'.$file->getClientOriginalName();

                $lesson->update($request->all());

                $lesson->addMedia($file)->toMediaCollection('lesson_image');

                return response()->json([
                    'status' => 'success',
                ], 200);
            } 
            else{
                $lesson->update($request->all());

                return response()->json([
                    'status' => 'success',
                ], 200);
            }
        }
        catch(Exception $e){
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lesson $lesson)
    {
        //
    }

    public function add($request)
    {
        
    }
    public function lessons($chapter_id,$lesson_id)
    {
        // dd($chapter_id);
        $page_number = $lesson_id;
        $limit = 1; 
        $chapter = Chapter::where('id', $chapter_id)->whereHas('lessons')->first();
        $nextchapter = Chapter::select('id')->where('id', '>', $chapter_id)->whereHas('lessons')->first();
        
        if($nextchapter){
            $nextchap_id = $nextchapter->id;
        } else{
            $nextchap_id = 'finish';
        }
    
        if($chapter){
            $lessons = $chapter->lessons()
            ->skip(($page_number - 1) * $limit)
            ->take($limit)
            ->whereHas('questions')
            ->first();
            $chapter['lesson'] = $lessons;
            $chapter['last_lesson_id'] = $chapter->lessons_with_question->last()->id;
            $chapter['next_chapter'] = $nextchap_id;           
        } 
        else{
            return redirect("/getting-started/$nextchap_id/1");
        }
        

        // if($lessons == null){
        //     return redirect()->route('home');
        // }
        
        return view('pages/lessons/index', ['chapter'=>$chapter,'page'=>$page_number,'has_pagination' => true]);
    }

    public function markread(Request $request){ 
        
        $request->validate([
            'user_id' => 'required',
            'module_id' => 'required',
            'chapter_id' => 'required',
            'lesson_id' => 'required',
            'question_id' => 'required',
        ]);

        
        Attempt::updateOrCreate([
            'user_id' => $request->user_id,
            'module_id' => $request->module_id,
            'chapter_id' => $request->chapter_id,
            'lesson_id' => $request->lesson_id,
            'question_id' => $request->question_id
        ]);
        return redirect()->back();
    }

    public function delete_media($id)
    {
        $lesson = Lesson::find($id);
        $lesson->clearMediaCollection('lesson_image');
        return response()->json([
            'status' => 'delete',
        ], 200);
    }

}
