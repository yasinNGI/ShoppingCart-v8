<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
     *      tags={"Product Api's"},
     *      summary="Enter fake products through faker",
     *      description="Fake Products",
     *
     *      @OA\Parameter(
     *      name="counter",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *          )
     *      ),
     *
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
     *      tags={"Product Api's"},
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

    /**
     * @OA\Post(
     *      path="/product/store",
     *      operationId="AddProduct",
     *      tags={"Product Api's"},
     *      summary="Add Product",
     *      description="Returns Success after product creation",
     *
     *      @OA\Parameter(
     *      name="product_title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *      name="product_price",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *      name="product_desc",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *          )
     *      ),
     *
     *     @OA\Parameter(
     *      name="product_image",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="file"
     *          )
     *      ),
     *
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

            return response()->json(['flag' => 'success', 'message' => 'Product created successfully!'], 200);

        }catch (\Throwable $ex){
            \Sentry\captureException($ex);
            return response()->json(['flag' => 'failed', 'message' => "Exception : " . $ex->getMessage()], 422);
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

    /**
     * @OA\Post(
     *      path="/product/update/{id}",
     *      operationId="updateProduct",
     *      tags={"Product Api's"},
     *      summary="Add Product",
     *      description="Returns Success after product creation",
     *
     *      @OA\Parameter(
     *      name="product_title",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *      name="product_price",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *      name="product_desc",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *          )
     *      ),
     *
     *     @OA\Parameter(
     *      name="product_image",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="file"
     *          )
     *      ),
     *
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

            return response()->json(['flag' => 'success', 'message' => 'Product updated successfully!'], 200);

        }catch (\Exception $ex){
            return response()->json(['flag' => 'failed', 'message' => "Exception : " . $ex->getMessage()], 422);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Delete(
     *      path="/product/delete/{id}",
     *      operationId="DeleteProduct",
     *      tags={"Product Api's"},
     *      summary="Delete product by id",
     *      description="Delete product according your given id",
     *
     *      @OA\Parameter(
     *      name="id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *          )
     *      ),
     *
     *
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

    public function destroy($id)
    {
        try{
            Product::deleteProduct($id);
            return response()->json(['flag' => 'success', 'message' => 'Product deleted successfully!'], 200);
        }catch (\Exception $ex){
            return response()->json(['flag' => 'failed', 'message' => "Exception : " . $ex->getMessage()], 422);
        }
    }





    /**
     * Remove the specified resources from storage.
     *
     * @param $limit - how much want to delete the records.
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/product/delete-records/{limit}",
     *      operationId="truncateProduct",
     *      tags={"Product Api's"},
     *      summary="Delete random product",
     *      description="Delete random products according your given limit",
     *
     *      @OA\Parameter(
     *      name="limit",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *          )
     *      ),
     *
     *
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

    public function destroyRecords($limit){
        Product::deleteProducts($limit);

        return response()->json(['flag' => 'success', 'message' =>  " Random ".$limit." records has been deleted."], 200);
    }
}
