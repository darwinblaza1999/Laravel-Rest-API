<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
//use Validator;

class ProductController extends BaseController
{
    protected $product = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        // $this->middleware('auth:api');
        // $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return $this->sendResponse($products, 'Product list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$path = $file->store('public/upload');

        $products = Product::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'category_id' => $request['category_id'],
            'photo' => $request->photo->store('public/upload'),
        ]);

        return $this->sendResponse($products, 'Product Successfully Created');

        // $validator = Validator::make($request->all(),
        // [
        //     'name' => 'required',
        //     'description' => 'required',
        //     'price' => 'required'
        // ]);
        // if($validator->fails())
        // {
        //     return response()->json(['error' => $validator->error()], 401);
        // }
        // if ($files = $request->file('file')){
        //     $file = $request->file->store('public/upload');

        //     $product = new Product();
        //     $product -> name = 'name' => $request['name']
        //     $product -> description = 'description' => $request['description'],
        //     $product -> price = 'price' => $request['price'],
        //     $product -> category_id = 'category_id' => $request['category_id'],
        //     $product -> image = $file;
        //     $product -> save();

        //     return response()->json(["success" => true,
        //                             "message" => "sakto",
        //                             "file" => $file]);

        //}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$product = $this->product->with(['category', 'tags'])->findOrFail($id);
        $product = Product::findOrFail($id);

        return $this->sendResponse($product, 'Product Details');
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
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return $this->sendResponse($product, 'Product Successfully Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->authorize('isAsdmin');

        $product = Product::findOrFail($id);

        $product->delete();

        return $this->sendResponse($product, 'Product has been deleted');
    }

    //upload
    public function upload(Request $request)
    {
        $img = $request->file->store('public/upload');

        return $this->sendResponse($img, 'Success');

    }
}
