<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function factory($counter){
        Product::runFactory($counter);
    }

    public function index()
    {
        return view('Product.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_all(){
        $products      = DB::table('products')->paginate(30);
        $cookie_data   = Cookie::get('cart');
        $cart_products = [];

        if(isset($cookie_data)){
            foreach (json_decode($cookie_data) as $key => $val ){
                $cart_products [] = $val->product_id;
            }
        }

//        foreach (Cart::all()  as $key => $val){
//            $cart_products [] = $val->product_id;
//        }

        return view('Product.all')->with(['products' => $products , 'cart_products' => $cart_products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $custom_msg = [
            'product_title.required' => 'Product Name is Required!'
        ];

        $this->validate($request,[
            'product_title' => 'required'
        ] , $custom_msg);

        Product::storeProduct($request);

        return redirect()->route('product_all')->with(toastr("Product created successfully!" , "success"));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('Product.edit')->with(['product' => $product]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $custom_msg = [
            'product_title.required' => 'Product Name is Required!'
        ];

        $request->validate([
            'product_title' => 'required'
        ] , $custom_msg);

        Product::updateProduct($request, $id);

        return redirect()->back()->with(toastr("Product updated successfully!" , "success"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::deleteProduct($id);
        return redirect()->back()->with(toastr("Product deleted successfully" , "success"));
    }

}
