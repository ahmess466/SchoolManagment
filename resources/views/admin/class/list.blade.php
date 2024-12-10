
@extends('layouts.app')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Class List </h1>
        </div>
        <div class="col-sm-6" style="text-align:right;">
          <a href="{{route('admin.add.class')}}" class="btn btn-primary">Add New Class</a>
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
                  <h3 class="card-title">Search Class </h3>
                </div>
              <!-- form start -->
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3 ">
                        <label >Name</label>
                        <input type="text" class="form-control" value="{{Request::get('name')}}" placeholder="Enter Name "  name="name">
                      </div>
                      {{-- <div class="form-group col-md-3 ">
                        <label >Date</label>
                        <input type="date" class="form-control" value="{{Request::get('date')}}" placeholder="Enter Name "  name="date">
                      </div> --}}

                <div class="form-group col-md-3">
                  <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                  <a href="{{route('admin.class')}}" class="btn btn-success" type="submit" style="margin-top: 30px">Clear</a>

              </div>
              </div>
                </div>
              </form>
            </div>
            @include('_message')

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Class List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th >#</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th >Created By </th>
                    <th >Create Date</th>
                    <th >Action</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach ($getRecord as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td>
                            @if($value->status == 0)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>{{$value->created_by_name}}</td>
                        <td>{{date('d-m-Y H:i A',strtotime($value->created_at))}}</td>
                        <td>
                            <a href="{{ route('admin.class.edit', ['id' => $value->id]) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.class.delete', ['id' => $value->id]) }}" id="delete" class="btn btn-danger">
                                Delete
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

