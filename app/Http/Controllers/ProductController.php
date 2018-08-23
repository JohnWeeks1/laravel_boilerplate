<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ProductMail;
use App\Product;
use Image;
use Mail;
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
        $products = Product::where('user_id', Auth::user()->id)->paginate(20);
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
        $product = Product::find($id);
        return view('admin.products.edit_product', [
            'product' => $product
        ]);
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
        $request->validate([
            'product_category' => 'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'cost' => 'required',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {

            if(!empty($product->path)) {
                $file_path = "images/products/$product->path";
                unlink($file_path);
            }

            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            
            $path = 'images/products/'.$filename;
            Image::make($image->getRealPath())->save($path);

            $product->path = $filename;
            
        }

        $product->update($request->all());

        return redirect('admin/products')->with('success', 'You just updated the product called ' . $request['name'] . '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('admin/products')->with('success', 'You just deleted a product');
    }

    public function product_by_category($id)
    {
        $products = Product::where('product_category', $id)->paginate(15);
        return view('products.product_by_category', [
            'products' => $products
        ]);
    }

    public function product($id)
    {
        $product = Product::find($id);
        return view('products.product_by_id', [
            'product' => $product
        ]);
    }

    public function send_email(Request $request)
    {   
        Mail::to(
            $request->input('email'))
            ->send( new ProductMail(
            $request->input('email_message')
        ));

        return redirect()->back()->with('success', 'You just sent an email');
    }
}
