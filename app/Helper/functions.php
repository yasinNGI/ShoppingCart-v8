<?php


function getCategoryName($id){
    $cat = '';
    if( $id == 'root' ){
        $cat = $id;
    }else{
        $category = \App\Models\Category::find($id);
        $cat = $category->name;
    }
    return $cat;
}
