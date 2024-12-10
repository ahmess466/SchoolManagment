@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Parent List ({{ $getRecord->total() }}) </h1>
                    </div>
                    <div class="col-sm-6" style="text-align:right;">
                        <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">Add New Parent</a>
                    </div>


                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- general form elements -->
            <div class="container-fluid">
                <div class="row">

                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search Parent </h3>
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
                                            <label>Occupation </label>
                                            <input type="text" class="form-control" name="occupation"
                                                value="{{ Request::get('occuptaion') }}" placeholder="Occupation">
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
                                            <label>Address </label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ Request::get('address') }}" placeholder="Address">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Mobile Number </label>
                                            <input type="text" class="form-control" name="mobile_number"
                                                value="{{ Request::get('mobile_number') }}" placeholder="Mobile Number">
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
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top: 30px">Search</button>
                                            <a href="{{ route('admin.parent.list') }}" class="btn btn-success"
                                                type="submit" style="margin-top: 30px">Clear</a>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @include('_message')

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Parent List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile Pic</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Occupation</th>
                                            <th>Address</th>
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
                                                <td>{{ $value->email }}</td>

                                                <td>{{ $value->gender }}</td>
                                                <td>{{ $value->mobile_number }}</td>
                                                <td>{{ $value->occupation }}</td>
                                                <td>{{ $value->address }}</td>

                                                <td>
                                                    @if ($value->status == 0)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $value->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('admin.parent.edit', ['id' => $value->id]) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="{{ route('admin.parent.delete', ['id' => $value->id]) }}"
                                                        id="delete" class="btn btn-danger">
                                                        Delete
                                                    </a>
                                                    <a href="{{ route('admin.parent.student', ['id' => $value->id]) }}"
                                                        id="" class="btn btn-secondary">
                                                        My Student
                                                    </a>

                                                </td>




                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $getRecord->links('pagination::bootstrap-5') }}

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
