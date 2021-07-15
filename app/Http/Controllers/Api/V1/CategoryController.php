<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/category/all",
     *      operationId="viewAllcategory",
     *      tags={"Category Api's"},
     *      summary="Get all categories",
     *      description="Get all categoriess",
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
    public function viewAll(){

        try{
            $categories = Category::getAll();
            return response()->json(['flag' => 'success' ,'message' => 'All categories' ,'data' => $categories],200);
        }catch(\Exception $ex){
            custom_varDumpDie($ex->getMessage());
            return response()->json(['flag' => 'failed' ,'message' => "Exception : " . $ex->getMessage() ],200);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *      path="/category/store",
     *      operationId="addCategory",
     *      tags={"Category Api's"},
     *      summary="Add category",
     *      description="Returns Success after category creation",
     *
     *      @OA\Parameter(
     *      name="cat_name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *      name="parent_category",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="integer"
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
                'cat_name.required' => 'Category name is required!'
            ];

            $this->validate($request,[
                'cat_name' => 'required'
            ],$custom_msg);

            $res = Category::storeCategory($request);

            if( $res == true )
                return response()->json(['flag' => 'success' ,'message' => 'Category created successfully!'],200);
            else
                return response()->json(['flag' => 'failed' ,'message' => 'Category already exist!'],422);


        }catch (\Exception $ex){
            return response()->json(['flag' => 'failed' ,'message' => "Exception : " . $ex->getMessage()],422);
        }

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *      path="/category/update/{id}",
     *      operationId="updateCategory",
     *      tags={"Category Api's"},
     *      summary="Update category",
     *      description="Returns Success after category creation",
     *
     *      @OA\Parameter(
     *      name="id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *      name="cat_name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *          )
     *      ),
     *
     *      @OA\Parameter(
     *      name="parent_category",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="integer"
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
                'cat_name.required' => 'Category name is required!'
            ];

            $this->validate($request,[
                'cat_name' => 'required'
            ],$custom_msg);

            $res = Category::updateCategory($request , $id);

            if( $res == true ){
                return response()->json(['flag' => 'success' ,'message' => 'Category updated successfully!'],200);
            }

        }catch (\Exception $ex){
            return response()->json(['flag' => 'failed' ,'message' => "Exception : " . $ex->getMessage()],422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\delete(
     *      path="/category/delete/{id}",
     *      operationId="DeleteCategory",
     *      tags={"Category Api's"},
     *      summary="Delete category by id",
     *      description="Delete category according your given id",
     *
     *      @OA\Parameter(
     *      name="id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
            Category::deleteCategory($id);
            return response()->json(['flag' => 'success' , 'message' => 'Category deleted successfully!'],200);
        }catch (\Exception $ex){
            return response()->json(['flag' => 'failed' , 'message' => 'Exception : ' . $ex->getMessage()],422);
        }
    }
}
