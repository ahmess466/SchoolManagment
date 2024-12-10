@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- left column -->
          <div class="col-md-12">
            @include('_message')

            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              @if(Auth::user()->user_type == 1)
                <form method="POST" action="{{route('admin.update.password')}}">
              @elseif(Auth::user()->user_type == 2)
              <form method="POST" action="{{route('teacher.update.password')}}">

              @elseif(Auth::user()->user_type == 3)
              <form method="POST" action="{{route('student.update.password')}}">

              @elseif(Auth::user()->user_type == 4)
              <form method="POST" action="{{route('parent.update.password')}}">

                @endif

                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label >Old Password</label>
                        <input type="password" class="form-control"  placeholder="Old Password" value="" required name="old_password">
                      </div>
                    <div class="form-group">
                        <label >New Password</label>
                        <input type="password" class="form-control"  placeholder="New Password" value="" required name="new_password">
                      </div>




                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->



          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

