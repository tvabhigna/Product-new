<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\Datatables\Datatables;
use App\Foo\Bar;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getData(Request $request)
    {
           return Datatables::of(Category::select('id','name'))
            ->addColumn( 'action', function ( $data ){
            return
                '<a href="javascript:;" data-url="' . url( 'categories/' . $data->id ) . '" class="modal-popup-view btn btn-outline-primary ml-1 legitRipple">Show</i></a>' .
                '<a class="btn btn-outline-primary ml-1"  id="editProduct" data-id="'.$data->id.'" data-toggle="modal" data-target="#categoryModal">Edit</a> '.
                '<a href="javascript:;" data-url="' .route('categories.destroy', $data->id) . '" data-id="'.$data->id.'" class="modal-popup-delete btn btn-outline-danger ml-1 legitRipple"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
              })
            ->rawColumns(['action'])
            ->make(true);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $request->all();
        $product = Category::create($data);
        return response()->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
