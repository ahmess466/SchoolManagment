<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function list(Request $request) // Use dependency injection for the Request object
    {
        $data['getRecord'] = User::getStudent();
        // Prepare data for the view
        $data['header_title'] = 'Student List';

        // Pass data and users to the view
        return view('admin.student.list', $data);
    }


    public function add()
    {

        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Add New Student';
        return view('admin.student.add', $data);
    }
    public function insert(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users|max:50',
            'hieght' => 'required|numeric|min:1', // Adjusted "min" to 1 for realistic height values
            'wieght' => 'required|numeric|min:1', // Adjusted "min" to 1 for realistic weight values
            'class_id' => 'required',
            'name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'roll_number' => 'nullable|numeric', // Made 'roll_number' nullable and validated as numeric
            'caste' => 'nullable|max:50', // Made 'caste' nullable
            'admission_number' => 'required|numeric',
            'gender' => 'required',
            'date_of_birth' => 'required|date', // Added 'date' validation to ensure proper date format
            'status' => 'required',
            'admission_date' => 'required|date', // Added 'date' validation for proper date format
            'blood_group' => 'required|max:10', // Fixed validation for required blood group
            'mobile_number' => 'required|numeric|digits:11', // Used 'digits:11' for ensuring exact 11 digits






        ]);


        $student = new User();
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) {
            $student->date_of_birth = trim($request->date_of_birth);
        }
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr . '.' . $ext);
            $file->move('upload/profile/', $filename);

            $student->profile_pic = $filename;
        }

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        if (!empty($request->admission_date)) {
            $student->admission_date = trim($request->admission_date);
        }
        $student->blood_group = trim($request->blood_group);
        $student->hieght = trim($request->hieght);
        $student->wieght = trim($request->wieght);

        $student->status = trim($request->status);
        $student->user_type = 3;


        $student->email = trim($request->email);
        $student->password = hash::make($request->password);
        $student->save();
        return redirect()->route('admin.student.list')->with('success', 'Student Added Succesfully');
    }
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        $data['getClass'] = ClassModel::getClass($id);
        $data['header_title'] = ' Edit Student List';

        return view('admin.student.edit', $data);
    }
    public function update($id, Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'hieght' => 'required|numeric|min:1', // Adjusted "min" to 1 for realistic height values
            'wieght' => 'required|numeric|min:1', // Adjusted "min" to 1 for realistic weight values
            'class_id' => 'required',
            'name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'roll_number' => 'nullable|numeric', // Made 'roll_number' nullable and validated as numeric
            'caste' => 'nullable|max:50', // Made 'caste' nullable
            'admission_number' => 'required|numeric',
            'gender' => 'required',
            'date_of_birth' => 'required|date', // Added 'date' validation to ensure proper date format
            'status' => 'required',
            'admission_date' => 'required|date', // Added 'date' validation for proper date format
            'blood_group' => 'required|max:10', // Fixed validation for required blood group
            'mobile_number' => 'required|numeric|digits:11', // Used 'digits:11' for ensuring exact 11 digits





        ]);

        $student = User::getSingle($id);

        // Update student details
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        $student->date_of_birth = !empty($request->date_of_birth) ? trim($request->date_of_birth) : $student->date_of_birth;

        // Handle Profile Picture upload and deletion of old photo
        if ($request->hasFile('profile_pic')) {
            // Delete old photo if it exists
            if ($student->profile_pic && file_exists(public_path('/upload/profile/' . $student->profile_pic))) {
                unlink(public_path('upload/profile/' . $student->profile_pic)); // Deletes the old file
            }

            // Upload the new photo
            $file = $request->file('profile_pic');
            $ext = $file->getClientOriginalExtension();
            $fileName = strtolower(date('Ymdhis') . Str::random(30)) . '.' . $ext;

            // Store the file publicly
            $file->move('upload/profile/', $fileName);
            // Save the new file name
            $student->profile_pic = $fileName;
        }


        // Update other fields
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->admission_date = !empty($request->admission_date) ? trim($request->admission_date) : $student->admission_date;
        $student->blood_group = trim($request->blood_group);
        $student->hieght = trim($request->hieght);
        $student->wieght = trim($request->wieght);
        $student->status = trim($request->status);

        // Update email if changed
        if ($request->email !== $student->email) {
            $student->email = trim($request->email);
        }

        // Update password only if provided
        if ($request->password) {
            $student->password = bcrypt($request->password);
        }

        // Save the student record
        $student->save();

        // Redirect back with success message
        return redirect()->route('admin.student.list')->with('success', 'Student Updated Successfully');
    }
    public function delete($id){
        $delete = User::getSingle($id);
        $delete->is_delete = 1 ;
        $delete->save();
        return redirect()->route('admin.student.list')->with('success','Student Deleted Successfully');

    }
}
