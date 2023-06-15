@extends('student::layouts.student.dashboard')
@include('include.datatable-css')

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Course List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Course list</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Course Name</th>
                        <th>Session</th>
                        <th>Instructor</th>
                        <th>Duration</th>
                        <th>Total Class</th>
                        <th>Details</th>
                        <th width="100px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0; ?>
                    @foreach ($courses as $key => $data)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $data->courseData->name }}</td>
                            <td>{{ $data->courseData->sessionData->name }}</td>
                            <td>{{ $data->courseData->instructor }}</td>
                            <td>{{ $data->courseData->duration }}</td>
                            <td>{{ $data->courseData->total_class }}</td>
                            <td>{{ $data->courseData->details }}</td>
                            <td> 
                                <a class="btn btn-primary" href="{{ route('student.course.class',$data->id) }}"><i class="fas fa-eye"></i> View Class</a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sl.</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Instructor</th>
                    <th>Duration</th>
                    <th>Total Class</th>
                    <th>Details</th>
                    <th width="100px">Action</th>
                   </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@include('include.datatable-js')