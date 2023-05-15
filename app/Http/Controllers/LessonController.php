<?php

namespace App\Http\Controllers;
use App\Models\lesson;
use App\Models\{ chapter,Attempt };
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
            'title' => 'required|max:100|unique:lessons',
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

        $lesson = Lesson::create([
              'title' => $request->title,
              'subtitle' => $request->excerpt,
              'description' => $request->description,
              'status' => $request->status,
        ]);

        $lesson->chapter()->attach($request->chapter_id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // return $id;
        $chapter = Chapter::find($id);
        $lessons = $chapter->lessons;
        return response()->json(
            [
                'status' => true,
                'data' => $lessons
            ], 200);
    }

    public function lesson($id)
    {
        // return $id;
        $lesson = Lesson::find($id)->first();
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
        $lesson->update($request->all());

        $lessons = Lesson::find($id);
        return $lessons;
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
        dd($request->post());
    }

}
