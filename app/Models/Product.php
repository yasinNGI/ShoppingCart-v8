<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['title', 'slug', 'description', 'image', 'status' , 'price'];


    public static function runFactory($counter){
        self::factory()->count($counter)->create();
    }


    public static function storeProduct($request){

        $product = self::create([
            'title'       =>  $request->product_title,
            'slug'        =>  str_replace( ' ' , '-' , strtolower( $request->product_title ) ),
            'description' =>  $request->product_desc,
            'price'       =>  $request->product_price,
            'status'      =>  1,
        ]);

        if( $request->hasFile('product_image') ){

            $folder_name         = 'products';
            $folder_product_slug = $product->slug.'_'.$product->id;
            $directory           = 'public/upload/'.$folder_name.'/'.$folder_product_slug.'/';
            Storage::makeDirectory($directory);

            $image_path = $request->file('product_image')->store('upload/'.$folder_name.'/'.$folder_product_slug , 'public');
            storage_path('app/public/upload/'.$folder_name.'/'.$folder_product_slug.'/').$image_path;

            self::where(['id' => $product->id])->update([
                'image' => $image_path
            ]);
        }

    }


    public static function updateProduct($request , $id){

        $product_pre_img     = $request->product_old_image;
        $folder_name         = 'products';
        $folder_product_slug = str_replace( ' ' , '-' , strtolower( $request->product_title ) );

        self::where(['id' => $id])->update([
            'title'       => $request->product_title,
            'slug'        => str_replace( ' ' , '-' , strtolower( $request->product_title ) ),
            'description' => $request->product_desc,
            'price'       => $request->product_price,
            'image'       => $request->file('product_image') ?  $request->file('product_image')->store('upload/'.$folder_name.'/'.$folder_product_slug , 'public') : $product_pre_img,
        ]);

    }


    public static function deleteProduct($id){
        self::where(['id' => $id])->delete();
    }


    public static function deleteProducts($limit){
        self::orderBy(rand(2,3000))->take($limit)->delete();
    }


    public static function truncateProductsTable(){
        self::truncate();
    }

}

