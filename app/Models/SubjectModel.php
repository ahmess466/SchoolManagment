<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    protected $table = 'subject';

    static function getRecord(){
        $return = SubjectModel::select('subject.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'subject.created_by');

        if (!empty(request()->get('name'))) {
            $return = $return->where('subject.name', 'like', '%' . request()->get('name') . '%');
        }
        if (!empty(request()->get('type'))) {
            $return = $return->where('subject.type', '=',  request()->get('type') );
        }



        $return = $return->where('subject.is_delete', '=', 0)
            ->orderBy('subject.id', 'desc')
            ->paginate(10);

        return $return;


    }
     static public function getSubject(){
        $return = SubjectModel::select('subject.*')
        ->join('users', 'users.id', '=', 'subject.created_by')
        ->where('subject.is_delete', '=', 0)
        ->where('subject.status', '=', 0)
        ->orderBy('subject.name', 'asc')
        ->get();

    return $return;

    }




    static function getSingle($id)
    {
        return self::findOrFail($id);
    }
}
