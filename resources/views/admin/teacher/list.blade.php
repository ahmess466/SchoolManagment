@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Teacher List ({{ $getRecord->total() }})</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ url('admin/teacher/add') }}" class="btn btn-primary">Add New Teacher</a>
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
                                        <div class="form-group col-md-2">
                                            <label>Name</label>
                                            <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Name">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" value="{{ Request::get('last_name') }}" name="last_name" placeholder="Last Name">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Email</label>
                                            <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Email">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="">Select Gender</option>
                                                <option {{ (Request::get('gender') == 'male') ? 'selected' : '' }} value="Male">Male</option>
                                                <option {{ (Request::get('gender') == 'female') ? 'selected' : '' }} value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control" name="mobile_number" value="{{ Request::get('mobile_number') }}" placeholder="Mobile Number">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Marital Status</label>
                                            <input type="text" class="form-control" name="marital_status" value="{{ Request::get('marital_status') }}" placeholder="Marital Status">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Current Address</label>
                                            <input type="text" class="form-control" name="address" value="{{ Request::get('address') }}" placeholder="Current Address">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Select Status</option>
                                                <option {{ (Request::get('status') == 100) ? 'selected' : '' }} value="100">Active</option>
                                                <option {{ (Request::get('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                            </select>
                                        </div>





                                        <div class="form-group col-md-2">
                                            <label>Religion </label>
                                            <input type="text" class="form-control" name="religion"
                                                value="{{ Request::get('religion') }}" placeholder="Religion">
                                        </div>



                                        <div class="form-group col-md-2">
                                            <label>Admission date </label>
                                            <input type="date" class="form-control" name="admission_date"
                                                value="{{ Request::get('addmission_date') }}">
                                        </div>


                                        <div class="form-group col-md-2">
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top: 30px">Search</button>
                                            <a href="{{ route('admin.teacher.list') }}" class="btn btn-success"
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
                                            <th>Teacher Name</th>
                                            <th>Gender</th>
                                            <th>Birthday</th>
                                            <th>Joining Date</th>
                                            <th>Mobile</th>
                                            <th>Martial Status</th>
                                            <th>Address</th>
                                            <th>Qualifications</th>
                                            <th>Experience</th>
                                            <th>Note</th>
                                            <th>Religion</th>
                                            <th>Status</th>
                                            <th>Email</th>

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
                                                <td>{{ $value->name }}{{ $value->last_name }}</td>
                                                <td>{{ $value->gender }}</td>
                                                <td>{{ $value->date_of_birth }}</td>
                                                <td>{{$value ->admission_date}}</td>
                                                <td>{{ $value->mobile_number }}</td>
                                                <td>{{$value->marital_status}}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>{{$value->qualification}}</td>
                                                <td>{{$value->work_experience}}</td>
                                                <td>{{$value->note}}</td>
                                                <td>{{ $value->religion }}</td>

                                                <td>
                                                    @if ($value->status == 0)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>





                                                <td>{{ $value->email }}</td>



                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.teacher.edit', ['id' => $value->id]) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    {{-- Uncomment to enable delete --}}
                                                    <a href="{{ route('admin.teacher.delete', ['id' => $value->id]) }}"
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
