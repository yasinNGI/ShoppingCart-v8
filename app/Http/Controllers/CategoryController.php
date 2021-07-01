<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('Categories.main');
    }

    public function view_all(){
        $categories = Category::getAll();
        return view('categories.all')->with(['categories' => $categories]);
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
        $custom_msg = [
            'cat_name.required' => 'Category name is required!'
        ];

        $this->validate($request,[
            'cat_name' => 'required'
        ],$custom_msg);

        $res = Category::storeCategory($request);

        if( $res == true ){
            $noti = array("message" => "Category created successfully!");
            return redirect()->route('category_all')->with($noti);
        }else{
            $noti = array("error" => "Category already exist!");
            return redirect()->back()->with($noti);
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
            'cat_name.required' => 'Category name is required!'
        ];

        $this->validate($request,[
            'cat_name' => 'required'
        ],$custom_msg);

        $res = Category::updateCategory($request , $id);

        if( $res == true ){
            $noti = array("message" => "Category updated successfully!");
            return redirect()->route('category_all')->with($noti);
        }else{

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::findOrFail($id);
        $cat->delete();
        return redirect()->back();
    }
}
