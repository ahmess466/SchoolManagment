@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student List ({{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Add New Student</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search Student </h3>
                            </div>
                            <!-- form start -->
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2 ">
                                            <label>Name</label>
                                            <input type="text" class="form-control" value="{{ Request::get('name') }}"
                                                placeholder="Enter Name " name="name">
                                        </div>
                                        <div class="form-group col-md-2 ">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control"
                                                value="{{ Request::get('last_name') }}" placeholder="Last Name "
                                                name="last_name">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Email </label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ Request::get('email') }}" placeholder="Enter email">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Admission Number </label>
                                            <input type="text" class="form-control" name="admission_number"
                                                value="{{ Request::get('admission_number') }}"
                                                placeholder="Admission Number">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Roll Number </label>
                                            <input type="text" class="form-control" name="roll_number"
                                                value="{{ Request::get('roll_number') }}" placeholder="Roll Number">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Class </label>
                                            <input type="text" class="form-control" name="class"
                                                value="{{ Request::get('class') }}" placeholder="Class">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Gender </label>
                                            <select name="gender" id="" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option {{ Request::get('gender') == 'male' ? 'selected' : '' }}
                                                    value="male">Male</option>
                                                <option {{ Request::get('gender') == 'female' ? 'selected' : '' }}
                                                    value="female">Female</option>

                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Caste </label>
                                            <input type="text" class="form-control" name="caste"
                                                value="{{ Request::get('caste') }}" placeholder="caste">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Religion </label>
                                            <input type="text" class="form-control" name="religion"
                                                value="{{ Request::get('religion') }}" placeholder="Religion">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Mobile Number </label>
                                            <input type="text" class="form-control" name="mobile_number"
                                                value="{{ Request::get('mobile_number') }}" placeholder="Mobile Number">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Blood Group </label>
                                            <input type="text" class="form-control" name="blood_group"
                                                value="{{ Request::get('blood_group') }}" placeholder="Blood Group">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Status </label>
                                            <select name="status" id="" class="form-control">
                                                <option value="">Select Status</option>
                                                <option {{ Request::get('status') == 100 ? 'selected' : '' }} value='100'>
                                                    Active</option>
                                                <option {{ Request::get('status') == 1 ? 'selected' : '' }} value='1'>
                                                    InActive</option>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Admission date </label>
                                            <input type="date" class="form-control" name="admission_date"
                                                value="{{ Request::get('addmission_date') }}">
                                        </div>


                                        <div class="form-group col-md-2">
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top: 30px">Search</button>
                                            <a href="{{ route('admin.student.list') }}" class="btn btn-success"
                                                type="submit" style="margin-top: 30px">Clear</a>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @include('_message')

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student List</h3>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body p-0" style="overflow: auto;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile Pic</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Parent Name</th>
                                            <th>Email</th>
                                            <th>Admission Number</th>
                                            <th>Roll Number</th>
                                            <th>Class</th>
                                            <th>Gender</th>
                                            <th>Birthday</th>
                                            <th>Caste</th>
                                            <th>Religion</th>
                                            <th>Mobile</th>
                                            <th>Admission Date</th>
                                            <th>Blood Group</th>
                                            <th>Height</th>
                                            <th>Weight</th>
                                            <th>Status</th>
                                            <th>Create Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>
                                                    @if (!empty($value->getProfile()))
                                                        <img src="{{ $value->getProfile() }}"
                                                            style="height: 75px; width: 75px; border-radius: 50%;"
                                                            alt="Profile Picture">
                                                    @endif
                                                </td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->last_name }}</td>
                                                <td>{{ $value->parent_name }} {{$value->parent_last_name}}</td>

                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->admission_number }}</td>
                                                <td>{{ $value->roll_number }}</td>
                                                <td>{{ $value->class_name }}</td>
                                                <td>{{ $value->gender }}</td>
                                                <td>{{ $value->date_of_birth }}</td>
                                                <td>{{ $value->caste }}</td>
                                                <td>{{ $value->religion }}</td>
                                                <td>{{ $value->mobile_number }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->admission_date)) }}</td>
                                                <td>{{ $value->blood_group }}</td>
                                                <td>{{ $value->hieght }}</td>
                                                <td>{{ $value->wieght }}</td>
                                                <td>
                                                    @if ($value->status == 0)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.student.edit', ['id' => $value->id]) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    {{-- Uncomment to enable delete --}}
                                                    <a href="{{ route('admin.student.delete', ['id' => $value->id]) }}"
                                                        id="delete" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $getRecord->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
