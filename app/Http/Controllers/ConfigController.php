<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\qtype;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $courses = Module::all();
        $question_types = Qtype::all();
        return response()->json([
            'status'=>true,
            'statusCode'=>200,
            'data' => [
                'courses' => $courses,
                'question_types' => $question_types
             ]
          ]);
    }


}
