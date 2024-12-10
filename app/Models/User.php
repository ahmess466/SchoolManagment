<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    static public function getEmailSingle($email)
    {
        return User::where('email', $email)->first();
    }
    static public function getAdmin()
    {
        return self::select('users.*')->where('user_type', 1)->orderBy('id', 'desc')->get();
    }

    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }
    static public function getStudent()
    {
        $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
        ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
        ->join('class', 'class.id', '=', 'users.class_id', 'left')


            ->where('users.user_type', 3)
            ->where('users.is_delete', 0);
        if (!empty(request()->get('name'))) {
            $return = $return->where('users.name', 'like', '%' . request()->get('name') . '%');
        }
        if (!empty(request()->get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . request()->get('last_name') . '%');
        }
        if (!empty(request()->get('email'))) {
            $return = $return->where('users.email', 'like', '%' . request()->get('email') . '%');
        }
        if (!empty(request()->get('admission_number'))) {
            $return = $return->where('users.admission_number', 'like', '%' . request()->get('admission_number') . '%');
        }
        if (!empty(request()->get('roll_number'))) {
            $return = $return->where('users.roll_number', 'like', '%' . request()->get('roll_number') . '%');
        }
        if (!empty(request()->get('class'))) {
            $return = $return->where('class.name', 'like', '%' . request()->get('class') . '%');
        }
        if (!empty(request()->get('gender'))) {
            $return = $return->where('users.gender', 'like', '%' . request()->get('gender') . '%');
        }
        if (!empty(request()->get('caste'))) {
            $return = $return->where('users.caste', 'like', '%' . request()->get('caste') . '%');
        }
        if (!empty(request()->get('religion'))) {
            $return = $return->where('users.religion', 'like', '%' . request()->get('religion') . '%');
        }
        if (!empty(request()->get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . request()->get('mobile_number') . '%');
        }
        if (!empty(request()->get('blood_group'))) {
            $return = $return->where('users.blood_group', 'like', '%' . request()->get('blood_group') . '%');
        }
        if (!empty(request()->get('status'))) {
            $status = (request()->get('status') == 100) ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }

        if (!empty(request()->get('admission_date'))) {
            $return = $return->whereDate('users.admission_date', '=',   request()->get('admission_date'));
        }



        $return = $return->orderBy('users.id', 'desc');
        $return = $return->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    }
    static public function getTeacher()
    {
        $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
        ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
        ->join('class', 'class.id', '=', 'users.class_id', 'left')


            ->where('users.user_type', 2)
            ->where('users.is_delete', 0);
        if (!empty(request()->get('name'))) {
            $return = $return->where('users.name', 'like', '%' . request()->get('name') . '%');
        }
        if (!empty(request()->get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . request()->get('last_name') . '%');
        }
        if (!empty(request()->get('email'))) {
            $return = $return->where('users.email', 'like', '%' . request()->get('email') . '%');
        }
        if (!empty(request()->get('marital_status'))) {
            $return = $return->where('users.marital_status', 'like', '%' . request()->get('marital_status') . '%');
        }


        if (!empty(request()->get('gender'))) {
            $return = $return->where('users.gender', 'like', '%' . request()->get('gender') . '%');
        }

        if (!empty(request()->get('religion'))) {
            $return = $return->where('users.religion', 'like', '%' . request()->get('religion') . '%');
        }
        if (!empty(request()->get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . request()->get('mobile_number') . '%');
        }

        if (!empty(request()->get('status'))) {
            $status = (request()->get('status') == 100) ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }

        if (!empty(request()->get('admission_date'))) {
            $return = $return->whereDate('users.admission_date', '=',   request()->get('admission_date'));
        }



        $return=$return->orderBy('users.id', 'desc');
        $return = $return->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    }

    static public function getParent()
    {
        $return = self::select('users.*')->where('users.user_type', 4)->where('users.is_delete', 0);

        if (!empty(request()->get('name'))) {
            $return = $return->where('users.name', 'like', '%' . request()->get('name') . '%');
        }
        if (!empty(request()->get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . request()->get('last_name') . '%');
        }
        if (!empty(request()->get('email'))) {
            $return = $return->where('users.email', 'like', '%' . request()->get('email') . '%');
        }
        if (!empty(request()->get('gender'))) {
            $return = $return->where('users.gender', 'like', '%' . request()->get('gender') . '%');
        }
        if (!empty(request()->get('status'))) {
            $status = (request()->get('status') == 100) ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }
        if (!empty(request()->get('address'))) {
            $return = $return->where('users.address', 'like', '%' . request()->get('address') . '%');
        }
        if (!empty(request()->get('occupation'))) {
            $return = $return->where('users.occupation', 'like', '%' . request()->get('occupation') . '%');
        }
        if (!empty(request()->get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . request()->get('mobile_number') . '%');
        }




        $return = $return->orderBy('users.id', 'desc');
        $return = $return->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    }
    public function getProfile()
    {
        $profilePath = public_path('upload/profile/' . $this->profile_pic);

        if (!empty($this->profile_pic) && file_exists($profilePath)) {
            return asset('upload/profile/' . $this->profile_pic);
        } else {
            return "";  // Return an empty string or a default image URL if needed
        }
    }
    static public function getSearchStudent()
    {
        if(!empty(request()->get('id'))||!empty(request()->get('name'))||request()->get('last_name')||request()->get('email')){
            $return = self::select('users.*', 'class.name as class_name','parent.name as parent_name')
            ->join('users as parent','parent.id','=','users.parent_id','left')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', 3)
            ->where('users.is_delete', 0);
            if (!empty(request()->get('id'))) {
                $return = $return->where('users.id', '=',  request()->get('id') );
            }
        if (!empty(request()->get('name'))) {
            $return = $return->where('users.name', 'like', '%' . request()->get('name') . '%');
        }
        if (!empty(request()->get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . request()->get('last_name') . '%');
        }
        if (!empty(request()->get('email'))) {
            $return = $return->where('users.email', 'like', '%' . request()->get('email') . '%');
        }




        $return = $return->orderBy('users.id', 'desc');
        $return = $return->orderBy('id', 'desc')
        ->limit(50)
            ->get();
        return $return;
        }
    }
    static public function getMyStudent($parent_id){
            $return = self::select('users.*', 'class.name as class_name','parent.name as parent_name')
            ->join('users as parent','parent.id','=','users.parent_id','left')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', 3)
            ->where('users.parent_id','=', $parent_id)
            ->where('users.is_delete', 0)
            ->orderBy('users.id', 'desc')
            ->get();
            return $return;



    }


}
