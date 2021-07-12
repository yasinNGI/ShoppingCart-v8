<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function test(){
        return response()->json(['flag' => 'success' , 'message' => "It's working!" ],200);
    }

    /**
     * Generate Fake Data
     *
     * @param $counter - {HOME_URL}/product/fake/10
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/product/fake",
     *      operationId="addFakeProducts",
     *      tags={"Products"},
     *      summary="Enter fake products through faker",
     *      description="Fake Products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function factory(Request $request)
    {
        if (empty($request->get('counter')))
            return response()->json(['flag' => 'failed', 'message' => 'Please set counter for fake data.'], 403);

        Product::runFactory($request->get('counter'));
        return response()->json(['flag' => 'success', 'message' => 'Fake data has been added.'], 200);
    }



    /**
     * @OA\Get(
     *      path="/product/all",
     *      operationId="getProductsList",
     *      tags={"Products"},
     *      summary="Get list of product",
     *      description="Returns list of products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function viewAll(){
        $data      = Product::all();
        $products  = [];

        foreach ($data as $key => $val){
            $products [$key]['title']          = $val->title;
            $products [$key]['slug']           = $val->slug;
            $products [$key]['description']    = $val->description;
            $products [$key]['price']          = $val->price;
            $products [$key]['status']         = $val->status;
            $products [$key]['created_at']     = $val->created_at;
            $products [$key]['deleted_at']     = $val->deleted_at;
        }

        return response()->json(['flag' => 'success' ,'message' => 'See all currently products' ,'data' => $products],200);

    }



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
    public function store(Request $request)
    {
        //
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
