<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Usercontroller extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_user'])->only('destroy');
    }

    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function ($query) use ($request){
            return  $query->when($request->search, function ($q) use ($request)
         {
             return $q->where('username' ,'like' ,'%'. $request->search . '%')
             ->orWhere('last_name' ,'like' ,'%'. $request->search . '%')
             ->orWhere('email','like','%'. $request->search.'%');

        });

        })->paginate(6);



        return view('dashboard.users.index',compact('users'));
    }


    public function create()
    {
        return view('dashboard.users.create',compact('users'));

    }


    public function store(Request $request)
    {
            $request->validate([

            'username' => 'required',
            'last_name' => 'required',
            'email' => ['required',Rule::unique('users')],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password',
            'permissions' => 'required|min:1'
        ]);

        $request_data = $request->except(['password','password_confirmation','permissions','image']);
        $request_data['password'] = bcrypt($request->password);

        if($request->image){

         $img_name = time(). '.' .$request->image->getClientOriginalExtension();
         }

        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        $user->image=$img_name;

        $request->image->move(public_path('uploads/users/'),$img_name);
        $request_data['image'] = RAND() . $request->image;
        $user->save();

        session()->flash('message',trans('site.add_success'));
       return redirect()->route('dashboard.users.index');
    }


    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));

    }


    public function update(Request $request, User $user)
    {
        $request->validate([

            'username' => 'required',
            'last_name' => 'required',
            'email' => ['required',Rule::unique('users')->ignore($user->id)],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'permissions' => 'required|min:1'

            ]);

         $request_data = $request->except(['permissions','image']);

       //  $img_name = rand() . '.' .$request->image->getClientOriginalExtension();

        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        if($request->hasFile('image')) {

            if($user->image != 'default.jpg') {
                Storage::disk('public_uploads')->delete('/users/' . $user->image);
            }

            $image = $request->file('image');
            $filename =  $image->getClientOriginalName();
            $image->move(public_path('uploads/users/'), $filename);
            $user->image = $request->file('image')->getClientOriginalName();
            $request_data['image'] = RAND() . $request->image;
        }
       /* $user->image=$img_name;
        $request->image->move(public_path('uploads/users/'),$img_name); */
        $user->save();


        session()->flash('message' ,'Edit Success');
       return redirect()->route('dashboard.users.index');

    }


    public function delete(User $user)
    {
        $user->delete();
        session()->flash('message' ,'Delete Success');
       return redirect()->route('dashboard.users.index');

    }
}
