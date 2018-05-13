<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class HomeController extends Controller
{
    public function index(){
      $products = Product::all();
      // Select * from product

      return view('user.index', compact('products'));

    }

    public function about_us(){
      return view('user.about_us');
    }
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
    
>>>>>>> eec3e5d95b9df1853a25384c1bc3ea7028b17892
>>>>>>> fed50c7433b1256d7e360915d537d24c90f52e41
>>>>>>> 71c1da81f242926209739fee17759cb3fef58460
    public function products(){
      $products = Product::all();
        return view('user.products', compact('products'));

    }
    public function product(Product $product){
      $products = Product::all();
      return view('user.product', compact('products'), compact('product'));

    }
    // public function men(){
    //   select from product where(category_id=2);
    //
    //   $men = Product::all()
    //   return view('user.men', compact('men'));
    // }
    public function whatsnew(){

      $products = Product::all();
      return view('user.whatsnew', compact('products'));


    }
    public function bestsellers(){
      return view('user.bestsellers');

    }
    public function men(Product $product){
      $products = Product::all();
      return view('user.men', compact('products'));

    }
    public function women(){
      $products = Product::all();
      return view('user.women',  compact('products'));

    }
    public function children(){
      return view('user.children');

    }
    public function shipping(){
      return view('user.shipping');

    }
    public function sale(){
      return view('user.sale');

    }

}
