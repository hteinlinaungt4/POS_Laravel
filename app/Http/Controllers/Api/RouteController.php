<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class RouteController extends Controller
{
    //userlists
    function userlists(){
        $data=User::all();
        return response()->json($data, 200);
    }

    // productlist
    function productlists(){
        $data=Product::all();
        return response()->json($data, 200);
    }

      // categorylist
      function categorylists(){
        $data=Category::all();
        return response()->json($data, 200);
    }
    // category create
    function categorycreate(Request $request){
        Category::create([
            'name' => $request->name,
        ]);
        $data=Category::get();
        return response()->json($data, 200);
    }
    // category delete
    function categorydelete(Request $request){
        $id=$request->id;
        $check=Category::where('id',$id)->first();
        if(isset($check)){
            Category::where('id',$id)->delete();

            return response()->json($check, 200);
        }
        $data=[
            'message' => 'data not found',
        ];
        return response()->json($data, 200);
    }

    // category update
    function categoryupdate(Request $request){
        $id=$request->id;
        $name=$request->name;
        $check=Category::where('id',$id)->first();
        if(isset($check)){
            Category::where('id',$id)->update([
                'name' => $name,
            ]);

            return response()->json($check, 200);
        }
        $data=[
            'message' => 'data not found',
        ];
        return response()->json($data, 200);
    }

    // product create
    function productcreate(Request $request){
        $updateData=$this->getData($request);
        $have=Product::where('id',$request->id)->first();
        if(isset($have)){
            Product::where('id',$request->id)->update($updateData);
        $data=[
            'message' => 'success',
        ];
        return response()->json($data, 200);
        }
        $data=[
            'message' => 'fail',
        ];
        return response()->json($data, 200);



    }

    // product data
   private function getData($request){
       $data=[
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
       ];
       return $data;
    }
}
