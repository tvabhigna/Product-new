<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Yajra\Datatables\Datatables;
use App\Foo\Bar;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('user.index');
    }

    public function getData()
    {
        return Datatables::of(User::select('id', 'name', 'email', 'type'))
        ->addColumn('action', function ($data) {
          return
            '<a href="javascript:;" data-url="' . url('users/' . $data->id) . '" class="modal-popup-view btn btn-outline-primary ml-1 legitRipple shadow">Show</i></a>' .
            '<a class="btn btn-outline-primary ml-1 shadow"  id="editUser" data-id="' . $data->id . '" data-toggle="modal" data-target="#userModal">Edit</a> ' .
            '<a href="javascript:;" data-url="' . route('users.destroy', $data->id) . '" data-id="' . $data->id . '" class="modal-popup-delete btn btn-outline-danger ml-1 legitRipple shadow"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
        })

        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $user = User::create($data);
        return response()->json(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = [
            'id'    => $user->id,
            'name'  => $user->name,
            'email'  => $user->email,
            'type'  => $user->type,
        ];
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return response()->json([
            'data' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request,User $user)
    {
        $data = $request->all();
        $user->update($data);
        return response()->json([
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json();    
    }
}
