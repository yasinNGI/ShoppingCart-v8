<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use mysql_xdevapi\Exception;

class ProductController extends Controller
{
    /**
     * Generate Fake Data
     *
     * @param $counter - {HOME_URL}/product/fake/10
     * @return \Illuminate\Http\Response
     */
    public function factory($counter){
        Product::runFactory($counter);
    }

    /**
     * Display product main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = [
            [
                "title" => "What is Lorem Ipsum?",
                "content" => "orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book"
            ],
            [
                "title" => "Why do we use it?",
                "content" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English"
            ]
        ];

        return view('Product.main' )->with(['posts' => $posts]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewAll(){

        try{

            $products      = Product::paginate(30);
            $cookie_data   = Cookie::get('cart');
            $cart_products = [];
            $table_cols    = ['Product','Price','Quantity','Action'];

            if(isset($cookie_data)){
                foreach (json_decode($cookie_data) as $key => $val ){
                    $cart_products [] = $val->product_id;
                }
            }

            return view('Product.all')->with([
                'products'       => $products ,
                'cart_products'  => $cart_products,
                'table_cols'     => $table_cols
            ]);

        }catch (\Exception $ex) {
            return view('Product.all')->with([
                'exception_error' => $ex->getMessage()
            ]);
        }

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
        try{

            $custom_msg = [
                'product_title.required' => 'Product Name is Required!',
                'product_price.required' => 'Product Price is Required!'
            ];

            $this->validate($request,[
                'product_title' => 'required',
                'product_price' => 'required'
            ] , $custom_msg);

            Product::storeProduct($request);

            return redirect()->route('product_all')->with(toastr("Product created successfully!" , "success"));

        }catch (\Throwable $ex){
            \Sentry\captureException($ex);
            return redirect()->back()->with(['exception_error' => "Exception : " . $ex->getMessage()]);
        }

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
        try{
            $product = Product::find($id);
            return view('Product.edit')->with(['product' => $product]);
        }catch (\Exception $ex){
            return redirect()->back()->with(['exception_error' => "Exception : " . $ex->getMessage()]);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{

            $custom_msg = [
                'product_title.required' => 'Product Name is Required!',
                'product_price.required' => 'Product Price is Required!'
            ];

            $this->validate($request,[
                'product_title' => 'required',
                'product_price' => 'required|numeric'
            ] , $custom_msg);

            $err = Product::updateProduct($request, $id);

            return redirect()->back()->with(toastr("Product updated successfully!" , "success"));

        }catch (\Exception $ex){
            return back()->with(['exception_error' => "Exception : " . $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Product::deleteProduct($id);
            return redirect()->back()->with(toastr("Product deleted successfully" , "success"));
        }catch (\Exception $ex){
            return back()->with(['exception_error' => "Exception : " . $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param $limit - how much want to delete the records.
     * @return \Illuminate\Http\Response
     */
    public function destroyRecord($limit){
        Product::deleteProducts($limit);

        $products      = Product::paginate(30);
        $cookie_data   = Cookie::get('cart');
        $cart_products = [];

        if(isset($cookie_data)){
            foreach (json_decode($cookie_data) as $key => $val ){
                $cart_products [] = $val->product_id;
            }
        }

        return view('Product.all')->with(['products' => $products , 'cart_products' => $cart_products]);
    }

    /**
     * Truncate product table.
     * Usage route -> product/truncate
     *
     * @return \Illuminate\Http\Response
     */
    public function truncate(){
        Product::truncateProductsTable();

        $products      = Product::paginate(30);
        $cookie_data   = Cookie::get('cart');
        $cart_products = [];

        if(isset($cookie_data)){
            foreach (json_decode($cookie_data) as $key => $val ){
                $cart_products [] = $val->product_id;
            }
        }

        return view('Product.all')->with(['products' => $products , 'cart_products' => $cart_products]);
    }

}
