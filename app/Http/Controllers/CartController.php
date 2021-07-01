<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request, $id)
    {
        if (!empty($request->status) && !empty($id)) {
            try {

                $qty = !empty($request->quantity) ? $request->quantity : 1;

                $cart = new Cart();
                $cart->product_id = $id;
                $cart->quantity = $qty;
                $cart->price = ($request->price * $qty);
                $cart->save();

                $count = count(Cart::all());

                return response()->json(['ok' => 'Product added in cart successfully ', 'count' => $count], 200);

            } catch (\Exception $ex) {
                return response()->json(["message" => $ex->getMessage()], 400);
            }

        } else {
            return response()->json(["message" => "Oops! Something went wrong!"], 400);
        }
    }

    public function remove(Request $request,$id){
        if (!empty($request->status) && !empty($id)) {

            try {

                DB::table('carts')->where(['product_id' => $id])->delete();
                $count = count(Cart::all());
                return response()->json(['ok' => 'Product removed in cart successfully ', 'count' => $count], 200);

            } catch (\Exception $ex) {
                return response()->json(["message" => $ex->getMessage()], 400);
            }

        } else {
            return response()->json(["message" => "Oops! Something went wrong!"], 400);
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
