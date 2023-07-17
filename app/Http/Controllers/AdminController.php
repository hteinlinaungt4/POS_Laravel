<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class AdminController extends Controller
{
    //changepassword page
    function changepasswordpage(){
        return view('admin.changepassword');
    }


    // changepassword
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

    // Detail Account
    function accountpage(){
        return view('admin.account');
    }

    // detail Account edit
    function accountedit(){
        return view('admin.accountedit');
    }

    // Account Update
    function accountupdate(Request $request){
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
        return redirect()->route('account#page');
    }

    // Admin Accounts
    function list(){
        $admin=User::when(request('search'),function($p){
            $key=request('search');
            $p->where('role','admin')->orwhere('name','like','%'.$key.'%');
            $p->where('role','admin')->orwhere('email','like','%'.$key.'%');
            $p->where('role','admin')->orwhere('address','like','%'.$key.'%');
            $p->where('role','admin')->orwhere('phone','like','%'.$key.'%');
        })->where('role','admin')
        ->orderBy('created_at','desc')->paginate(2);
        return view('admin.adminaccounts.list',compact('admin'));
    }

    // User Account list
    function userlist(){
        $users=User::where('role','user')->get();
        return view('admin.userlist.userlist',compact('users'));
    }

    // edit
    function change($id){
        $admin=User::where('id',$id)->first();
        return view('admin.adminaccounts.detail',compact('admin'));
    }
    // update
    function update(Request $request){
        $data=[
            'role'=>$request->role,
        ];
        $id=$request->id;
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    // Delete
    function delete($id){
        $oldimg=User::select('image')->where('id',$id)->first()->toArray();
        $oldimg=$oldimg['image'];
        if(Auth::user()->image != null){
            Storage::delete('public/'.$oldimg);
        }
        User::where('id',$id)->delete();
        return back();
    }
    // contact
    function contact(){
        $contacts=Contact::get();
        return view('admin.contact.contact',compact('contacts'));
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
