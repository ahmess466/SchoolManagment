@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Student</h1>
          </div>
        </div>
      </div>
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
              <form method="POST" action="{{ route('admin.student.update', ['id' => $getRecord->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <!-- First Name -->
                        <div class="form-group col-md-6">
                            <label>First Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter First Name" value="{{ $getRecord->name }}" name="name">
                            <div style="color: red">{{ $errors->first('name') }}</div>
                        </div>

                        <!-- Last Name -->
                        <div class="form-group col-md-6">
                            <label>Last Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter Last Name" value="{{ $getRecord->last_name }}" name="last_name">
                            <div style="color: red">{{ $errors->first('last_name') }}</div>
                        </div>

                        <!-- Admission Number -->
                        <div class="form-group col-md-6">
                            <label>Admission Number <span style="color: red">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter Admission Number" value="{{ $getRecord->admission_number }}" name="admission_number">
                            <div style="color: red">{{ $errors->first('admission_number') }}</div>
                        </div>

                        <!-- Roll Number -->
                        <div class="form-group col-md-6">
                            <label>Roll Number</label>
                            <input type="text" class="form-control" placeholder="Enter Roll Number" value="{{ $getRecord->roll_number }}" name="roll_number">
                            <div style="color: red">{{ $errors->first('roll_number') }}</div>
                        </div>

                        <!-- Class -->
                        <div class="form-group col-md-6">
                            <label>Class <span style="color: red">*</span></label>
                            <select name="class_id" class="form-control">
                                <option value="">Select Class</option>
                                @foreach ($getClass as $value)
                                    <option {{ $getRecord->class_id == $value->id ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                            <div style="color: red">{{ $errors->first('class_id') }}</div>
                        </div>

                        <!-- Gender -->
                        <div class="form-group col-md-6">
                            <label>Gender <span style="color: red">*</span></label>
                            <select name="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option {{ $getRecord->gender == 'male' ? 'selected' : '' }} value="male">Male</option>
                                <option {{ $getRecord->gender == 'female' ? 'selected' : '' }} value="female">Female</option>
                            </select>
                            <div style="color: red">{{ $errors->first('gender') }}</div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="form-group col-md-6">
                            <label>Date Of Birth <span style="color: red">*</span></label>
                            <input type="date" class="form-control" value="{{ $getRecord->date_of_birth }}" name="date_of_birth">
                            <div style="color: red">{{ $errors->first('date_of_birth') }}</div>
                        </div>

                        <!-- Caste -->
                        <div class="form-group col-md-6">
                            <label>Caste</label>
                            <input type="text" class="form-control" placeholder="Enter Caste" value="{{ $getRecord->caste }}" name="caste">
                            <div style="color: red">{{ $errors->first('caste') }}</div>
                        </div>

                        <!-- Religion -->
                        <div class="form-group col-md-6">
                            <label>Religion <span style="color: red">*</span></label>
                            <select name="religion" class="form-control">
                                <option value="">Select Religion</option>
                                <option {{ $getRecord->religion == 'muslim' ? 'selected' : '' }} value="muslim">Muslim</option>
                                <option {{ $getRecord->religion == 'christian' ? 'selected' : '' }} value="christian">Christian</option>
                            </select>
                            <div style="color: red">{{ $errors->first('religion') }}</div>
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group col-md-6">
                            <label>Phone Number <span style="color: red">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter Phone Number" value="{{ $getRecord->mobile_number }}" name="mobile_number">
                            <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                        </div>

                        <!-- Admission Date -->
                        <div class="form-group col-md-6">
                            <label>Admission Date <span style="color: red">*</span></label>
                            <input type="date" class="form-control" value="{{ $getRecord->admission_date }}" name="admission_date">
                            <div style="color: red">{{ $errors->first('admission_date') }}</div>
                        </div>

                        <!-- Profile Picture -->
                        <div class="form-group col-md-6">
                            <label>Profile Picture</label>
                            <input type="file" class="form-control" name="profile_pic">
                            <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                            @if(!empty($getRecord->getProfile()))
                            <img src="{{ $getRecord->getProfile() }}" style="width: 100px;">
                        @endif

                        </div>

                        <!-- Blood Group -->
                        <div class="form-group col-md-6">
                            <label>Blood Group</label>
                            <input type="text" class="form-control" value="{{ $getRecord->blood_group }}" name="blood_group" placeholder="Blood Group">
                            <div style="color: red">{{ $errors->first('blood_group') }}</div>
                        </div>

                        <!-- Height -->
                        <div class="form-group col-md-6">
                            <label>Height</label>
                            <input type="text" class="form-control" value="{{ $getRecord->hieght }}" name="hieght" placeholder="Height">
                            <div style="color: red">{{ $errors->first('hieght') }}</div>
                        </div>

                        <!-- Weight -->
                        <div class="form-group col-md-6">
                            <label>Weight</label>
                            <input type="text" class="form-control" value="{{ $getRecord->wieght }}" name="wieght" placeholder="Weight">
                            <div style="color: red">{{ $errors->first('wieght') }}</div>
                        </div>

                        <!-- Status -->
                        <div class="form-group col-md-6">
                            <label>Status <span style="color: red">*</span></label>
                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option {{ $getRecord->status == '0' ? 'selected' : '' }} value="0">Active</option>
                                <option {{ $getRecord->status == '1' ? 'selected' : '' }} value="1">Inactive</option>
                            </select>
                            <div style="color: red">{{ $errors->first('status') }}</div>
                        </div>
                    </div>

                    <hr>
                    <!-- Email -->
                    <div class="form-group">
                        <label>Email <span style="color: red">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ $getRecord->email }}" placeholder="Enter email">
                        <div style="color: red">{{ $errors->first('email') }}</div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div style="color: red">{{ $errors->first('password') }}</div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection
