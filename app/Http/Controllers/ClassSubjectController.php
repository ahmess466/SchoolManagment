<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    public function list(Request $request)
    {
        $data['getRecord'] = ClassSubjectModel::getRecord();
        $data['header_title'] = '  Subject Assign List';
        return view('admin.assign.list', $data);
    }
    public function add(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();

        $data['header_title'] = 'Add New Assign Subject';
        return view('admin.assign.add', $data);
    }

    public function insert(Request $request)
    {
        if (!empty($request->subject_id)) {

            foreach ($request->subject_id as $subject_id) {
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } else {
                    $save = new ClassSubjectModel();
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->created_by = Auth::user()->id;
                    $save->status = $request->status;
                    $save->save();
                }
            }
            return redirect()->route('admin.assign')->with('success', ' Assign Subject Succesfully Added');
        } else {
            return redirect()->back()->with('error', 'Please Select Subject');
        }
    }
    public function delete($id)
    {
        $save = ClassSubjectModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();
        return redirect()->back()->with('success', 'Assign Subject Deleted Succesfully');
    }
    public function edit($id)
    {
        $getRecord = ClassSubjectModel::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectID'] = ClassSubjectModel::getAssignSubjectID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Edit Assign Subject';
            return view('admin.assign.edit', $data);
        } else {
            abort(404);
        }
    }
    public function update(Request $request)
    {
        ClassSubjectModel::deleteSubject($request->class_id);
        if (!empty($request->subject_id)) {

            foreach ($request->subject_id as $subject_id) {
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } else {
                    $save = new ClassSubjectModel();
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->created_by = Auth::user()->id;
                    $save->status = $request->status;
                    $save->save();
                }
            }
        }
        return redirect()->route('admin.assign')->with('success', ' Assign Subject Succesfully Updated');
    }

    public function editSingle($id){
        $getRecord = ClassSubjectModel::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = 'Edit Assign Subject';
            return view('admin.assign.edit-single', $data);
        } else {
            abort(404);
        }

    }
    public function updateSingle($id, Request $request)
    {
        // Attempt to get an existing record
        $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $request->subject_id);

        // If a record exists, update it
        if ($getAlreadyFirst) {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();

            return redirect()->route('admin.assign')->with('success', 'Status Successfully Updated');
        }
        // If no record is found, create a new one
        else {
            $save = ClassSubjectModel::getSingle($id);
            $save->class_id = $request->class_id;
            $save->subject_id = $request->subject_id;
            $save->status = $request->status;
            $save->save();

            return redirect()->route('admin.assign')->with('success', 'Subject Successfully Assigned to Class');
        }
    }

    }
