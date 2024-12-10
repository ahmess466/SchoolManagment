<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParentController extends Controller
{
    public function list(Request $request) // Use dependency injection for the Request object
    {
        $data['getRecord'] = User::getParent();
        // Prepare data for the view
        $data['header_title'] = 'Parent List';

        // Pass data and users to the view
        return view('admin.parent.list', $data);
    }
    public function add()
    {

        $data['header_title'] = 'Add New Parent';
        return view('admin.parent.add', $data);
    }
    public function insert(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users|max:50',
            'name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'gender' => 'required',
            'status' => 'required',
            'mobile_number' => 'required|numeric|digits:11', // Used 'digits:11' for ensuring exact 11 digits
            'password' => 'required|min:6', // Used 'confirmed' for password
            'address' => 'required',
            'occupation' => 'required'






        ]);


        $parent = new User();
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->occupation = trim($request->occupation);
        $parent->address = trim($request->address);
        $parent->gender = trim($request->gender);

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr . '.' . $ext);
            $file->move('upload/profile/', $filename);

            $parent->profile_pic = $filename;
        }

        $parent->mobile_number = trim($request->mobile_number);



        $parent->status = trim($request->status);
        $parent->user_type = 4;


        $parent->email = trim($request->email);
        $parent->password = hash::make($request->password);
        $parent->save();
        return redirect()->route('admin.parent.list')->with('success', 'Parent Added Succesfully');
    }
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        $data['header_title'] = ' Edit Parent List';

        return view('admin.parent.edit', $data);
    }
    public function update(Request $request , $id){
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'gender' => 'required',
            'status' => 'required',
            'mobile_number' => 'required|numeric|digits:11', // Used 'digits:11' for ensuring exact 11 digits
            'address' => 'required',
            'occupation' => 'required'






        ]);


        $parent =  User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->occupation = trim($request->occupation);
        $parent->address = trim($request->address);
        $parent->gender = trim($request->gender);

        if ($request->hasFile('profile_pic')) {
            // Delete old photo if it exists
            if ($parent->profile_pic && file_exists(public_path('/upload/profile/' . $parent->profile_pic))) {
                unlink(public_path('upload/profile/' . $parent->profile_pic)); // Deletes the old file
            }

            // Upload the new photo
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $fileName = strtolower(date('Ymdhis') . Str::random(30)) . '.' . $ext;

            // Store the file publicly
            $file->move('upload/profile/', $fileName);
            // Save the new file name
            $parent->profile_pic = $fileName;
        }

        $parent->mobile_number = trim($request->mobile_number);



        $parent->status = trim($request->status);
        $parent->user_type = 4;


        $parent->email = trim($request->email);
        $parent->password = hash::make($request->password);
        $parent->save();
        return redirect()->route('admin.parent.list')->with('success', 'Parent Updated Succesfully');

    }
    public function delete($id){
        $delete = User::getSingle($id);
        $delete->is_delete = 1 ;
        $delete->save();
        return redirect()->route('admin.student.list')->with('success','Student Deleted Successfully');

    }

    public function myStudent($id) {
        $data['getParent'] = User::getSingle($id);

        $data['parent_id'] = $id;
        $data['getRecord'] = User::getMyStudent($id);
        $data['getSearchStudent'] = User::getSearchStudent();
        $data['header_title'] = 'Parent Student List';

        return view('admin.parent.student', $data);
    }

    public function AssignStudentParent($student_id, $parent_id) {
        $student = User::getSingle($student_id);
        $student->parent_id = $parent_id;
        $student->save();

        return redirect()->back()->with('success', 'Parent Successfully Assigned');
    }
    public function AssignStudentParentDelete($student_id){
        $student = User::getSingle($student_id);
        $student->parent_id = null;
        $student->save();
        return redirect()->back()->with('success', 'Parent Successfully UnAssigned');


    }

    }
