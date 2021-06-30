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

        $categories = Category::all();
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

        $parent_cat      = !empty($request->parent_category) ? $request->parent_category : 'root';
        $category_detail = Category::where(['name' => $request->cat_name])->where(['parent' => $parent_cat ])->get();


        if( count($category_detail) == 0 ){

            $category = new Category();
            $category->name = $request->cat_name;
            $category->slug = str_replace( " " , "-" , strtolower($request->cat_name) );
            $category->parent = $parent_cat;
            $category->status = 1;

            if( !$request->parent_category ){
                $category->top = intval(1);
            }else{
                $category->top = intval(0);
            }
            $category->save();

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

        $parent_cat = !empty($request->parent_category) ? $request->parent_category : 'root';

        $cat_top = '';
        if( !$request->parent_category ){
            $cat_top = intval(1);
        }else{
            $cat_top = intval(0);
        }

        Category::where(['id' => $id])->update([
            'name' => $request->cat_name,
            'parent' => $parent_cat,
            'top' => $cat_top,
        ]);

        $noti = array("message" => "Category updated successfully!");
        return redirect()->route('category_all')->with($noti);
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
