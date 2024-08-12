<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
//use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;

class adminController extends Controller
{



    public function view_category()
    {
    $data=Category::paginate();
        return view('admin.category',compact('data'));
    }
    public function add_category(Request $request)
    {
        // $data=new Category;
        // $data->category_name=request('category');
        // $data->save();
        $data=Category::create([
            'category_name'=>$request->category
        ]);
        return redirect()->back()->with('message','Category added successfully',compact('data'));
    }

    public function delete_category($id)
    {
        $data=Category::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('message','Category deleted');
    }

    public function view_product()
    {
    $categories=Category::paginate();
        return view('admin.product',compact('categories'));
    }

    public function add_product(Request $request){

        $product=new Product();
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount_price;
        $product->category=$request->category;
        // if($request->hasfile('image')){
        //     $file=$request->file('image');
        //     $extension=$file->getClientOriginalExtension();
        //     $filename=time().'.'.$extension;
        //     $file->move('uploads/product/',$filename);
        //     $product->image=$filename;
        // }

        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image=$imagename;

        $product->save();
        return redirect()->back()->with('message','Product added successfully');

    }

    public function show_product(){
    $products=Product::all();
        return view('admin.show_product',compact('products'));
    }

    public function delete_product($id){
        $product=Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('message','Product deleted');
    }

    public function update_product($id){
        $products=Product::find($id);

        $categories=Category::all();

    return view('admin.update_product',compact('products','categories'));
}

public function update_product_confirm(Request $request,$id){

    $products=Product::find($id);
    $products->title=$request->title;
        $products->description=$request->description;
        $products->price=$request->price;
        $products->quantity=$request->quantity;
        $products->discount_price=$request->discount_price;
        $products->category=$request->category;
        // if($request->hasfile('image')){
        //     $file=$request->file('image');
        //     $extension=$file->getClientOriginalExtension();
        //     $filename=time().'.'.$extension;
        //     $file->move('uploads/product/',$filename);
        //     $product->image=$filename;
        // }

        $image=$request->image;
        if($image){
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $products->image=$imagename;
        }
        $products->save();

    return redirect()->route('show_product')->with('message','Product updated successfully');
}

public function order(){
$orders=Order::all();

    return view('admin.order',compact('orders'));
}
public function delivered($id){
    $order=Order::find($id);
    $order->delivery_status='delivered';
    $order->payment_status='paid';
    $order->save();
    return redirect()->back();
}

public function print_pdf($id){
$order=Order::find($id);
$pdf=PDF::loadView('admin.pdf',compact('order'));
return $pdf->download('order_details.pdf');
}

public function send_email($id){

    $order=Order::find($id);
    return view('admin.send_email',compact('order'));

    }

    public function send_user_email(Request $request,$id){
        $order=Order::find($id);

        $details=[
        'greeting'=>$request->greeting,
        'firstline'=>$request->firstline,
        'body'=>$request->body,
        'button'=>$request->button,
        'url'=>$request->url,
        'lastline'=>$request->lastline

        ];
        Notification::send($order,new SendEmailNotification($details));


    }


    public function search(Request $request){
        $search=$request->search;
        $orders=Order::where('name','like',"%$search%")->orWhere('phone','like',"%$search%")->get();
        return view('admin.order',compact('orders'));
    }
}
