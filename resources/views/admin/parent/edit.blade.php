@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit  Parent</h1>
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
              <form method="POST" action="{{ route('admin.parent.update', ['id' => $getRecord->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >First Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control"  placeholder="Enter First Name " value="{{ $getRecord->name }}"  name="name">
                            <div style="color: red">{{$errors->first('name')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Last Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{ $getRecord->last_name }}"  placeholder="Enter Last Name "  name="last_name">
                            <div style="color: red">{{$errors->first('last_name')}}</div>

                          </div>



                          <div class="form-group col-md-6">
                            <label >    Gender  <span style="color: red">*</span></label>
                            <select name="gender" id="" class="form-control" >
                                <option value="">Select Gender</option>
                                <option {{$getRecord->gender=='male' ? 'selected': ''}} value="male">Male</option>
                                <option {{$getRecord->gender=='female' ? 'selected': ''}} value="female">Female</option>

                            </select>
                            <div style="color: red">{{$errors->first('gender')}}</div>

                          </div>



                          <div class="form-group col-md-6">
                            <label >Phone Number <span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{$getRecord->mobile_number}}"  placeholder="Enter Phone Number "  name="mobile_number">
                            <div style="color: red">{{$errors->first('mobile_number')}}</div>

                          </div>

                          <div class="form-group col-md-6">
                            <label>Profile Picture</label>
                            <input type="file" class="form-control" name="profile_pic">
                            <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                            @if(!empty($getRecord->getProfile()))
                            <img src="{{ $getRecord->getProfile() }}" style="width: 100px;">
                        @endif

                        </div>

                          <div class="form-group col-md-6">
                            <label >Occupation <span style="color: red"></span></label>
                            <input type="text" class="form-control" value="{{$getRecord->occupation}}"    name="occupation" placeholder="Occupation">
                            <div style="color: red">{{$errors->first('occupation')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Address <span style="color: red"></span></label>
                            <input type="text" class="form-control" value="{{$getRecord->address}}"   name="address" placeholder="Address">
                            <div style="color: red">{{$errors->first('address')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Status <span style="color: red">*</span></label>
                            <select name="status" id="" class="form-control" >
                                <option value="">Select Status</option>
                                <option {{$getRecord->status=='0' ? 'selected': ''}} value="0">Active</option>
                                <option {{$getRecord->status=='1' ? 'selected': ''}} value="1">InActive </option>
                            </select>
                            <div style="color: red">{{$errors->first('status')}}</div>

                          </div>




                    </div>
                    <hr>

                  <div class="form-group">
                    <label >Email <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{$getRecord->email}}"  placeholder="Enter email">
                    <div style="color: red">{{$errors->first('email')}}</div>
                </div>
                  <div class="form-group">
                    <label >Password <span style="color: red">*</span></label>
                    <input type="password" class="form-control" name="password"  placeholder="Password">
                    <div style="color: red">{{$errors->first('password')}}</div>
                    <div style="color: blue">You Want To Change Password</div>

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
