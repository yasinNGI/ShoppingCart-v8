<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $message;
    public $alert;


    public function __construct( $alert , $type , $message )
    {
        $this->type = $type;
        $this->message = $message;
        $this->alert = $alert;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
