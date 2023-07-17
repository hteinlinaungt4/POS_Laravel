<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //list
    function list(){
        $product=Product::select('products.*','categories.name as category_name')
        ->when(request('search'),function($p){
            $key=request('search');
            $p->orwhere('products.name','like','%'.$key.'%');
            $p->orwhere('products.price','like','%'.$key.'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')->paginate(2);
        return view('admin.pizza.list',compact('product'));
    }

    // createpage
    function createpage(){
        $cat=Category::select('name','id')->get();
        return view('admin.pizza.create',compact('cat'));
    }

    // create
    function create(Request $request){
        $this->validation($request,'create');
        $pizza=$this->getData($request);
        if($request->hasFile('image')){
            $filename=uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/',$filename);
            $pizza['image']=$filename;
        }
        Product::create($pizza);
        return redirect()->route('product#list');
    }

    // detail
    function detail($id){
        $product=Product::where('products.id',$id)
        ->select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->first();
        return view('admin.pizza.detail',compact('product'));
    }

    // edit
    function edit($id){
        $category=Category::all();
        $product=Product::find($id)->first();
        return view('admin.pizza.edit',compact('product','category'));
    }

    // update
    function update(Request $request){
        $this->validation($request,'update');
        $updatedata=$this->getData($request);
        $id=$request->id;
        if($request->file('image')){
            $oldimage=Product::select('image')->where('id',$id)->first()->toArray();
            $oldimage=$oldimage['image'];
            Storage::delete('public/'.$oldimage);
            $fileName=uniqid().'__'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/',$fileName);
            $updatedata['image']=$fileName;
        }
        Product::where('id',$id)->update($updatedata);
        return redirect()->route('product#list');

    }

    // delete
    function delete($id){
        $oldimage=Product::select('image')->where('id',$id)->first()->toArray();
        $oldimage=$oldimage['image'];
        Storage::delete('public/'.$oldimage);
        Product::find($id)->delete();
        return redirect()->route('product#list')->with(['deleteMsg' => "You are deleted successfully!"]);
    }


    // data
    private function getData($request){
        $data=[
            'category_id'=>$request->category,
            'name'=>$request->pizzaName,
            'description'=>$request->description,
            'price'=>$request->price,
        ];
        return $data;
    }


    // Validation
    private function validation($request,$actions){
        $validation=[
            'pizzaName' => 'required|unique:products,name,'.$request->id,
            'category' =>'required',
            'description'=>'required',
            'price'=>'required',
        ];
        $validation['image']=$actions == 'create' ? 'required|mimes:jpg,jpeg,png|file' : 'mimes:jpg,jpeg,png|file';
        Validator::make($request->all(),$validation)->validate();
    }
}
