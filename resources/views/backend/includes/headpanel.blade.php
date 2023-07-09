<div class="sl-header">
    <div class="sl-header-left">
      <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a></div>
      <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a></div>

      <h1 class="card-body-title tx-13 mb-0 ml-2 text-white">Department of information Technology & Electronics<br><span>Government of West Bengal</span></h1>
    </div><!-- sl-header-left -->
    @if(Session::has("admin"))
    <div class="sl-header-right">
      <nav class="nav">
        <div class="dropdown">
          <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">           
            @if (Session::get('admin.sess_profile_photo'))
            <img src="{{asset('storage/users/avatar/' . Session::get('admin.sess_profile_photo'))}}" class="wd-32 rounded-circle" alt="">           
            @endif
            <span class="logged-name">{{printFullname(Session::get('admin.sess_admin_fullname'))}}</span>
            <i class="fa fa-caret-down text-white"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-header wd-200">
            <ul class="list-unstyled user-profile-nav">
              <li><a href="#"><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
              @php $role = Session::get('admin')['sess_role_name'] @endphp
              @if($role == 'director' || $role == 'scrutiny-committee' || $role == 'mentor-group')
              <li><a href="{{url('/logout')}}"><i class="icon ion-log-out"></i> Sign Out</a></li>
              @else
              <li><a href="{{url('/cyber-yoddha/logout')}}"><i class="icon ion-log-out"></i> Sign Out</a></li>
              @endif             
            </ul>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </nav>
      
    </div><!-- sl-header-right -->
    @endif
  </div>
  