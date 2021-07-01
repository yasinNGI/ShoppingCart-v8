<?php

function custom_varDump($data){
    echo "<pre>";
    var_dump($data);
}

function custom_varDumpDie($data){
    echo "<pre>";
    var_dump($data);
    die;
}


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
