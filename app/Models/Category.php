<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name' , 'parent','slug', 'top' ,'status'];

    public static function getAll(){
        $categories = self::all();
        return $categories;
    }

    public static function storeCategory($request){

        $parent_cat      = !empty($request->parent_category) ? $request->parent_category : 'root';
        $category_detail = Category::where(['name' => $request->cat_name])->where(['parent' => $parent_cat ])->get();
        $category_response = '';

        if( count($category_detail) == 0 ){

            $category = self::create([
                'name'      => $request->cat_name,
                'slug'      => str_replace( " " , "-" , strtolower($request->cat_name) ),
                'parent'    => $parent_cat,
                'status'    => 1,
            ]);

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

        self::where(['id' => $id])->update([
            'name' => $request->cat_name,
            'parent' => $parent_cat,
            'top' => $cat_top,
        ]);

        return $res = true;
    }

    public static function  deleteCategory($id){
        $category = self::where(['id' => $id])->delete();
    }

}
