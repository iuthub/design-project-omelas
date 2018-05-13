@extends('user.layouts.app')
@section('title', "Omelas Women's Page")

@section('main-content')
<h2>Women's page</h2>


<div class="products-section">



<div class="row products" id="box2">
  <!-- //start for loop -->
  @forelse($products->chunk(4) as $chunk)
  @foreach($chunk as $product)
<?php if ($product->category_id == 2): ?>
<div class="product col-lg-3 col-md-4 col-sm-6 col-xs-12">
  <a href="{{route('product',$product->id)}}"><figure><img src="{{url('images', $product->image)}}"
    width="221" height="287"
    class="img-responsive" ></figure>
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
        <center>LOAD MORE</center>
</button>
</div>
@endsection
