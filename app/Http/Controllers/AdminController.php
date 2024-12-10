<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function list(Request $request) // Use dependency injection for the Request object
    {
        // Query users where user_type is 1
        $users = User::where('user_type', 1);

        // Filter by email if provided in the request
        if (!empty($request->input('email'))) {
            $users = $users->where('email', 'like', '%' . $request->input('email') . '%');
        }
        if (!empty($request->input('name'))) {
            $users = $users->where('name', 'like', '%' . $request->input('name') . '%');
        }


        // Order and paginate results
        $users = $users->orderBy('id', 'desc')->paginate(10);

        // Prepare data for the view
        $data['header_title'] = 'Admin List';

        // Pass data and users to the view
        return view('admin.admin.list', array_merge($data, compact('users')));
    }


    public function add(){

        $data['header_title'] = 'Add New Admin';
        return view('admin.admin.add',$data);


    }
    public function insert(Request $request){
        $user = new User();
        $request->validate([
            'email' => 'required|email|unique:users'
        ]);
        $user->name =trim($request->name);
        $user->email =trim($request->email);
        $user->password =Hash::make($request->password);
        $user->user_type = 1 ;
        $user->save();
        return redirect('admin/admin')->with('success','Admin Created Succesfully');


    }
    public function edit($id)
    {
        // Find the user by ID or throw a 404 error if not found
        $user = User::findOrFail($id);

        // Prepare data for the view
        $data['header_title'] = 'Edit Admin';

        // Return the edit view with the user data
        return view('admin.admin.edit', $data, compact('user'));
    }

        public function update(Request $request,$id){
            $user = User::findOrFail($id);
            $request->validate([
                'email' => 'required|email|unique:users,email,'.$id
                ]);
            $user->name = trim($request->name);
            $user->email =trim($request->email);

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->update();


            return redirect('admin/admin')->with('success','Admin Updated Succesfully');
        }
        public function delete($id)
        {
            $user = User::find($id);

            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }

            $user->delete();

            return redirect('admin/admin')->with('success', 'User deleted successfully');
        }












}
