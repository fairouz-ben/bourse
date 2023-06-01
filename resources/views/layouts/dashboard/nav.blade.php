
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Saved reports</span>
      <a class="link-secondary" href="#" aria-label="Add a new report">
        <span data-feather="plus-circle"></span>
      </a>


    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Current month
        </a>
        <a href="{{url('/candidats')}}" class="nav-link">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          <span data-feather="users"></span>
          Candidats List all
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/candidats_fac')}}">
          <span data-feather="users"></span>
          Candidats in Faculty
        </a>
        
      </li>
      
    </ul>
    @if(Auth::user()->hasRole('superAdmin'))
  <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>Sitting</span>
    <a class="link-secondary" href="#" aria-label="Add a new report">
      <span data-feather="plus-circle"></span>
    </a>
  </h6>
  
    

  <ul class="nav flex-column mb-2">
    <li class="nav-item">
      <a class="nav-link" href="{{url('admins_list')}}">
        <span data-feather="layers"></span>
        Admins list
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('users')}}">
        <span data-feather="layers"></span>
        Users list
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{url('registeradmin')}}">
        <span data-feather="layers"></span>
        Register admin
      </a>
      
    </li>
   
  </ul>
  @endif
  </div>
</nav>
