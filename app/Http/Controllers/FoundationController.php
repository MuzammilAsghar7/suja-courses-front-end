<?php

namespace App\Http\Controllers;

use App\Models\Foundation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class FoundationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $user_id = auth()->user()->id;
        $chapter_id = $request->chapter_id;
        $page_number = $request->page_number;
        $next_chapter = $request->next_chapter;
        $last_lesson = $request->last;
        if($user_id){
            Foundation::create([
                'user_id' => $user_id,
                'question_id' => $request->question_id,
                'answer' => $request->answer,
                'reference' => $request->reference,
                'thoughts' => $request->thoughts,
            ]);
            $name = Session('module_name');
            if($next_chapter == 'finish'){
                $url = "/$name/1    ";
            }else
            {
              $url = "/$name/$chapter_id/$page_number";
              if($last_lesson == 1){
                $url = "/$name/${$chapter_id+1}/1";
              }
            }   
            return redirect($url);
       }else{
            
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(Foundation $foundation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foundation $foundation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foundation $foundation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foundation $foundation)
    {
        //
    }
}
