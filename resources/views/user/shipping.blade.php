@extends('user.layouts.app')
@section('title', 'Omelas Shipping Page')


@section('main-content')

<div class="container-fluid about-us">
		<h2> Shipping Policy</h2>
	<div class="about-us-content">
		<div class="row">
			<div class="col-md-6">
			<img class="masked-img1 img-responsive" src="{{asset('omelas/img/shipping.jpg')}}">
		</div>
			<div class="col-md-5 col-sm-10">
				<p class="about-us-p">

Thank you for visiting and shopping at OMELAS. Following are the terms and
conditions that constitute our Shipping Policy.<br>
Domestic Shipping Policy
Shipment processing time <br>
All orders are processed within 2-3 business days. Orders are not shipped or delivered on
weekends or holidays.
If we are experiencing a high volume of orders, shipments may be delayed by a few days. Please
allow additional days in transit for delivery. If there will be a significant delay in shipment of your
order, we will contact you via email or telephone.
Update this section if your processing time exceeds 2-3 business days.

Shipping charges for your order will be calculated and displayed at checkout.



			</div>
		</div>
	</div>

<br><br><br><br><br><br>
<div class="about-us-content">
		<div class="row">
			<div class="offset-1"></div>
			<div class="col-md-5 col-sm-10">
				<p>

At OMELAS our aim is to offer you clothing that show you that we really care! Not only have we got the trendiest clothes, but we can also guarantee that they are of the finest quality.

We started as a small business in Uzbekistan, and our aim is to continue providing our customers with products that keep them happy, at prices that keep them happy.

Our customers are our top priority and through our products we work hard towards building long-lasting and meaningful relations with them.
			</div>
			<div class="col-md-6">
			<img class="masked-img2 img-responsive" src="{{asset('omelas/img/shipping2.jpg')}}">
		</div>


		</div>
	</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>


@endsection
