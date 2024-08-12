<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index()
    {
        $products = Product::paginate(10);
        return view('home.userpage', compact('products'));
    }
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
        $total_products =Product::all()->count();
        $total_orders=Order::all()->count();
        $total_users=User::all()->count();
        $total_revenue=0;
        $orders=Order::all();
        foreach($orders as $order){
            $total_revenue=$total_revenue+$order->price;
        }

        $total_deliverd=Order::where('delivery_status','delivered')->get()->count();
        $total_processing=Order::where('delivery_status','processing')->get()->count();



            return view('admin.home',compact('total_products','total_orders','total_users','total_revenue','total_deliverd','total_processing'));
        } else {
            $products = Product::paginate(10);
            return view('home.userpage', compact('products'));
        }
    }
    public function product_details($id)
    {
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {

        if (Auth::id()) {
            $user = Auth::user();
            $product = Product::find($id);
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            if ($product->discount_price !== null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }


            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;

            $cart->save();
            return redirect()->back()->with('message', 'Product added to cart');
        } else {
            return redirect('login');
        }
    }

    public function show_cart()
    {

        if (Auth::id()) {
            $id = Auth::user()->id;
            $carts = Cart::where('user_id', $id)->get();
            //$carts = Cart::all();
            return view('home.show_cart', compact('carts'));
        } else {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message', 'Product removed from cart');
    }

    public function cash_order()
    {
        //move cart data to order table
        $user = Auth::user();
        $userid = $user->id;
        $data = Cart::where('user_id', $userid)->get();
        foreach ($data as $data) {
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back()->with('message', 'Product successfully orderd');
    }

    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request,$totalprice)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "thank you for payment"
        ]);

        $user = Auth::user();
        $userid = $user->id;
        $data = Cart::where('user_id', $userid)->get();
        foreach ($data as $data) {
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->payment_status = 'paid';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }


    public function show_order()
    {
        if (Auth::id()) {
            $user_id = Auth::user()->id;
            $orders = Order::where('user_id', $user_id)->get();
            return view('home.show_order', compact('orders'));
        } else {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'cancelled';
        $order->save();
        return redirect()->back();
    }




}
