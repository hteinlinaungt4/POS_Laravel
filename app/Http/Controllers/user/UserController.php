<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //home
    function home(){
        $category=Category::get();
        $product=Product::orderBy('created_at','desc')->get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $order=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart','order'));
    }
    // delete
    function delete($id){
        $oldimg=User::select('image')->where('id',$id)->first()->toArray();
        $oldimg=$oldimg['image'];
        if(Auth::user()->image != null){
            Storage::delete('public/'.$oldimg);
        }
        User::where('id',$id)->delete();
        return back();
    }

      // cat filter
      function filter($id){
        $cart=Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
        ->leftjoin('products','carts.product_id','products.id')
        ->where('carts.user_id',Auth::user()->id)->get();
        $category=Category::get();
        $order=Order::where('user_id',Auth::user()->id)->get();
        $product=Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        return view('user.main.home',compact('product','category','cart','order'));
    }

    function history(){
        $order=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.history',compact('order'));
    }

    // Changepasswordpage
    function changepasswordpage(){
        return view('user.password.change');
    }
    // ChangePassword
    function changepassword(Request $request){
        $this->ValidationCheck($request);
        $id=Auth::user()->id;
        $oldpassword=User::select('password')->where('id',$id)->first();
        $oldpassword=$oldpassword->password;
        if(Hash::check($request->oldpassword,$oldpassword)){
            $data=[
                'password' => Hash::make( $request->newpassword),
            ];
            User::where('id',$id)->update($data);
            Auth::logout();
            return redirect()->route('auth#loginPage');
        }else{
           return back()->with(['doesnot' => 'You are oldpassword does not match!']);
        }
    }
    // profile
    function profile(){
        return view('user.profile.profileedit');
    }

    //
    function profileedit(Request $request){
        $id=Auth::user()->id;
        $updateData=$this->getData($request);
        if ($request->hasFile('image')) {
            $oldimage=User::select('image')->where('id',$id)->first()->toArray();
            $oldimage=$oldimage['image'];
            if(Auth::user()->image != null){
                Storage::delete('public/'.$oldimage);
            }
            $fileName=uniqid().'_'.$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public',$fileName);
            $updateData['image']=$fileName;
        }
        User::where('id',$id)->update($updateData);
        return redirect()->route('userhome');
    }



    // pizza detail list
    function pizzalist($id){
        $pizza=Product::where('id',$id)->first();
        $pizzas=Product::all();
        return view('user.main.pizzadetail',compact('pizza','pizzas'));
    }

    // cart
    function cartpage(){
        $cart=Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
        ->leftjoin('products','carts.product_id','products.id')
        ->where('carts.user_id',Auth::user()->id)->get();
        $totalprice=0;
        foreach ($cart as $c) {
            $totalprice +=$c->product_price * $c->qty;
        }
        return view('user.cart.cart',compact('cart','totalprice'));
    }

     // validate
     private function ValidationCheck($request){
        $validation=[
            'oldpassword' => 'required|min:6|max:10',
            'newpassword'=> 'required|min:6|max:10',
            'comfirmpassword' => 'required|min:6|max:10|same:newpassword'
        ];
        Validator::make($request->all(),$validation)->validate();
    }

      // Data
      private function getData($request){
        $data=[
            'name' => $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'address'=> $request->address,
        ];
        return $data;

    }

}
