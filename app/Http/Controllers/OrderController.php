<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //orderlist
    function orderlist(){
        $order=Order::select('orders.*','users.name as username')
        ->leftjoin('users','orders.user_id','users.id')
        ->orderBy('created_at','desc')
        ->get();
        return view('admin.order.list',compact('order'));
    }
    // filter
    function orderstatusfilter(Request $request){
        $order=Order::select('orders.*','users.name as username')
        ->leftjoin('users','orders.user_id','users.id');
        if($request->status == null){
            $order = $order->get();
        }else{
            $order= $order->where('orders.status',$request->status)->get();
        }
        return view('admin.order.list',compact('order'));
    }

    // orderdetail
    function orderdetail($code){
        $order=OrderList::select('order_lists.*','users.name as username','products.name as pname','products.image as pimage')
        ->where('orderCode',$code)
        ->leftjoin('users','order_lists.user_id','users.id')
        ->leftjoin('products','order_lists.product_id','products.id')
        ->get();
        $totalorder=Order::where('orderCode',$code)->get();
        return view('admin.order.orderdetail',compact('order','totalorder'));
    }
}
