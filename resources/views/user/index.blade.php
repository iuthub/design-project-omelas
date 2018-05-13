@extends('user.layouts.app')
@section('title', 'index')
@section('main-content')

<section class="slider" id="box1" >
			<div class="container">
				<div class="homePage row">
					<p class="offset-1" ></p>
					<div class="text-homepage col-md-5 col-sm-7" >
						<h5>
						NEW COLLECTION
						</h5>
						<h1>
						Today's
						<br>
						Collection
						</h1>
						<p>Sed accumsan posuere eros quis placerat elit..</p>

						<a href="{{route('products')}}"> <button class="btn-effect">
						SHOP NOW</button></a>

					</div>
					<div class="homepage-img col-md-5 col-sm-5 ">
						<img src="{{asset('omelas/img/zara1.png') }}">
					</div>
				</div>
			</div>
		</section>





    <div class="products-section">
		<div class="header-h2">
				<h2>New Arrivials</h2>
			</div>


		<div class="row products" id="box2">
      <!-- //start for loop -->
      @forelse($products->chunk(4) as $chunk)
      @foreach($chunk as $product)
  <?php if ($product->category_id == 2): ?>
    <div class="product col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <a href="{{route('product',$product->id)}}"><figure><img src="{{url('images', $product->image)}}"
width="221" height="287"
      class="img-responsive" ></figure>
      <div class="star"><p><i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
        <i class="fa fa-star" aria-hidden="true"></i>
      </p>
    </div>
    <h3 class="title-of-item">{{$product->name}}
    </h3>
    <p class="price">${{$product->price}}</p>
    @if($product->old_price > 0)
      <p class="old-price">${{($product->old_price)}}</p>
    @endif
    <!-- add 5$ to new price and becomes old price -->
  </div></a>
  <?php endif; ?>
        <!-- end for loop -->



              @endforeach
                @empty
                  <h2 align="center">Emtpy no products</h2>
                    @endforelse


</div>
<button class="btn-effect load-more ">
						LOAD MORE
</button>
</div>

<section class="img-responsive" id="box3">
</section>



	<div class="header-h2">
				<h2>New Arrivials</h2>
			</div>
<div class="row products">
  @forelse($products->chunk(4) as $chunk)
  @foreach($chunk as $product)
    @if ($product->category_id == 1)
<div class="product first-product col-lg-3 col-md-4 col-sm-6 col-xs-12">
  <a href="{{route('product',$product->id)}}"><figure><img src="{{url('images', $product->image)}}"
  width="221" height="287"
    class="img-responsive" ></figure>
<div class="star"><p><i class="fa fa-star" aria-hidden="true"></i>
	<i class="fa fa-star" aria-hidden="true"></i>
	<i class="fa fa-star" aria-hidden="true"></i>
	<i class="fa fa-star" aria-hidden="true"></i>
	<i class="fa fa-star" aria-hidden="true"></i>
</p>
</div>
<h3 class="title-of-item">{{$product->name}}
</h3>
<p class="price">${{$product->price}}</p>
  @if($product->old_price > 0)
    <p class="old-price">${{($product->old_price)}}</p>
  @endif

</div></a>
@endif
      <!-- end for loop -->



            @endforeach
              @empty
                <h2 align="center">Emtpy no products</h2>
                  @endforelse



</div>



@endsection
