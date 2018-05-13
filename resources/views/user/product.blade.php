@extends('user.layouts.app')
@section('title', 'Omelas Product Page')

@section('main-content')

<div class="container">
	<div class="row product-imgs">
		<div class="col-lg-6 col-md-12 col-sm-12">
			<div class="product-img img-responsive">
				<img src="{{url('images', $product->image)}}"
width="430" height="520"
				alt="product image" >
					<div class="row product-img-next">

		</div>
			</div>
		</div>


		<div class="col-lg-6 product-desc">
			<h3> {{$product->name}} </h3>
				<div class="col-md-6">
					<p class="price">$ {{$product->price}} </p>
				</div>

		<div class="row">
			<div class="col-lg-6 col-sm-12">
				<p>Choose the Size</p>
				  <select name="size" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
				      <option selected>Choose...</option>
				        <option value="1">Small</option>
				        <option value="2">Medium</option>
				        <option value="2">Large</option>
      			</select>

			</div>
		</div>

		<div class="product-color">
			<h4>Choose the color</h4>
			<a href=""><div class="col-md-2 color1"></div></a>
			<a href=""><div class="col-md-2 color2"></div></a>
			<a href=""><div class="col-md-2 color3"></div></a>
			<a href=""><div class="col-md-2 color4"></div></a>
			<a href=""><div class="col-md-2 color5"></div></a>
			<a href=""><div class="col-md-2 color6"></div></a>
		</div>
		<div class="row">

<div class="button_add_cart col-md-6">
				<a href="{{route('cart.addItem', $product->id)}}">
				<center><br><i class="fa fa-shopping-bag">
				</i> ADD TO CART</center></a>
</div>
<div class="offset-6">

</div>
</div>

	<br>
				<div class="product-details">
					<h4>Product Details</h4>
					<hr>
					<p>
{{$product->description}}
				</div>
				<div class="product-details">
					<h4>Delivery Information</h4>
					<hr>
					<p>
						At OMELAS our aim is to offer you clothing that show you that we really care! Not only have we got the trendiest clothes, but we can also guarantee that they are of the finest quality.

						We started as a small business in Uzbekistan, and our aim is to continue providing our customers with products that keep them happy, at prices that keep them happy.

						Our customers are our top priority and through our products we work hard towards building long-lasting and meaningful relations with them.
				</div>
				<div class="product-details social-icons">
					<h4>Share the product <div class="hider"><a href="">+</a></div></h4>

					<hr>
					<div class="hide-show">
					<p >
						<a href="facebook.com/"><i class="fa fa-facebook"></i></a>
						<a href="instagram.com/"><i class="fa fa-instagram"></i></a>
						<a href="twitter.com/"><i class="fa fa-twitter"></i></a>
						<a href="vk.com/"><i class="fa fa-vk"></i></a>
					</div>
				</div>
		</div>
	</div>
	<div class="products-section">
		<div class="header-h2">
				<h2>You MAY ALSO LIKE</h2>
			</div>
		<div class="row products" id="box2">
			@forelse($products->chunk(4) as $chunk)
		  @foreach($chunk as $products)

		<div class="product col-lg-3 col-md-4 col-sm-6 col-xs-12">
		  <a href="{{route('product',$products->id)}}"><figure><img src="{{url('images', $products->image)}}"
		    width="221" height="287"
		    class="img-responsive" ></figure>
		    <h3 class="title-of-item">{{$products->name}}
		    </h3>
		    <p class="price">${{$products->price}}</p>
		    @if($products->old_price > 0)
		    <p class="old-price">${{($products->old_price)}}</p>
		    @endif
		<!-- add 5$ to new price and becomes old price -->
		</div></a>

		    <!-- end for loop -->



		          @endforeach
		            @empty
		              <h2 align="center">Emtpy no products</h2>
		                @endforelse
</div>


<div class="row">
	<div class="img-big">
		<div class="card mb-3">
  <img src="{{url('images', $product->image)}}"
		width="500" height="auto"
		alt="Card image cap" class="img-responsive">
  <div class="card-body">
    <h5 class="card-title">{{$product->name}}</h5>
    <p class="card-text">{{$product->description}}</p>

  </div>


	</div>
</div>

	</div>

		</div>
	</div>
</div>


</div>
@endsection
