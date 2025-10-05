<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
       // $this->middleware('auth')->except(['index' , 'show']);
        //$this->middleware('auth')->only(['create' , 'update' , 'edit' , 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5) ;
        return view ('products.index', compact('products')) 
        ->with('i', (request()->input('page',1) -1)*5 ); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // verify that user fill all the fileds
        $request->validate([
            'name'=> 'required' ,
            'details' => 'required',
            'image' => 'required | image |mimes:jpeg,png,svg,jpg,gif| max : 2048 ',
        ]);
        $input = $request->all();
        if ($image = $request->file('image')){
            $destinationPath ='images/';
            $productImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath , $productImage);
            $input['image'] = "$productImage";
        }
        Product::create($input);
        return redirect()->route('products.index')->with('Success','Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view ('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view ('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=> 'required' ,
            'details' => 'required',
        ]);
        $input = $request->all();
        if ($image = $request->file('image')){
            $destinationPath ='images/';
            $productImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath , $productImage);
            $input['image'] = "$productImage";
        } else {
            unset($input['image']);
        }
        $product->update($input);
        return redirect()->route('products.index')->with('Success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('Success','Product deleted successfully');
    }
}
