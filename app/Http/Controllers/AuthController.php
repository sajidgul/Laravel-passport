<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Trait\HttpResponses;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use HttpResponses;
    public function Register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required',
            'password'=> ['required', 'confirmed']
        ]);

        if($validator->fails()){
            return sendError('Please fill all the credentials');
        }

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
        ]);
        
        // return $this->success([
        // $data['user'] = $user,
        // $data['Token'] = $user->createToken("Api token of".$user->name)->accessToken

        // ]);
        $data['user'] = $user;
        $data['Token'] = $user->createToken('Api Token of ' .$user->name)->accessToken;
        return sendResponse($data);
    }

    public function login(Request $request){
        $validator = $request->validate([
            'email'=>'required',
            'password'=>'required'
         ]);

        if(!Auth::attempt($request->only(['email', 'password']))){
            return sendError('Credential do not match');
        }

        // return $this->success([
        // $user = User::where('email', $request->email)->first(),
        // $data['user'] = $user,
        // $data['Token'] = $user->createToken("Api token of" . $user->name)->accessToken,
        // ]);

        $user = User::where('email', $request->email)->first();
        $data['user'] = $user;
        $data['token'] = $user->createToken("Api token of" .$user->name)->accessToken;
        return sendResponse($data);

        
    }

    public function logout(){
         Auth::user()->token()->revoke;
      return sendResponse('You have Successfully logged out and your token has been revoked');
    }
}
