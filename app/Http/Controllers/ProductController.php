<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Image;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::user()->id)->get();
        return view('admin.products.products', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_category' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
            'cost' => 'required',
        ]);

        $product = new Product;
        $product->product_category = $request['product_category'];
        $product->user_id = Auth::user()->id;
        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->cost = $request['cost'];

        if ($request->hasFile('image')) {

            // if(!empty($product->path)) {
            //     $file_path = "images/products/$user->path";
            //     unlink($file_path);
            // }

            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            
            $path = 'images/products/'.$filename;
            Image::make($image->getRealPath())->save($path);

            $product->path = $filename;
            $product->save();
            
        }

        return redirect('admin/products')->with('success', 'You just made a new product the called ' . $request['name'] . '');
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
