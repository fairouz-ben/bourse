
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>القائمة</span>
      <a class="link-secondary" href="#" aria-label="Add a new report">
        <span data-feather="plus-circle"></span>
      </a>


    </h6>
    <ul class="nav flex-column mb-2">
      @if(Auth::user()->hasRole('candidat'))
      <li class="nav-item">
        <a class="nav-link" href="{{route('candidat')}}">
          <span data-feather="file-text"></span>
          المعلومات الشخصية
        </a>
        </li>
      {{--<li class="nav-item">
        <a class="nav-link" href="{{route('documents')}}">
          <span data-feather="file-text"></span>
         تحميل الملفات
        </a>
        </li>--}}
        @endif
        @if(Auth::user()->hasRole('manager'))
        <li class="nav-item">
            <a class="nav-link" href="{{url('/candidats')}}">
              <span data-feather="users"></span>
              قائمة المترشحين
            </a>
          </li>
        <li class="nav-item">
            <a href="{{route('candidats_deleted')}}" class="nav-link">
              <span data-feather="users"></span>
              قائمة المترشحين المحذوفين
            </a>
        </li>
      @endif
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
