<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSubjectModel extends Model
{
    protected $table = 'class_subject';
    static function getRecord(){
        $return = self::select('class_subject.*','class.name as class_name','subject.name as subject_name','users.name as created_by')
        ->join('subject','subject.id','=','class_subject.subject_id')
        ->join('class','class.id','=','class_subject.class_id')
        ->join('users','users.id','=','class_subject.created_by')
        ->where('class_subject.is_delete','=',0);
        if (!empty(request()->get('subject_name'))) {
            $return = $return->where('subject.name', 'like', '%' . request()->get('subject_name') . '%');
        }
        if (!empty(request()->get('class_name'))) {
            $return = $return->where('class.name', '=', request()->get('class_name'));
        }
       $return = $return->orderBy('class_subject.id','desc')
        ->paginate(10);
        return $return;




    }

    static function getAlreadyFirst($class_id,$subject_id){
        return self::where('class_id','=',$class_id)->where('subject_id','=',$subject_id)->first();




    }
    static function getSingle($id){
        return self::findOrFail($id);
    }
    static function getAssignSubjectID($class_id){
        return self::where('class_id','=',$class_id)->where('is_delete','=',0)->get();

    }
    static function deleteSubject($class_id){
        return self::where('class_id','=',$class_id)->delete();


    }

}
