@extends('layouts.admin.dashboard')
@include('include.datatable-css')

@section('content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Assign Course</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assign Course list</li>
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
                <h3 class="card-title">Assign Course list</h3>
                <a href="{{ route('assign-course.create') }}" class="btn btn-primary float-right">Create</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Course Name</th>
                        <th>Student Name</th>
                        <th>Status</th>
                        <th>Certificate</th>
                        <th>Payment</th>
                        <th width="100px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0; ?>
                    @foreach ($datas as $key => $data)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $data->courseData->name }}</td>
                            <td>{{ $data->studentData->name }}</td>
                            <td class="text-{{ ($data->status) ? "success" : "warning" }}">{{ ($data->status) ? "Active" : "Deactive" }}</td>
                            <td>{{ ($data->certificate) ? "Yes" : "No" }}</td>
                            <td>{{ $data->payment }}</td>
                            <td> 
                                <a class="btn btn-primary" href="{{ route('assign-course.edit',$data->id) }}"><i class="fas fa-edit"></i></a>
                            
                                {!! Form::open(['method' => 'DELETE','route' => ['assign-course.destroy', $data->id],'style'=>'display:inline', 'onclick' => 'return confirm("Are you sure you want to delete this item?");']) !!}
                                    {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                      <th>Sl.</th>
                      <th>Course Name</th>
                      <th>Student Name</th>
                      <th>Status</th>
                      <th>Certificate</th>
                      <th>Payment</th>
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