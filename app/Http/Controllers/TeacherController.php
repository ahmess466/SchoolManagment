<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class TeacherController extends Controller
{
    public function list(Request $request) // Use dependency injection for the Request object
    {
        $data['getRecord'] = User::getTeacher();
        // Prepare data for the view
        $data['header_title'] = 'Teacher List';

        // Pass data and users to the view
        return view('admin.teacher.list', $data);
    }

    public function add()
    {

        // $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Add New Teacher';
        return view('admin.teacher.add', $data);
    }
    public function insert(Request $request)
{
    request()->validate([
        'email' => 'required|email|unique:users',
        'mobile_number' => 'max:15|min:8',
        'marital_status' => 'max:50',
    ]);

    $teacher = new User();
    $teacher->name = trim($request->name);
    $teacher->last_name = trim($request->last_name);
    $teacher->gender = trim($request->gender);
    $teacher->religion = trim($request->religion);


    if (!empty($request->date_of_birth)) {
        $teacher->date_of_birth = trim($request->date_of_birth);
    }

    if (!empty($request->admission_date)) {
        $teacher->admission_date = trim($request->admission_date);
    }

    if (!empty($request->file('profile_pic'))) {
        $ext = $request->file('profile_pic')->getClientOriginalExtension();
        $file = $request->file('profile_pic');
        $randomStr = 'whdis' . Str::random(20);
        $filename = strtolower($randomStr) . '.' . $ext;
        $file->move('upload/profile/', $filename);
        $teacher->profile_pic = $filename;
    }
    $teacher->marital_status = trim($request->marital_status);
    $teacher->address = trim($request->address);
    $teacher->mobile_number = trim($request->mobile_number);
    $teacher->permanent_address = trim($request->permanent_address);
    $teacher->qualification = trim($request->qualification);
    $teacher->work_experience = trim($request->work_experience);
    $teacher->note = trim($request->note);
    $teacher->status = trim($request->status);
    $teacher->email = trim($request->email);
    $teacher->password = Hash::make($request->password);
    $teacher->user_type = 2;
    $teacher->save();

    return redirect()->route('teacher.list')->with('success', "Teacher Successfully Created");


}
public function edit($id)
{
    $data['getRecord'] = User::getSingle($id);
    $data['header_title'] = ' Edit Teacher List';

    return view('admin.teacher.edit', $data);
}
public function update(Request $request, $id)
{
    request()->validate([
        'email' => 'required|email|unique:users,email,' . $id,
        'mobile_number' => 'max:15|min:8',
        'marital_status' => 'max:50',
    ]);

    $teacher = User::getSingle($id);
    $teacher->name = trim($request->name);
    $teacher->last_name = trim($request->last_name);
    $teacher->gender = trim($request->gender);
    $teacher->religion = trim($request->religion);

    if (!empty($request->date_of_birth)) {
        $teacher->date_of_birth = trim($request->date_of_birth);
    }

    if (!empty($request->admission_date)) {
        $teacher->admission_date = trim($request->admission_date);
    }

    // Handle Profile Picture
    if ($request->hasFile('profile_pic')) {
        if ($teacher->profile_pic && file_exists(public_path('/upload/profile/' . $teacher->profile_pic))) {
            unlink(public_path('upload/profile/' . $teacher->profile_pic));
        }

        $file = $request->file('profile_pic');
        $ext = $file->getClientOriginalExtension();
        $fileName = strtolower(date('Ymdhis') . Str::random(30)) . '.' . $ext;
        $file->move('upload/profile/', $fileName);
        $teacher->profile_pic = $fileName;
    }

    $teacher->marital_status = trim($request->marital_status);
    $teacher->address = trim($request->address);
    $teacher->mobile_number = trim($request->mobile_number);
    $teacher->permanent_address = trim($request->permanent_address);
    $teacher->qualification = trim($request->qualification);
    $teacher->work_experience = trim($request->work_experience);
    $teacher->note = trim($request->note);
    $teacher->status = trim($request->status);

    if ($request->email !== $teacher->email) {
        $teacher->email = trim($request->email);
    }

    if ($request->password) {
        $teacher->password = Hash::make($request->password);
    }

    $teacher->save();

    return redirect()->route('admin.teacher.list')->with('success', "Teacher Successfully Updated");
}
public function delete($id){
    $delete = User::getSingle($id);
    $delete->is_delete = 1 ;
    $delete->save();
    return redirect()->route('admin.teacher.list')->with('success','Teacher Deleted Successfully');

}


}
