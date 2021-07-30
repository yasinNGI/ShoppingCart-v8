<?php

namespace App\Http\Controllers;

use App\Mail\CartNotification;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Sentry\Response;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id){

        $res = Cart::addItem($request ,$id);
        //Mail::to( Config::get("constant.ADMIN_EMAIL") )->send(new CartNotification($res));
        $res->throwResponse();
    }

    public function remove(Request $request,$id){

        $res = Cart::removeItem($request,$id);
        $res->throwResponse();


    }


    public function cartItems(){

       try{
           $get_cookie_date = Cookie::get('cart');
           $data            = json_decode($get_cookie_date);
           $products        = [];

           foreach ($data as $key => $val ){
               $products [] = Product::find( $val->product_id );
           }
           return view('Cart.all')->with(['products' => $products , 'data' => $data]);

       } catch (\Exception $ex){
            //custom_varDumpDie($ex->getMessage());
       }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
