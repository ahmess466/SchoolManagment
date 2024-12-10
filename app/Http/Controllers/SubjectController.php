<?php

namespace App\Http\Controllers;

use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list(){
        $data['getRecord']= SubjectModel::getRecord();
        $data['header_title'] = 'Subject List';
        return view('admin.subject.list',$data);
       }
       public function add(){
        $data['header_title'] = 'Add Subject';
        return view('admin.subject.add',$data);
       }
       public function insert(Request $request){
        $save = new SubjectModel();
        $save->name = trim($request->name) ;
        $save->status = trim($request->status) ;
        $save->created_by = Auth::user()->id ;

        $save->type =trim($request->type) ;
        $save->save();
        return redirect()->route('admin.subject')->with('success','Subject Added Successfully');

       }
       public function edit($id){
        $data['getRecord']= SubjectModel::getSingle($id);
        $data['header_title'] = 'Edit Subject';
        return view('admin.subject.edit',$data);
       }
       public function update(Request $request,$id){
        $save = SubjectModel::find($id);
        $save->name = trim($request->name) ;
        $save->status = trim($request->status) ;
        $save->type =trim($request->type) ;
        $save->save();
        return redirect()->route('admin.subject')->with('success','Subject Updated Successfully');
       }
       public function delete($id){
        $delete = SubjectModel::getSingle($id);
        $delete->is_delete = 1 ;
        $delete->save();
        return redirect()->route('admin.subject')->with('success','Subject Deleted Successfully');
       }


}
