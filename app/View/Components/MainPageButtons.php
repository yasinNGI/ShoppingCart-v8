<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MainPageButtons extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $btnTextOne;
    public $btnTextTwo;
    public $btnUrlOne;
    public $btnUrlTwo;
    public $btnArr;

    public function __construct( $btnArr = [] )
    {
        $this->btnArr = $btnArr;

    }

//    public function __construct( $btnTextOne , $btnTextTwo ,$btnUrlOne ,$btnUrlTwo )
//    {
//        $this->btnTextOne = $btnTextOne;
//        $this->btnTextTwo = $btnTextTwo;
//        $this->btnUrlOne = $btnUrlOne;
//        $this->btnUrlTwo = $btnUrlTwo;
//    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.main-page-buttons')->with(['buttons' => $this->btnArr]);
    }
}
