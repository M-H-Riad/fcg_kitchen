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
                <h3 class="card-title">Edit Class</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                {!! Form::model($class, ['method' => 'PATCH','route' => ['class.update', $class->id]]) !!}
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $class->name }}">
                  </div>
                  <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" name="details" class="form-control" id="details" value="{{ $class->details }}">
                  </div>
                  <div class="form-group">
                    <label for="class">Course <span class="text-danger">*</span></label>
                    <select name="course_id" id="course_id" class="form-control" required>
                      <option value="">Select course</option>
                      @foreach ($courses as $key => $course)
                        <option value="{{$course->id}}" @if($course->id == $class->course_id) selected @endif>{{$course->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" @if($class->status == 1) selected @endif>Active</option>
                        <option value="0" @if($class->status == 0) selected @endif>Inactive</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="url">Video Url (Embaded Code) <span class="text-danger">*</span></label>
                    <input type="text" name="url" class="form-control" id="url" value="{{$class->url}}" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                  <a href="{{ route('class.index') }}" class="btn btn-warning float-right mr-1">Cancel</a>
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