@extends('layouts.admin.dashboard')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Class</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Class</li>
            </ol>
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
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Course</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                {!! Form::model($data, ['method' => 'PATCH','route' => ['assign-course.update', $data->id]]) !!}
                <div class="card-body">
                  <div class="form-group">
                    <label for="class">Course <span class="text-danger">*</span></label>
                    <select name="course_id" id="course_id" class="form-control" required>
                      <option value="">Select course</option>
                      @foreach ($courses as $key => $course)
                        <option value="{{$course->id}}" @if($course->id == $data->course_id) selected @endif>{{$course->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="student">Select Student</label>
                    <select name="student_id" id="student_id" class="form-control">
                      <option value="">Select student</option>
                      @foreach ($students as $key => $student)
                        <option value="{{$student->id}}" @if($student->id == $data->student_id) selected @endif>{{$student->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="payment">Payment <span class="text-danger">*</span></label>
                    <input type="text" name="payment" class="form-control" id="payment" value="0.00" required>
                  </div>
                  <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                      <option value="1" @if($data->status == 1) selected @endif>Active</option>
                      <option value="0" @if($data->status == 0) selected @endif>Inactive</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                  <a href="{{ route('assign-course.index') }}" class="btn btn-warning float-right mr-1">Cancel</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection