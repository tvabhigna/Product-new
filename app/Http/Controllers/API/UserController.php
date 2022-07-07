<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Foo\Bar;

class UserController extends Controller
{
    public function index() {
        return User::all();
    }

    public function create(Request $request, User $user) {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'type'=>'required'
        ]);
        $data = $request->all();
        $user = User::create($data);
        if($user){
            // return ["result"=>"Data has been saved"];
            return response()->json(['user'=>$user],200);
        }        
        else{
            return ["result"=>"Operation Failed"];
        }
    }

    public function show($id) {
        return User::find($id);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
                'name'=>'required',
                'email'=>'required',
                'password'=>'required',
                'type'=>'required'
        ]);

        $user = User::find($id);
        if($user){
            $data = $request->all();
            $user->update($data);
            // return ["result"=>"Data has been updated"];
            return response()->json(['user'=>$user],200);
        }        
        else{
            return ["result"=>"Operation Failed"];
        }
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return ["result"=>"record delete".$user];
    }
}
