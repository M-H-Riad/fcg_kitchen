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
            <h1 class="m-0">Class</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Class list</li>
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
                <h3 class="card-title">Class list</h3>
                <a href="{{ route('class.create') }}" class="btn btn-primary float-right">Create</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Details</th>
                        <th width="280px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0; ?>
                    @foreach ($sessions as $key => $session)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $session->name }}</td>
                            <td>{{ $session->courseData->name }}</td>
                            <td>{{ $session->details }}</td>
                            <td> 
                                <a class="btn btn-primary" href="{{ route('class.edit',$session->id) }}"><i class="fas fa-edit"></i></a>
                            
                                {!! Form::open(['method' => 'DELETE','route' => ['class.destroy', $session->id],'style'=>'display:inline', 'onclick' => 'return confirm("Are you sure you want to delete this item?");']) !!}
                                    {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Details</th>
                    <th width="280px">Action</th>
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