<div class="sidebar sidebar-light sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="nav-icon fa-solid fa-gauge"></i>
          Dashboard
        </a>
      </li>
      @role('Accounting')
        <li class="nav-group">
          <a class="nav-link nav-group-toggle">
            <i class="nav-icon fa-solid fa-receipt"></i>
            Accounting
          </a>
          <ul class="nav-group-items">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('accounting.index') }}">
                <i class="nav-icon fas fa-vial"></i>
                Other options here
              </a>
            </li>
          </ul>
        </li>
      @endrole
      @role('Registrar')
        <li class="nav-group">
          <a class="nav-link nav-group-toggle">
            <i class="nav-icon fa-solid fa-address-card"></i>
            Registrar
          </a>
          <ul class="nav-group-items">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('courses.index') }}">
                <i class="nav-icon fa-solid fa-building-columns"></i>
                Courses
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('subject.index') }}">
                <i class="nav-icon fa-solid fa-book"></i>
                Subjects
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('students.index') }}">
                <i class="nav-icon fa-solid fa-book-open-reader"></i>
                Students
              </a>
            </li>
          </ul>
        </li>
      @endrole
      <li class="nav-group">
        <a class="nav-link nav-group-toggle">
          <i class="nav-icon fa-solid fa-user"></i>
          User Management
        </a>
        <ul class="nav-group-items">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
              <i class="nav-icon fa-solid fa-user-plus"></i>
              Add User
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('roles.index') }}">
              <i class="nav-icon fa-solid fa-id-card-clip"></i>
              Roles and Permissions
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>