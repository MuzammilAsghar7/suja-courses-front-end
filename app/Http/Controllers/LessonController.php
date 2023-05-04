<?php

namespace App\Http\Controllers;
use App\Models\lesson;
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
        $lessons = Lesson::all();
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

}
