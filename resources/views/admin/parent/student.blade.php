@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Parent Student List ({{$getParent->name}} {{$getParent->last_name}})  </h1>
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
                                <h3 class="card-title">Search Student </h3>
                            </div>
                            <!-- form start -->
                            <form method="get" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-2 ">
                                            <label>Student Id</label>
                                            <input type="text" class="form-control" value="{{ Request::get('id') }}"
                                                placeholder="Enter Id " name="id">
                                        </div>
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
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top: 30px">Search</button>
                                                <a href="{{ route('admin.parent.student', ['id' => $parent_id]) }}" class="btn btn-success" style="margin-top: 30px">Clear</a>


                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @include('_message')
                        @if(!empty($getSearchStudent))

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Student List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile Pic</th>
                                            <th>Parent Name</th>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Create Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getSearchStudent as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>
                                                @if (!empty($value->getProfile()))
                                                    <img src="{{ $value->getProfile() }}"
                                                        style="height: 75px; width: 75px; border-radius: 50%;"
                                                        alt="Profile Picture">
                                                @endif
                                            </td>
                                            <td>{{$value->parent_name}}</td>
                                            <td>{{ $value->name }} {{ $value->last_name }}</td>


                                            <td>{{ $value->email }}</td>

                                            </td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/parent/assign_student_parent/' . $value->id . '/' . $parent_id) }}" class="btn btn-primary btn-sm">Add Student to Parent</a>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $getRecord->links('pagination::bootstrap-5') }} --}}

                            </div>
                            <!-- /.card-body -->

                        </div>
                        @endif
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Parent Student List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile Pic</th>
                                            <th>Parent Name</th>
                                            <th>Student Name</th>
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
                                            <td>{{$value->parent_name}}</td>
                                            <td>{{ $value->name }} {{ $value->last_name }}</td>


                                            <td>{{ $value->email }}</td>

                                            </td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/parent/assign_student_parent_delete/' . $value->id ) }}" id="delete" class="btn btn-danger btn-sm">Delete</a>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $getRecord->links('pagination::bootstrap-5') }} --}}

                            </div>
                            <!-- /.card-body -->
                        </div>
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
