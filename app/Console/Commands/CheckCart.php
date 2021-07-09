<?php

namespace App\Console\Commands;

use App\Mail\CartNotification;
use App\Models\Cart;
use App\Models\Options;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Config;

class CheckCart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:cart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cartData = Options::where(['key' => 'cart'])->first();
        Log::info( print_r( $cartData->value , true) );

        if( intval($cartData->value)  > 3 ){
            Log::info("Cart is not empty!");
           // Mail::to( "yasin@nextgeni.com" )->send(new CartNotification( $cartData->value ));
        }else{
           //Log::info("Cart is empty!");
        }
    }
}
