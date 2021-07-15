<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * Display product main page
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('Categories.main');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewAll(){

        try{
            $categories = Category::getAll();
            return view('categories.all')->with(['categories' => $categories]);
        }catch(\Exception $ex){
            custom_varDumpDie($ex->getMessage());
            return view('categories.all')->with(['categories' => [] , 'exception_error' => "Exception : " . $ex->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        $categories     = Category::all();
        $getCategoryTop = Category::where('status' , 1)->where('top', 1)->get();
        $getCategoryAll = Category::where('status' , 1 )
            ->orderby('id','asc')
            ->get()
            ->groupBy('parent');


        return view('categories.add')->with([
            'categories' => $categories,
            'getCategoryTop' => $getCategoryTop,
            'getCategoryAll' => $getCategoryAll
        ]);
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
                'cat_name.required' => 'Category name is required!'
            ];

            $this->validate($request,[
                'cat_name' => 'required'
            ],$custom_msg);

            $res = Category::storeCategory($request);

            if( $res == true ){
                return redirect()->route('category_all')
                    ->with(toastr("Category created successfully!" , "success"));
            }else{
                return redirect()->back()
                    ->with(toastr("Category already exist!" , "error"));
            }

        }catch (\Exception $ex){
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

            $category       = Category::find($id);
            $categories     = Category::all();
            $getCategoryTop = Category::where('status' , 1)->where('top', 1)->get();
            $getCategoryAll = Category::where('status' , 1 )
                ->orderby('id','asc')
                ->get()
                ->groupBy('parent');

            return view('categories.edit')->with([
                'category'       => $category,
                'categories'     => $categories,
                'getCategoryTop' => $getCategoryTop,
                'getCategoryAll' => $getCategoryAll
            ]);

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
                'cat_name.required' => 'Category name is required!'
            ];

            $this->validate($request,[
                'cat_name' => 'required'
            ],$custom_msg);

            $res = Category::updateCategory($request , $id);

            if( $res == true ){
                return redirect()->route('category_all')
                    ->with(toastr("Category updated successfully!" , "success"));
            }

        }catch (\Exception $ex){
            return redirect()->back()->with(['exception_error' => "Exception : " . $ex->getMessage()]);
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
            Category::deleteCategory($id);
            return redirect()->back()->with(toastr("Category deleted successfully!" , "success"));
        }catch (\Exception $ex){
            return redirect()->back()->with(['exception_error' => "Exception : " . $ex->getMessage()]);
        }
    }
}
