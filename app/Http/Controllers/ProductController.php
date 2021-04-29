<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
        // $product = $this->product->create([
        //     'name' => $request->get('name'),
        //     'description' => $request->get('description'),
        //     'price' => $request ->get('price'),
        //     'category_id' => $request->get('category_id'),
        // ]);
        // $tag_ids = [];
        // foreach ($request->get('tags') as $tag) {
        //     $tag_ids[] = $tag['id'];
        // }
        // $product->tags()->sync($tag_ids);

        // return $thid->sendResponse($product, 'Product Successfully Created');
        $products = Product::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'category_id' => $request['category_id'],
        ]);

        return $this->sendResponse($products, 'Product Successfully Created');
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

        return $this->sendResponse($product, 'Prodect Details');
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
