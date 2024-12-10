<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
   public function list(){
    $data['getRecord']= ClassModel::getRecord();
    $data['header_title'] = 'Class List';
    return view('admin.class.list',$data);
   }

 public function add(){
    $data['header_title'] = 'Add New Class';
    return view('admin.class.add',$data);
 }
 public function insert(Request $request ){
    $class = new ClassModel();
    $class->name = $request->name;
    $class->status = $request->status ;
    $class->created_by = Auth::user()->id ;
    $class->save();
    return redirect()->route('admin.class')->with('success','Class Added Successfully');



 }
// Edit method
public function edit($id)
{
    $data['getRecord'] = ClassModel::getSingle($id); // Using findOrFail to ensure the record exists
    $data['header_title'] = 'Edit Class';
    return view('admin.class.edit', $data);
}

// Update method
public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|in:0,1',  // Ensure status is either 0 or 1
    ]);

    // Retrieve the class record
    $save = ClassModel::getSingle($id);

    // Update fields
    $save->name = $request->name;
    $save->status = $request->status;

    // Save the updated record
    $save->save();

    // Redirect with success message
    return redirect()->route('admin.class')->with('success', 'Class Updated Successfully');
}

 public function delete($id){
    $delete = ClassModel::getSingle($id);
    $delete->is_delete = 1 ;
    $delete->save();
    return redirect()->route('admin.class')->with('success','Class Deleted Successfully');


 }
}
