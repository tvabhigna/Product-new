<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Helper\CommonUtil;
use App\Models\Brand;
use App\Models\Imageable;
use Yajra\Datatables\Datatables;
use App\Foo\Bar;
use Session;
use App\Models\Category;

class BrandController extends Controller
{
    public function getData()
    {
        return Datatables::of(Brand::with('category')->get())
        ->addColumn('category_id',function ($data) {
            return $data->category->name;
            })
        ->addColumn('image', function ($data) {
            if (isset($request->image) ) {
                foreach($data->image as $image){
            $image = asset('storage/' . $data->image);
            
      
    return '<img src="' . $image . '" border="0" width="100" height="100" class="img-rounded shadow-lg" align="center" />';
}} 
    })
        ->addColumn( 'action', function ( $data ){
            return
                '<a href="javascript:;" data-url="' . url( 'brands/' . $data->id ) . '" class="modal-popup-view btn btn-outline-primary ml-1 legitRipple">Show</i></a>' .
                '<a href="' . url( 'brands/' . $data->id . '/edit' ) . '"class="btn btn-outline-primary ml-1 legitRipple"><i class="glyphicon glyphicon-edit"></i> Edit</a>' .
                '<a href="javascript:;" data-url="' .route('brands.destroy', $data->id) . '" class="modal-popup-delete btn btn-outline-danger ml-1 legitRipple"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
            })
        ->rawColumns(['category','action','image'])
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
    public function create(Brand $brand,Category $category)
    {
        $categories = Category::all()->pluck('name', 'id')->prepend(trans('Select category'), '');
        return view('brand.create_update',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Brand $brand,Category $category)
    {
        $data = $request->all();
        if ($brand = Brand::create($data)) {
            if (isset($request->image) ) {
            foreach($request->image as $image){
            $fileModal = new Imageable();
            $fileModal->image = CommonUtil::uploadFileToFolder($image, 'brand' );
            $fileModal->brand_id = $brand->id;
            $fileModal->save();
        }}
        $data['image'] = json_encode($fileModal);
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
    public function edit(Brand $brand,Category $category)
    {
        $categories = Category::all()->pluck('name', 'id')->prepend(trans('Select category'), '');
        return view('brand.create_update')
        ->with(compact('brand', $brand,'categories'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Brand $brand,Category $category)
    {
        $data = $request->all();
        
        if($brand->update($data)){
        if (isset($request->image) ) {
            foreach($request->image as $image){
            $fileModal = new Imageable();
            $fileModal->image = CommonUtil::uploadFileToFolder($image, 'brand' );
            $fileModal->brand_id = $brand->id;
            $fileModal->save();
        }}
            
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
