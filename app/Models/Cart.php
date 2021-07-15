<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = ['product_id', 'quantity', 'price'];


    public static function addItem($request, $id)
    {
        if (!empty($request->status) && !empty($id)) {
            $qty    = !empty($request->quantity) ? $request->quantity : 1;
            $count  = '';

            $get_cookie_cart_data = Cookie::get('cart');
            $time                 = time() + (86400 * 30);

            $cartItems = [];
            $items = [
                'product_id' => $id,
                'quantity' => $qty,
                'price' => $request->price * $qty,
            ];

            if(isset($get_cookie_cart_data)){
                $arr = json_decode($get_cookie_cart_data);
                array_push( $arr , $items );
                $count = count($arr);
                Cookie::queue('cart',  json_encode($arr) , $time);
                Options::add_option('cart',$count);
            }else{
                array_push($cartItems , $items);
                $count = count($cartItems);
                Cookie::queue('cart',  json_encode($cartItems) , $time);
                Options::add_option('cart',$count);
            }

            return response()->json(['ok' => 'Product added in cart successfully ', 'count' => $count], 200);

        } else {
            return response()->json(["message" => "Oops! Something went wrong!"], 400);
        }
    }


    public static function removeItem($request, $id)
    {
        if (!empty($request->status) && $request->status == "remove" && !empty($id)) {

            $count = '';

            $get_cookie_cart_data = Cookie::get('cart');
            $time                 = time() + (86400 * 30);

            if (isset($get_cookie_cart_data)) {
                $arr = json_decode($get_cookie_cart_data);

                foreach ($arr as $key => $val){
                    if($val->product_id == $id){
                        unset($arr[$key]);
                    }
                }
                $arr   = array_values($arr);
                $count = count($arr);
                Cookie::queue('cart',  json_encode($arr) , $time);
                Options::add_option('cart',count($arr));
            }

            if ( $request->ajax() ) {
                return response()->json(['ok' => 'Product removed from cart successfully!', 'count' => $count], 200);
            } else {
                return redirect()->back()->with(toastr("Product removed from cart successfully!" , "success"));
            }

        } else {
            if( !$request->ajax() ){
                return response()->json(["message" => "Oops! Something went wrong!"], 422);
            }else{
                return redirect()->back()->with(toastr("Oops! Something went wrong!" , "error"));
            }
        }
    }
}
