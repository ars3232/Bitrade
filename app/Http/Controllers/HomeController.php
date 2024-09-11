<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

use App\Models\Product;

use App\Models\User;

use App\Models\Cart;

use App\Models\Order;

use Stripe;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype','user')->get()->count();

        $product = Product::all()->count();

        $order = Order::all()->count();

        $delivered = Order::where('status','Delivered')->count();

        return view('admin.index', compact('user', 'product', 'order', 'delivered'));
    }

    public function home()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        }
        else
        {
            $count ='';
        }

        if(Auth::check())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        }



        return view('home.index', compact('product','count'));

    }

    public function login_home()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();

        }
        else
        {
            $count ='';
        }


        return view('home.index', compact('product','count'));
    }

    public function product_details($id)
    {
        $data = Product::find($id);

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        }
        else
        {
            $count ='';
        }


        return view('home.product_details', compact('data','count'));
    }
public function add_cart($id){

    $product = Product::find($id);
    $user = Auth::user();

    if (!$product || !$user) {
        return redirect()->back()->withErrors('Product or User not found.');
    }

    // Check if the product is already in the cart
    $cart = Cart::where('user_id', $user->id)->where('product_id', $id)->first();

    if ($cart) {
        // If product is already in the cart, just update the quantity and total price
        $cart->quantity += 1;
        $cart->total_price = $cart->quantity * $product->price;
    } else {
        // Otherwise, create a new cart entry
        $cart = new Cart;
        $cart->user_id = $user->id;
        $cart->product_id = $id;
        $cart->quantity = 1;
        $cart->total_price = $product->price;
    }

    $cart->save();
    toastr()->timeOut(10000)->closeButton()->addSuccess('Product Added to Cart Successfully');

    return redirect()->back();
}



public function mycart()
{
    if(Auth::id())
    {
        $user = Auth::user();
        $userid = $user->id;
        $count = Cart::where('user_id', $userid)->count();
        $cart = Cart::where('user_id', $userid)->get(); // Correct the variable name
        $totalValue = $cart->sum('total_price');
    }

    return view('home.mycart', compact('count', 'cart'));
}

public function delete_cart($id)
{
    $data = Cart::find($id);

    $data->delete();
    toastr()->timeOut(10000)->closeButton()->addSuccess('Product Removed from Cart Successfully');
    return redirect()->back();
}

public function confirm_order(Request $request)
    {
     $name = $request->name;

     $address = $request->address;

     $phone = $request->phone;

     $userid = Auth::user()->id;

     $cart = Cart::where('user_id',$userid)->get();

     foreach($cart as $carts)
      {
        $order = new Order;

        $order->profuct_id = $carts->product_id;

        $order->name = $name;

        $order->rec_address = $address;

        $order->phone = $phone;

        $order->user_id = $userid;

        $order->product_id = $carts->product_id;

        $order->total_price = $carts->total_price;

        $order->save();

}

$cart_remove = Cart::where('user_id', $userid)->get();

foreach($cart_remove as $remove)
{

    $data = Cart::find($remove->id);

    $data->delete();
}

return redirect()->back()->with('success', 'Order placed successfully!');

   }
   public function myorders()
   {
    $user = Auth::user()->id;

    $count = Cart::where('user_id', $user)->get()->count();

    $order = Order::where('user_id', $user)->get();

    return view('home.order',compact('count','order'));
   }

    // public function stripe($value = null)
   public function stripe($value)

   {
       return view('home.stripe', compact('value'));
   }
   /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request, $value)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from complete"
        ]);

        $name = Auth::user()->name;

        $phone = Auth::user()->phone;

        $address = Auth::user()->address;

        $userid = Auth::user()->id;

        $cart = Cart::where('user_id',$userid)->get();

        foreach($cart as $carts)
         {
           $order = new Order;

           $order->product_id = $carts->product_id;

           $order->name = $name;

           $order->rec_address = $address;

           $order->phone = $phone;

           $order->user_id = $userid;

           $order->payment_status = "paid";

           $order->product_id = $carts->product_id;

           $order->total_price = $carts->total_price;

           $order->save();

   }

   $cart_remove = Cart::where('user_id', $userid)->get();

   foreach($cart_remove as $remove)
   {

       $data = Cart::find($remove->id);

       $data->delete();
   }

   return redirect('mycart')->with('success', 'Order placed successfully!');
    }

    public function shop()
    {
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        }
        else
        {
            $count ='';
        }

        if(Auth::check())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        }



        return view('home.shop', compact('product','count'));

    }

    public function why()
    {


        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        }
        else
        {
            $count ='';
        }

        if(Auth::check())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        }



        return view('home.why', compact('count'));

    }

    public function testimonial()
    {


        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        }
        else
        {
            $count ='';
        }

        if(Auth::check())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        }



        return view('home.testimonial', compact('count'));

    }
    public function contact()
    {


        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;

            $count = Cart::where('user_id', $userid)->count();
        }
        else
        {
            $count ='';
        }

        if(Auth::check())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        }



        return view('home.contact', compact('count'));

    }

}
