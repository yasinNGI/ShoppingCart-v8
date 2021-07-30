<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Lwproduct extends Component
{

    use WithFileUploads;

    public $title , $description , $price , $image , $product_id , $old_image;
    public $updateMode = false;


    protected $listeners = [
        'deleteProduct'=>'destroy'
    ];

    public function alertSuccess($msg){
        $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => $msg]);
    }


    public function alertError($msg){
        $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => $msg]);
    }

    private function resetInputFields(){
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->image = '';
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function store(){

        $custom_msg = [
            'title.required' => 'Product Name is Required!',
            'price.required' => 'Product Price is Required!'
        ];

        $this->validate([
            'title' => 'required',
            'price' => 'required'
        ] , $custom_msg);

        try{
//            $product = Product::create([
//                'title'       =>  $this->title,
//                'slug'        =>  str_replace( ' ' , '-' , strtolower( $this->title ) ),
//                'description' =>  $this->description,
//                'price'       =>  $this->price,
//                'status'      =>  1,
//            ]);
//
//            $slug_ = str_replace( ' ' , '-' , strtolower( $this->title ) );


            custom_varDumpDie($this->image->file('image'));


//            if( $this->image->hasFile('image') ){
//
//                $folder_name         = 'products';
//                $folder_product_slug = $product->slug.'_'.$product->id;
//                $directory           = 'public/upload/'.$folder_name.'/'.$folder_product_slug.'/';
//                Storage::makeDirectory($directory);
//
//                $image_path = $this->image->file('image')->store('upload/'.$folder_name.'/'.$folder_product_slug , 'public');
//                storage_path('app/public/upload/'.$folder_name.'/'.$folder_product_slug.'/').$image_path;
//
//                Product::where(['id' => $product->id])->update([
//                    'image' => $image_path
//                ]);
//            }

            $this->alertSuccess("Product Created Successfully!");

            $this->resetInputFields();

        }catch (\Throwable $ex){
            //\Sentry\captureException($ex);
            $this->alertError($ex->getMessage());
            $this->resetInputFields();
        }
    }


    public function edit($id)
    {
        try{
            $product            = Product::findOrFail($id);
            $this->product_id   = $id;
            $this->title        = $product->title;
            $this->description  = $product->description;
            $this->price        = $product->price;
            $this->image        = $product->image;
            $this->updateMode   = true;
        }catch (\Exception $ex){
            $this->alertError($ex->getMessage());
        }
    }


    public function update(){

        try{
            $product_pre_img     = $this->old_image;
            $folder_name         = 'products';
            $folder_product_slug = str_replace( ' ' , '-' , strtolower( $this->title ) );

            Product::where(['id' => $this->product_id])->update([
                'title'          => $this->title,
                'slug'           => str_replace( ' ' , '-' , strtolower( $this->title ) ),
                'description'    => $this->description,
                'price'          => $this->price,
                // 'image'       => $this->file('image') ?  $this->file('image')->store('upload/'.$folder_name.'/'.$folder_product_slug , 'public') : $product_pre_img,
            ]);

            $this->alertSuccess('Product Updated Successfully!');
        }catch (\Exception $ex){
            $this->alertError($ex->getMessage());
        }

    }

    public function destroy($id){
        try{
            Product::find($id)->delete();
            $this->alertSuccess('Product Deleted Successfully!');
        }catch(\Exception $ex){
            $this->alertError($ex->getMessage());
        }
    }

    public function render()
    {
        $products      = Product::orderBy('id','desc')->paginate(10);
        return view('livewire.lwproduct' , ['products' => $products]);
    }
}
