<!-- Brand Logo -->
    
    



    <div class="logo d-flex justify-content-between pt-3 ml-5 mb-3">
      <a href="#"><img src="{{ asset('admin/dist/img/logo.png') }}" alt=""></a>
    </div>
    <!-- Sidebar -->
    
    <div class="sidebar"> 
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{ asset('/home') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas"></i>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('student.course') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Course List</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>View Certificates</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->