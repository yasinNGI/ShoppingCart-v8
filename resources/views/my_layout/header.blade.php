<!-- Page Header -->
<nav class="bg-white border-b border-gray-100 custom-navbar">
    <div class="container">

        <div class="row">
            <div class="col-lg-3 py-1">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'E-Commerce') }}
                </a>
            </div>
            <div class="col-lg-9 py-2 text-right">
                <a href="{{route('cart_items')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Cart <span id="cart_item">({{count($cart)}})</span>
                </a>
            </div>
        </div>
    </div>

</nav>
