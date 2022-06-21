<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\Datatables\Datatables;
use Storage;

class ProductController extends Controller
{
    // get data function
    public function getData(Request $request)
    {
    //     $products = Product::latest()->paginate(5);

    //   return Request::ajax() ? 
    //                response()->json($produsct,Response::HTTP_OK) 
    //                : abort(404);

        if ($request->ajax()) {
            $data = Product::select('*')->orderBy('created_at','Desc');
            return Datatables::of($data)
                    
                    ->make(true);
        }
        
        return view('products');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Product::updateOrCreate(
            [
              'id' => $request->id
            ],
            [
              'name' => $request->name,
              'address' => $request->address
            ]
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $ptoduct)
    {
      $data = $request->except('image','_token');
        if($request->hasfile('image')) {
          $data['image'] = Storage::disk('public')->putFile('images', $request->file('image'));
        }
        $product = Product::updateOrCreate(['id' => $request->id],$data);
        // return response()->json(['success' => true]);
        // dd('hi');
        // $product   =   Product::updateOrCreate(
        //   [
        //       'id' => $request->id
        //   ],
        //   [
        //       $data

        //   ]);
        return redirect('/products');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
      $data  = [
        'id'      =>  $product->id,
        'name'    =>  $product->name,
        'price'   =>  $product->price,
        'category'=>  $product->category,
        'image'   =>  $product->image,
        ];
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
      return response()->json([
        'data' => $product
      ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
      // dd($request->all());
      $data = $request->except('image');
        if($request->hasfile('image')) {
          $data['image'] = Storage::disk('public')->putFile('images', $request->file('image'));
        }
        // $data = $request->all();
        dd($request->all());
        $product = Product::update($data);
        // DB::table('products')->where('id', $id)->update($data);

//         Datatables::table('products')
//         ->where('id', $id)
//         ->update(['product' => $product]);
//         // $product  = Product::find($id);
// dd('sdj');
        return response()->json([
          'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
          'message' => 'Data deleted successfully!'
        ]);
    }
}
