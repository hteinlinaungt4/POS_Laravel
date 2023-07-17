<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //Product
    function productdata(Request $request){
        if($request->status == 'asc'){
            $data=Product::orderBy('created_at','asc')->get();
        }else if($request->status == 'desc'){
            $data=Product::orderBy('created_at','desc')->get();
        }
        return $data;
    }

    // cart
    function cart(Request $request){
        $data=$this->getData($request);
        Cart::create($data);
        $response=[
            'message' => 'create cart',
            'status' => 'success',
        ];
        return response()->json($response,200);

    }

    // order
    function order(Request $request){
        $total=0;
        foreach($request->all() as $item){
         $data=OrderList::create([
            'user_id' => $item['userid'],
            'product_id' => $item['productid'],
            'qty' => $item['qty'],
            'total' => $item['total'],
            'orderCode' => $item['ordercode'],
         ]);

         $total +=$data['total'];

        }
        Order::create(
            [
                'user_id' => Auth::user()->id,
                'orderCode' => $data['orderCode'],
                'total_price' => $total + 3000,
            ]
         );
         Cart::where('user_id',Auth::user()->id)->delete();



         $response=[
            'message' => 'success',
         ];
         return response()->json($response,200);
    }

    // clear cart
    function clearcart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }
    // remove cart
    function removecart(Request $request){
       Cart::where('id',$request->id)->delete();
    }

    // admin status
    function status(Request $request){
        $order=Order::select('orders.*','users.name as username')
        ->leftjoin('users','orders.user_id','users.id');
        if($request->data == null){
            $order = $order->get();
        }else{
            $order= $order->where('orders.status',$request->data)->get();
        }
        return response()->json($order,200);

    }
    // status update
    function statusupdate(Request $request){
        Order::where('id',$request->id)->update([
            'status' => $request->status
        ]);
    }

    // userrolechange
    function userrolechange(Request $request){
        User::where('id',$request->userid)->update([
            'role' => $request->role,
        ]);
        $response=[
            'message' => 'success',
        ];
        return response()->json($response,200);
    }

    // adminrolechange
    function adminrolechange(Request $request){
        User::where('id',$request->userid)->update([
            'role' => $request->role,
        ]);
        $response=[
            'message' => 'success',
        ];
        return response()->json($response,200);
    }

    // viewcount
    function viewcount(Request $request){
        $oldproduct=Product::where('id',$request->pizzaid)->first();
        $update=[
            'view_count' => $oldproduct->view_count + 1,
        ];
        Product::where('id',$request->pizzaid)->update($update);
    }

    // data
    private function getData($request){
        $data=[
            'user_id' => $request->userid,
            'product_id' => $request->pizzaid,
            'qty' => $request->count,
        ];
        return $data;
    }
}
