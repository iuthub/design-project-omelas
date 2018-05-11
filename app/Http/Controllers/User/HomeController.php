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
    public function products(){
      $products = Product::all();
        return view('user.products', compact('products'));

    }
    public function product(Product $product){
      return view('user.product', compact('product'));

    }
    // public function men(){
    //   select from product where(category_id=2);
    //
    //   $men = Product::all()
    //   return view('user.men', compact('men'));
    // }
    public function whatsnew(){
      return view('user.whatsnew');

    }
    public function bestsellers(){
      return view('user.bestsellers');

    }
    public function men(){
      return view('user.men');

    }
    public function women(){
      return view('user.women');

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
