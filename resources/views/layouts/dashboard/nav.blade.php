<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/candidats')}}">
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
       
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="bar-chart-2"></span>
            Statistique
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
            admins_list
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('users')}}">
            <span data-feather="layers"></span>
            users_list
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