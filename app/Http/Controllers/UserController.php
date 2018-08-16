<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\BankAccount;
use DB;

class UserController extends Controller
{
    //
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        if($user->isDeleted=='true')
            {
                return json_decode('{"status": "This User has been deleted"}', true);
            }
        else
            return $user;
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return array("res" => "0", "errors" => $validator->errors());
        }

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request,User $user)
    {
        $validator = \Validator::make($request->all(), [
            'name'=>'max:120',
            'email'=>'email|unique:users,email,'.$user->id,
        ]);

        if ($validator->fails()) {
            return array("res" =>"0", "errors" => $validator->errors());
        }

        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function delete(User $user)
    {
        
        User::where('id', $user->id)->update(array('isDeleted' => 'true'));
        
        return response()->json(null, 204);
    }
}
