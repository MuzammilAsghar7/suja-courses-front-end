<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/')->withSuccess('You have Successfully loggedin');
        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function store(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        return redirect("/")->withSuccess('Great! You have Successfully loggedin');
    }

    /**
     * Display the specified resource.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return response()->json(
                [
                    'status' => false,
                    'error' => $validator->errors(),
                ], 200); 
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;
        return response()->json(['status'=>true,'message' => 'User registered successfully.'], 200);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $data['token'] =  $user->createToken('MyApp')-> accessToken; 
            $data['name'] =  $user->name;
            $data['email'] =  $user->email;
            return response()->json(['status'=>true,'message' => 'Logged in successfully.','user'=>$data], 200);
        } 
        else{ 
            return response()->json(['status'=>false,'message' => 'Unauthorised.'], 401);
        } 
    }

    public function showusers()
    {
        $users = User::get();
        return View('pages.home',['users'=>$users]);
    }

    public function logout()
    {
        return redirect('login')->with(Auth::logout())->withSuccess('You have logged out');
    }

    public function loginView()
    {
        if(Auth::check()){
            return redirect('/');
        }
        return View('pages/login');
    }


}
