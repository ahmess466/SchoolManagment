@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Student</h1>
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
              <form method="POST" action="{{route('admin.student.insert')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >First Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control"  placeholder="Enter First Name " value="{{old('name')}}"  name="name">
                            <div style="color: red">{{$errors->first('name')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Last Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{old('last_name')}}"  placeholder="Enter Last Name "  name="last_name">
                            <div style="color: red">{{$errors->first('last_name')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Admission Number <span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{old('admission_number')}}"  placeholder="Enter Admission Number "  name="admission_number">
                            <div style="color: red">{{$errors->first('admission_number')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Roll Number <span style="color: red"></span></label>
                            <input type="text" class="form-control" value="{{old('roll_number')}}"  placeholder="Enter Roll Number "  name="roll_number">
                            <div style="color: red">{{$errors->first('roll_number')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >    Class  <span style="color: red">*</span></label>
                            <select name="class_id" id="" class="form-control" >
                                <option value="">Select Class</option>
                                @foreach ($getClass as $value)
                                <option {{old('class_id')== $value->id ? 'selected': ''}} value="{{$value->id}}">{{$value->name}}</option>



                                @endforeach

                            </select>
                            <div style="color: red">{{$errors->first('class_id')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >    Gender  <span style="color: red">*</span></label>
                            <select name="gender" id="" class="form-control" >
                                <option value="">Select Gender</option>
                                <option {{old('gender')=='male' ? 'selected': ''}} value="male">Male</option>
                                <option {{old('gender')=='female' ? 'selected': ''}} value="female">Female</option>

                            </select>
                            <div style="color: red">{{$errors->first('gender')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Date Of Birth <span style="color: red">*</span></label>
                            <input type="date" class="form-control"  value="{{old('date_of_birth')}}"    name="date_of_birth">
                            <div style="color: red">{{$errors->first('date_of_birth')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Caste <span style="color: red"></span></label>
                            <input type="text" class="form-control" value="{{old('caste')}}"  placeholder="Enter Caste "  name="caste">
                            <div style="color: red">{{$errors->first('caste')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Religion <span style="color: red">*</span></label>
                            <select name="religion" id="" class="form-control" >
                                <option value="">Select Religion</option>
                                <option {{old('religion')=='muslim' ? 'selected': ''}} value="muslim">Muslim</option>
                                <option {{old('religion')=='christian' ? 'selected': ''}} value="christian ">Christian </option>

                            </select>
                            <div style="color: red">{{$errors->first('religion')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Phone Number <span style="color: red">*</span></label>
                            <input type="text" class="form-control" value="{{old('mobile_number')}}"  placeholder="Enter Phone Number "  name="mobile_number">
                            <div style="color: red">{{$errors->first('mobile_number')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Admission Date <span style="color: red">*</span></label>
                            <input type="date" class="form-control"  value="{{old('admission_date')}}"   name="admission_date">
                            <div style="color: red">{{$errors->first('admission_date')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Profile Picture <span style="color: red"></span></label>
                            <input type="file" class="form-control"    name="profile_pic">
                            <div style="color: red">{{$errors->first('profile_pic')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Blood Group <span style="color: red"></span></label>
                            <input type="text" class="form-control"  value="{{old('blood_group')}}"   name="blood_group" placeholder="Blood Group">
                            <div style="color: red">{{$errors->first('blood_group')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Height <span style="color: red"></span></label>
                            <input type="text" class="form-control" value="{{old('hieght')}}"    name="hieght" placeholder="Blood Group">
                            <div style="color: red">{{$errors->first('hieght')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Weight <span style="color: red"></span></label>
                            <input type="text" class="form-control" value="{{old('wieght')}}"   name="wieght" placeholder="Weight">
                            <div style="color: red">{{$errors->first('wieght')}}</div>

                          </div>
                          <div class="form-group col-md-6">
                            <label >Status <span style="color: red">*</span></label>
                            <select name="status" id="" class="form-control" >
                                <option value="">Select Status</option>
                                <option {{old('status')=='0' ? 'selected': ''}} value="0">Active</option>
                                <option {{old('status')=='1' ? 'selected': ''}} value="1">InActive </option>
                            </select>
                            <div style="color: red">{{$errors->first('status')}}</div>

                          </div>




                    </div>
                    <hr>

                  <div class="form-group">
                    <label >Email <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="email"  placeholder="Enter email">
                    <div style="color: red">{{$errors->first('email')}}</div>
                </div>
                  <div class="form-group">
                    <label >Password <span style="color: red">*</span></label>
                    <input type="password" class="form-control" name="password"  placeholder="Password">
                    <div style="color: red">{{$errors->first('password')}}</div>

                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
