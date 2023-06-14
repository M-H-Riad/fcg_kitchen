@extends('layouts.admin.dashboard')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Session</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Session</li>
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
                <h3 class="card-title">Create Course</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('course.store') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label for="session">Session</label>
                    <select name="session_id" id="session_id" class="form-control">
                      <option value="">Select Session</option>
                      @foreach ($sessions as $key => $session)
                        <option value="{{$session->id}}">{{$session->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="instructor">Instructor <span class="text-danger">*</span></label>
                    <input type="text" name="instructor" class="form-control" id="instructor" placeholder="Enter instructor" required>
                  </div>
                  <div class="form-group">
                    <label for="duration">Duration (Hours) <span class="text-danger">*</span></label>
                    <input type="text" name="duration" class="form-control" id="duration" placeholder="Enter duration" required>
                  </div>
                  <div class="form-group">
                    <label for="total_class">Total Class <span class="text-danger">*</span></label>
                    <input type="text" name="total_class" class="form-control" id="total_class" placeholder="Enter total_class" required>
                  </div>
                  <div class="form-group">
                    <label for="url">Video Url <span class="text-danger">*</span></label>
                    <input type="text" name="url" class="form-control" id="url" placeholder="Enter url" required>
                  </div>
                  <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" name="details" class="form-control" id="details" placeholder="Enter details">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                  <a href="{{ route('course.index') }}" class="btn btn-warning float-right mr-1">Cancel</a>
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