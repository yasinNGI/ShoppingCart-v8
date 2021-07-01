<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name' , 'parent' , 'top' ,'status'];

    public static function getAll(){
        $categories = Category::all();
        return $categories;
    }

    public static function storeCategory($request){

        $parent_cat      = !empty($request->parent_category) ? $request->parent_category : 'root';
        $category_detail = Category::where(['name' => $request->cat_name])->where(['parent' => $parent_cat ])->get();
        $category_response = '';

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

            return $category_response = true;
        }else{
             return $category_response = false;
        }

    }

    public static function updateCategory($request , $id){

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

        return $res = true;
    }

    public static function  deleteCategory($id){
        $category = DB::table('categories')->where(['id' => $id])->delete();
    }

}
