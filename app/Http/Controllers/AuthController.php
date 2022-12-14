<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    
    //Create new user 
    public function register(Request $request)
    {

        
        //Validate all data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|max:25',
        ]);

        //If missing data trhow error
        if ($validator->fails()) {
            return response()->json([
                'success' => true,
                'message' => $validator->errors()
            ],);
        }

        //Creating user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->password)
        ]);

        //Default attach to user
        $user->roles()->attach(1);

        //Creating token
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user', 'token'), 201);
    }



    //Login User
    public function login(Request $request)
    {
        
        $input = $request->only('email', 'password');
        $jwt_token = null;
        
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }


    //Get profile User
    public function me(){
        return response()->json([
            'success' => true,
            'data' => auth()->user()
        ]);
    }

    //Logout User
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    //Edit User Profile
    public function editProfile(Request $request, $id)
    {
        try {
            Log::info('Put User');
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'email' => 'email'
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],
                    400
                );
            };

            $user = User::query()->findOrFail($id);
            
            $name =  $request->input('name');
            $email = $request->input('email');

            if (isset($name)) {
                $user->name = $name;
            } else if (isset($email)) {
                $user->email = $email;
            }

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'PUT New user',
                'data' => $user
            ], 200);

            
        } catch (\Exception $exception) {
            Log::error('Error Updating contact: ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error Updating Contact'
            ], 500);
        }
    }
}
