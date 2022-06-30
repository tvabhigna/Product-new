<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Yajra\Datatables\Datatables;
use App\Foo\Bar;
use Storage;
use App\Models\Category;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getData(Request $request, Category $category)
    {

        return Datatables::of(Product::with('category')->get())
            ->addColumn('image', function ($data) {
                $url = asset('storage/' . $data->image);

                return '<img src="' . $url . '" border="0" width="100" height="100" class="img-rounded shadow-lg" align="center" />';
            })
            ->addColumn('action', function ($data) {
                return
                    '<a href="javascript:;" data-url="' . url('products/' . $data->id) . '" class="modal-popup-view btn btn-outline-primary ml-1 legitRipple shadow">Show</i></a>' .
                    '<a class="btn btn-outline-primary ml-1 shadow"  id="editProduct" data-id="' . $data->id . '" data-toggle="modal" data-target="#modal-id">Edit</a> ' .
                    '<a href="javascript:;" data-url="' . route('products.destroy', $data->id) . '" data-id="' . $data->id . '" class="modal-popup-delete btn btn-outline-danger ml-1 legitRipple shadow"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
            
            return response()->json(['html' => $html]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('Product.index',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Category $category)
    {
        $data = $request->all();
        if (!$request->category_id) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '';
            $categories = Category::where('id', $request->category_id)->get();
            foreach ($categories as $category) {
                $html .= '<option value="'.$category->id.'">'.$category->name.'</option>';
            }
        }

        if ($request->hasfile('image')) {
            $data['image'] = Storage::disk('public')->putFile('images', $request->file('image'));
        }
        $product = Product::create($data);
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data  = [
            'id'      =>  $product->id,
            'name'    =>  $product->name,
            'price'   =>  $product->price,
            'category' =>  $product->category_id,
        ];
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return response()->json([
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->all();
        if (!$request->category_id) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '';
            $categories = Category::where('id', $request->category_id)->get();
            foreach ($categories as $category) {
                $html .= '<option value="'.$category->id.'">'.$category->name.'</option>';
            }
        }
        if ($request->hasfile('image')) {
            $data['image'] = Storage::disk('public')->putFile('images', $request->file('image'));
        }
        $product->update($data);
        return response()->json([
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return 1;
    }
}
