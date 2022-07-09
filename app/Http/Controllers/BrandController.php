<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Helper\CommonUtil;
use App\Models\Brand;
use Yajra\Datatables\Datatables;
use App\Foo\Bar;
use Session;

class BrandController extends Controller
{
    public function getData()
    {
        return Datatables::of(Brand::select('id','name','status','image') )
        ->addColumn('image', function ($data) {
            $url = asset('storage/' . $data->image);

            return '<img src="' . $url . '" border="0" width="100" height="100" class="img-rounded shadow-lg" align="center" />';
        })
            ->addColumn( 'action', function ( $data ){
            return
                '<a href="javascript:;" data-url="' . url( 'brands/' . $data->id ) . '" class="modal-popup-view btn btn-outline-primary ml-1 legitRipple">Show</i></a>' .
                '<a href="' . url( 'brands/' . $data->id . '/edit' ) . '"class="btn btn-outline-primary ml-1 legitRipple"><i class="glyphicon glyphicon-edit"></i> Edit</a>' .
                '<a href="javascript:;" data-url="' .route('brands.destroy', $data->id) . '" class="modal-popup-delete btn btn-outline-danger ml-1 legitRipple"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
            })
        ->rawColumns(['action','image'])
        ->make( true );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Brand $brand)
    {
        return view('brand.create_update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Brand $brand)
    {
        $data = $request->all();
            if ($request->hasfile('image')) {
                $imageName = CommonUtil::uploadFileToFolder( $request->file('image'), 'brand' );
                $data['image'] = $imageName;
            }
        if ($brand = Brand::create($data)) {
            // dd($data['image']);
            Session::flash('success', 'Brand has been added!');
            return redirect(route('brands.index'));
        } else {
            Session::flash('error', 'Unable to create brand.');
            return redirect(route('brands.create_update'))->withInput();
        }    
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        $data  = [
            'id'                =>  $brand->id,
            'name'              =>  $brand->name,
            'status'            =>  $brand->status,
            ];
            return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brand.create_update')
        ->with(compact('brand', $brand));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Brand $brand)
    {
        $data = $request->all();
        
            if ($request->hasfile('image')) {
                $imageName = CommonUtil::uploadFileToFolder( $request->file('image'), 'public' );
                $data['image'] = $imageName;
            }
            if($brand->update($data)){

            Session::flash('success', 'Brand has been updated!');
            return redirect(route('brands.index'));
            } else {
            Session::flash('error', 'Unable to update brand.');
            return redirect(route('brands.create'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json();    
    }
}