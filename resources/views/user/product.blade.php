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
				        <option value="1">XL</option>
				        <option value="2">SXL</option>
				        <option value="2">XXL</option>
				        <option value="2">XXXL</option>
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

<div class="button_add_cart">
				<a href="{{route('cart.addItem', $product->id)}}">
				<center><br><i class="fa fa-shopping-bag">
				</i> ADD TO CART</center></a>
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
Pellentesque non ultrices nisi. Ut auctor, massa vel
hendrerit consectetur, augue mi vestibulum nibh, vitae ull elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut eni varius at arcu. Proin convallis varius sollicitudin.
Sed accumsan posuere eros quis placerat. Vestibulum sit amet malesuada elit. Quisque</p>
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
			<div class="product first-product col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<figure><img src="{{asset('omelas/img/new-arrival1.jpg') }}" class="img-responsive" ></figure>
				<div class="star"><p><i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
				</p>
			</div>
			<h3 class="title-of-item">Zara Collection Outwear
			</h3>
			<p class="price">$210</p>
			<p class="old-price">$328</p>
		</div>
		<div class="product col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<figure><img src="{{asset('omelas/img/new-arrival2.jpg') }}" class="img-responsive" ></figure>
			<div class="star"><p><i class="fa fa-star" aria-hidden="true"></i>
				<i class="fa fa-star" aria-hidden="true"></i>
				<i class="fa fa-star" aria-hidden="true"></i>
				<i class="fa fa-star" aria-hidden="true"></i>
				<i class="fa fa-star" aria-hidden="true"></i>
			</p>
		</div>
		<h3 class="title-of-item">
		Womens Collection Outwear
		</h3>
		<p class="price">$210</p>
		<p class="old-price">$328</p>
	</div>
	<div class="product col-lg-3 col-md-4 col-sm-6 col-xs-12">
	<figure><img src="{{asset('omelas/img/new-arrival3.jpg') }}" class="img-responsive" ></figure>
		<div class="star"><p><i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
			<i class="fa fa-star" aria-hidden="true"></i>
		</p>
	</div>
	<h3 class="title-of-item">
	Brand Clothing Collection</h3>
	<p class="price">$210</p>
	<p class="old-price">$328</p>
</div>
<div class=" product col-lg-3 col-md-4 col-sm-6 col-xs-12">
	<figure><img src="{{asset('omelas/img/new-arrival4.jpg') }}" class="img-responsive" ></figure>
	<div class="star"><p><i class="fa fa-star" aria-hidden="true"></i>
		<i class="fa fa-star" aria-hidden="true"></i>
		<i class="fa fa-star" aria-hidden="true"></i>
		<i class="fa fa-star" aria-hidden="true"></i>
		<i class="fa fa-star" aria-hidden="true"></i>
	</p>
</div>
<h3 class="title-of-item">
Outwear With Jacket
</h3>
<p class="price">$210</p>
<p class="old-price">$328</p>
</div>
</div>


<div class="row">
	<div class="img-big">
		<div class="card mb-3">
  <img class="card-img-top" src="{{asset('omelas/img/product2.jpg') }}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Green Hoodie examples</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. Is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longerThis content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Available 124</small></p>
  </div>
</div>
	<div class="card mb-3">
  <img class="card-img-top" src="{{asset('omelas/img/product2.jpg') }}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Green Hoodie examples</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. Is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longerThis content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Available 124</small></p>
  </div>
</div>
	<div class="card mb-3">
  <img class="card-img-top" src="{{asset('omelas/img/product2.jpg') }}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Green Hoodie examples</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. Is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longerThis content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Available 124</small></p>
  </div>
</div>

	</div>
</div>

	</div>

		</div>
	</div>
</div>


</div>
@endsection
