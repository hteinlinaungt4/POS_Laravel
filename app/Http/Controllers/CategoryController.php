<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //cat list
    function list(){
        $categories=Category::when(request('search'),function($cat){
            $key=request('search');
            $cat->where('name','like','%'.$key.'%')->get();
        })->orderBy('created_at','desc')->paginate(5);
        return view('admin.category.list',compact('categories'));
    }

    // cat create page
    function category(){
        return view('admin.category.create');
    }

    // create
    function create(Request $request){
        $this->Validation($request);
        $categoryData=$this->getData($request);
        Category::create($categoryData);
        return redirect()->route('category#list');

    }
    // Delete
    function delete($id){
        Category::where('id',$id)->delete();
        return back();
    }

     // edit page
    function edit($id){
        $category=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // update
    function update(Request $request){
        $id=$request->id;
        $this->Validation($request);
        $updatedata=$this->getData($request);
        Category::where('id',$id)->update($updatedata);
        return redirect()->route('category#list');

    }


    // Data
    private function getData($request) {
        $data=[
            'id'=>$request->id,
            'name' => $request->categoryName,
        ];
        return $data;
    }



    // Validate
    private function Validation($request){
        $validation=[
            'categoryName' => 'required|unique:categories,name,'.$request->id,
        ];
        Validator::make($request->all(),$validation)->validate();
    }


}
