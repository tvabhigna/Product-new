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
      $data = $request->except('image');
        if($request->hasfile('image')) {
          $data['image'] = Storage::disk('public')->putFile('images', $request->file('image'));
        }
        $product = Product::create($data);
        // return response()->json(
        //               [
        //                 'success' => true,
        //                 'message' => 'Data inserted successfully'
        //               ]
        // )
        return redirect('/products');






//         $data = $request->except('image');
//         if($product = Product::create($data)){
//           // dd($request->all());

//           if($request->hasfile('image')) {
//             // foreach($request->file('image') as $file)
//                 // {
//                     $image_name = time().'.'.$request->image->extension();
//                     // $request->image->move(public_path().'/storage/images/', $image_name);  
//                     // $fileModal = new Product();
//                     $image = Storage::disk('public')->putFile('images', $request->file('image'));
// dd($product);

//                     $product->image = $image;

//                     // $fileModal->event_id = $event->id;
//                     $product->save();
//                 // }
    
//             // $data['image'] = time().'.'.$request->image->extension();
//             // $request->image->move(public_path('storage/images'), $data['image']);

//           }
//         }
      
//         $product = Product::create($data);
//         return response()->json(
//             [
//               'success' => true,
//               'message' => 'Data inserted successfully'
//             ]
//           );

        
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
        $data = $request->all();
        $product = Product::update($data);

        // $product  = Product::find($id);

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
