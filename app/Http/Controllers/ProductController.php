<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function makeFactory(){
       // Product::factory()->count(10000)->create();
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

        $products = DB::table('products')->paginate(30);
        //$products = Product::all();
        return view('Product.all')->with(['products' => $products]);
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


        $product = new Product();
        $product->title        = $request->product_title;
        $product->slug         = str_replace( ' ' , '-' , strtolower( $request->product_title ) );
        $product->description  = $request->product_desc;
        $product->status       = 1;
        $product->save();

        if( $request->hasFile('product_image') ){

            $folder_name         = 'products';
            $folder_product_slug = $product->slug.'_'.$product->id;
            $directory           = 'public/upload/'.$folder_name.'/'.$folder_product_slug.'/';
            Storage::makeDirectory($directory);

            $image_path = $request->file('product_image')->store('upload/'.$folder_name.'/'.$folder_product_slug , 'public');
            storage_path('app/public/upload/'.$folder_name.'/'.$folder_product_slug.'/').$image_path;

            Product::where(['id' => $product->id])->update([
                'image' => $image_path
            ]);
        }

        $noti = array("message" => "Product created successfully!");
        return redirect()->route('product_all')->with($noti);

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

        $product_pre_img = $request->product_old_image;
        $folder_name = 'product';
        $folder_product_slug = str_replace( ' ' , '-' , strtolower( $request->product_title ) );

        Product::where(['id' => $id])->update([
            'title' => $request->product_title,
            'slug' => str_replace( ' ' , '-' , strtolower( $request->product_title ) ),
            'description' => $request->product_desc,
            'image' => $request->file('product_image') ?  $request->file('product_image')->store('upload/'.$folder_name.'/'.$folder_product_slug , 'public') : $product_pre_img,
        ]);

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back();
    }
}
