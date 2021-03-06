<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Classes\Helper\CommonUtil;
use App\Models\Brand;
use App\Models\Imageable;
use Yajra\Datatables\Datatables;
use App\Foo\Bar;
use Session;
use App\Models\Category;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getData()
    {
        return Datatables::of(Brand::with('category','imageable')->get())
        ->addColumn('category_id',function ($data) {
            return $data->category->name;
            })
        ->addColumn('image', function ($data) {
            $images = json_decode($data->imageable);
            if ((is_array($images) )) {
                $imgs="";
                foreach ($images as $image ) {
                    $url= asset('storage/'.$image->image);
                    $imgs .= '<img src="'.$url.'"  border="0" width="120" height="100" class="img-rounded shadow-lg" align="center"  />' ;
                } 
            }
            return $imgs;
            })
        ->addColumn( 'action', function ( $data ){
            return
                '<a href="javascript:;" data-url="' . url( 'brands/' . $data->id ) . '" class="modal-popup-view btn btn-outline-primary ml-1 legitRipple">Show</i></a>' .
                '<a href="' . url( 'brands/' . $data->id . '/edit' ) . '"class="btn btn-outline-primary ml-1 legitRipple"><i class="glyphicon glyphicon-edit"></i> Edit</a>' .
                '<a href="javascript:;" data-url="' .route('brands.destroy', $data->id) . '" class="modal-popup-delete btn btn-outline-danger ml-1 legitRipple"><i class="glyphicon glyphicon-edit"></i> Delete</a>'.
                '<a href="javascript:;" data-url="' .route('brands.image', $data->id) . '"data-id="' .  $data->id   . '" id="showImage" class="showImage btn btn-outline-danger  ml-1 legitRipple"><i class="glyphicon glyphicon-edit"></i> Show image</a>';
            })
        ->rawColumns(['category','action','image'])
        ->make( true );
    }

    public function showImage($id){
        if(Imageable::where('brand_id',$id)->get()){
            $images = json_decode(Imageable::where('brand_id',$id)->get());
            if ((is_array($images) )) {
                $imgs="";
                foreach ($images as $image ) {
                    $url= asset('storage/'.$image->image);
                    $imgs .= '<img src="'.$url.'"  border="0" width="120" height="100" class="img-rounded shadow-lg" align="center"  />' ;
                } 
            }
            return $imgs;
        }
        return response()->json();    
        
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
        $count = Category::count();
        if($count < 1) {
            //less than one raw
            Session::flash('success', 'you have to add category first.');
            return view('category.index');
        }else {
            // dd("hie");
            return view('brand.create_update',compact('categories'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request,Brand $brand,Category $category)
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
            'id'        =>  $brand->id,
            'name'      =>  $brand->name,
            'status'    =>  $brand->status,
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
    public function update(BrandRequest $request,Brand $brand,Category $category)
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
