<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    //
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->error());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['status_id'] = 1;
        $input['role_id'] = 2;
        $user = User::create($input);

        if($file = $request->file('photo')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);

            $user->avatar()->create([
                'path' => $name
            ]);
            $success['photo'] = $user->avatar->path;
        }

        $success['token'] = $user->createToken('jobManagerApi')->accessToken;
        $success['name'] = $user->name;
        $success['id'] = $user->id;
        $success['role_id'] = $user->role_id;

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request) {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if($user->status_id == 1) {
                $success['token'] = $user->createToken('jobManagerApi')->accessToken;
                $success['name'] = $user->name;
                $success['id'] = $user->id;
                $success['role_id'] = $user->role_id;

                return $this->sendResponse($success, 'User login successfully.');
            }
                return $this->sendError('User inactive.', [
                    'error' => 'User inactive'
                ]);



        }else{
            return $this->sendError('Unauthorised.', [
                'error' => 'Unauthorised'
            ]);
        }
    }

    public function requestError(Request $request) {
        return $this->sendError('Invalid data.', [
            'error' => 'invalid data',
            'request' => $request->all()
        ]);
    }
}
