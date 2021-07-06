<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CustomDataTables extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $cols;
    public $products;
    public $other_data;
    public $page;

    public function __construct( $cols = [] , $products = [] , $other_data = [] , $page )
    {
        $this->cols = $cols;
        $this->products = $products;
        $this->other_data = $other_data;
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.custom-data-tables');
    }
}
