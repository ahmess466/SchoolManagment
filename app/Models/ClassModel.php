<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class ClassModel extends Model
{
    protected $table = 'class';

    static function getRecord()
    {
        $return = ClassModel::select('class.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'class.created_by');

        if (!empty(request()->get('name'))) {
            $return = $return->where('class.name', 'like', '%' . request()->get('name') . '%');
        }

        if (!empty(request()->get('date'))) {
            $return = $return->where('class.created_at', '=', request()->get('date'));
        }

        $return = $return->where('class.is_delete', '=', 0)
            ->orderBy('class.id', 'desc')
            ->paginate(10);

        return $return;
    }


    static function getSingle($id)
    {
        return self::findOrFail($id);
    }

    static function getClass(){

        $return = ClassModel::select('class.*')
            ->join('users', 'users.id', '=', 'class.created_by')
            ->where('class.is_delete', '=', 0)
            ->where('class.status', '=', 0)
            ->orderBy('class.name', 'asc')
            ->get();

        return $return;

    }
}
