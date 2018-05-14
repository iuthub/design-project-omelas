<div class="container-fluid">
    <div class="row above-header">
      <div class=" col-lg-4 col-sm-6">
        <div class="logo " id="logo">
          <a href="{{route('omelas')}}">
            <img src='{{ asset('omelas/img/logo.png') }}' height="60"/>
          </a>
        </div>
      </div>
      <div class="offset-4"></div>

      <ul class="header-right  col-lg-4 col-sm-6 col-xs-12">


        <a href="{{route('products')}}"><i class="fa fa-product" ></i> Products</a></li>

        @guest
            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <li><a class="nav-link" href="{{ route('logout') }}">{{ __('Logout') }}</a></li>


                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>


        @endguest


        <li>
          <a href="{{route('cart.index')}}">
            <i class="fa fa-shopping-cart fa-2x" aria-hidden="true">
            </i>
            Cart
<span class="alert badge">
          {{Cart::count()}}
</span>
          </a>
        </li>
      </div>
    </div>
    <nav>
      <div class="navbar-header">
        <a class="navbar-brand" href="#"></a>
      </div>
      <nav class="navbar-effect">
        <ul>
          <li><a href="{{route('whatsnew')}}">What's New </a></li>
          <li><a href="{{route('men')}}">Men's</a></li>
          <li><a href="{{route('women')}}">Women's</a></li>
          <li><a href="{{route('children')}}">Children</a></li>
          <li><a href="{{route('shipping')}}">Shipping</a></li>
          <li><a href="{{route('about_us')}}">About us</a></li>
          <li><a href="{{route('sale')}}">Sale</a></li>
        </ul>
      </nav>
    </header>
  </div>
