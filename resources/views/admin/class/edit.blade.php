@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit class</h1>
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
              <form method="POST" action="{{ route('admin.class.update', ['id' => $getRecord->id]) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label >Class Name</label>
                        <input type="text" class="form-control"  placeholder="Class Name  " value="{{$getRecord->name}}" required name="name">
                      </div>
                      <div class="form-group">
                        <label >Status</label>
                        <select class="form-control" name="status">
                            <option value="0" {{ ($getRecord->status == 0 ? 'selected' : '') }}>Active</option>
                            <option value="1" {{ ($getRecord->status == 1 ? 'selected' : '') }}>Inactive</option>

                        </select>
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

