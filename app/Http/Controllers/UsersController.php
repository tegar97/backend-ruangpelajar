<?php

namespace App\Http\Controllers;

use App\Models\studentsData;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('appToken')->accessToken;
            return response()->json([
                'success' => true,
                'token' => $success,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'nisn' => ['required','unique:users'],
        ]);
        $nisn = $request->input('nisn');

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ],
                401
            );
        }
        $getUser = studentsData::where('nisn', $nisn)->first();

        if ($getUser == null) {
            return response()->json([
                'message' => "Nisn tidak ditemukan",
                "error" => true
            ], 404);
        }

        $user = ModelsUser::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mother_name' => $getUser['mother_name'],
            'birthday' => $getUser['birthday'],
            'nisn' => $getUser['nisn'],
            'school_name' => $getUser['school_name'],
            'name' => $getUser['name'],
        ]);

        $success['token'] = $user->createToken('appToken')->accessToken;
        return response()->json([
            'success' => true,
            'token' => $success,
            'user' => $user
        ]);
    }


    public function getUser(Request $request){

        $nisn = $request->input('nisn');

        $getUser = studentsData::where('nisn',$nisn)->first();

        if($getUser == null) {
            return response()->json([
                'message' => "Nisn tidak ditemukan",
                "error"=> true
            ],404);
        }

       return  response()->json($getUser,200);

    }


    public function me(){
        return response()->json(Auth::user());
    }

    public function logout(Request $request)
    {
        if (Auth::user()) {
            $user = Auth::user()->token();
            $user->revoke();
            return response()->json([
                'success' => true,
                'message' => 'Logout successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to Logout',
            ]);
        }
    }
}
