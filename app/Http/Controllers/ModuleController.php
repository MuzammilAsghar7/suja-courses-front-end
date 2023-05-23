<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Session;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::all();
        return View('pages.home',['modules'=>$modules]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        
        $chapters = $module->chapters;
        return View('pages.chapters.index',['chapters'=> $chapters, 'module' => $module]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // api classess
    public function get_modules()
    {  
        $modules = Module::all();   
        return response()->json($modules, 200);

    }

    public function chapters($name, $id)
    {
        Session::put('module_name', $name);

        $course = Module::where('id', $id)
        ->withCount('chapters')
        ->with(['chapters' => function ($query) {
            $query->withCount('lessons');
        }])
        ->first();
        return View('pages/chapters/index',['course' => $course]);
    }

}
