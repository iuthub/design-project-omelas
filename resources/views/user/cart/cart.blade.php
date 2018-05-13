@extends('user.layouts.app')

@section('main-content')
<div class="bg-light">
 <div class="container">
<h3>Cart Items</h3>
<table class="table table-hover">
           <thead>
           <tr>
               <th>Name</th>
               <th>Price</th>
               <th>qty</th>
               <th>size</th>
               <th>Action</th>
           </tr>
           </thead>
           <tbody>
           @foreach($cartItems as $cartItem)
               <tr>
                   <td>{{$cartItem->name}}</td>
                   <td>{{$cartItem->price}}</td>
                   <td width="50px">
                       {!! Form::open(['route' => ['cart.update',$cartItem->rowId], 'method' => 'PUT']) !!}
                       <input name="qty" type="text" value="{{$cartItem->qty}}">
                   </td>
                   <td>
                       <div > {!! Form::select('size', ['small'=>'Small','medium'=>'Medium','large'=>'Large'] , $cartItem->options->has('size')?$cartItem->options->size:'' ) !!}
                          </div>
                   </td>
                   <td>
                       <input style="float: left"  type="submit" class="button success small" value="Ok">
                       {!! Form::close() !!}

                       <form action="{{route('cart.destroy',$cartItem->rowId)}}"  method="POST">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                          <input class="button small alert" type="submit" value="Delete">
                        </form>
                   </td>
               </tr>
           @endforeach
           <tr>
               <td></td>
               <td>
                    Total Price: $  {{Cart::subtotal()}} <br>
               </td>
               <td>Items: {{Cart::count()}}
               </td>
               <td></td>
               <td></td>
           </tr>
           </tbody>
       </table>
       <a href="{{route('checkout.shipping')}}" class="btn btn-primary btn-lg btn-block col-md-6 cart-btn" type="submit">Checkout</a>

   </div>
 </div>
 </div>




@endsection
