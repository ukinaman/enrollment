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
        <li class="nav-item">
          <a class="nav-link" href="{{ route('semfee.index') }}">
            <i class="nav-icon fa-solid fa-list"></i>
            Semestral Fees
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('downpayment.index') }}">
            <i class="nav-icon fa-solid fa-list"></i>
            Manage Down Payment
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('discount.index') }}">
            <i class="nav-icon fa-solid fa-percent"></i>
            Discounts
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('assessment.index') }}">
            <i class="nav-icon fa-solid fa-file-invoice"></i>
            Assessment
          </a>
        </li>
      @endrole
      @role('Registrar')
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