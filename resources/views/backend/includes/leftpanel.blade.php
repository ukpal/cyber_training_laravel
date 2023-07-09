<div class="sl-logo"><a href="#"><i class="icon ion-android-star-outline"></i> Cyber Yoddha</a></div>
    <div class="sl-sideleft">
      
      <label class="sidebar-label">Logged in as {{str_replace('-', ' ', Session::get('admin')['sess_role_name'])}}</label>
      <div class="sl-sideleft-menu">
        <a href="{{url('/dashboard')}}" class="sl-menu-link {{ $module == 'dashboard' ? 'active' : ''}}">
          <div class="sl-menu-item">
            <span class="menu-item-label">Dashboard</span>
          </div>
        </a>

        @if(Session::get('admin')['sess_role_name'] == 'director' || Session::get('admin')['sess_role_name'] == 'system-admin')        
        <a href="{{url('/members/scrutiny-committee')}}" class="sl-menu-link {{ $module == 'scrutiny-committee' || $module == 'add-scrutiny-committee' ? 'active' : ''}}">
          <div class="sl-menu-item">
            <span class="menu-item-label">Scrutiny Committee</span>
          </div>
        </a>
        <a href="{{url('/members/mentor-group')}}" class="sl-menu-link {{ $module == 'mentor-group' ? 'active' : ''}}">
            <div class="sl-menu-item">
              <span class="menu-item-label">Mentor Group</span>
            </div><!-- menu-item -->
          </a>
          <a href="{{url('/yoddha-registered')}}" class="sl-menu-link {{ $module == 'yoddha-registered' ? 'active' : ''}}">
          <div class="sl-menu-item">
            <span class="menu-item-label">Yoddha Registered</span>
          </div><!-- menu-item -->
        </a>
          <a href="{{url('/yoddha-team')}}" class="sl-menu-link {{ $module == 'yoddha-team' ? 'active' : ''}}">
            <div class="sl-menu-item">
              <span class="menu-item-label">Yoddha Team Members</span>
            </div><!-- menu-item -->
          </a>
        <a href="{{url('/spoc')}}" class="sl-menu-link {{ $module == 'spoc' ? 'active' : ''}}">
          <div class="sl-menu-item">
            <span class="menu-item-label">SPoC</span>
          </div><!-- menu-item -->
        </a>
        @endif

        @if(Session::get('admin')['sess_role_name'] == 'scrutiny-committee')
        <a href="{{url('/members/scrutiny-committee')}}" class="sl-menu-link {{ $module == 'scrutiny-committee' || $module == 'add-scrutiny-committee' ? 'active' : ''}}">
          <div class="sl-menu-item">
            <span class="menu-item-label">Scrutiny Committee</span>
          </div>
        </a>
        <a href="{{url('/yoddha-scrutiny')}}" class="sl-menu-link {{ $module == 'yoddha-scrutiny' ? 'active' : ''}}">
          <div class="sl-menu-item">
            <span class="menu-item-label">Registered Yoddha Scrutiny</span>
          </div>
        </a>
        @endif

        @if(Session::get('admin')['sess_role_name'] == 'mentor-group')
          <a href="{{url('/members/mentor-group')}}" class="sl-menu-link {{ $module == 'mentor-group' ? 'active' : ''}}">
            <div class="sl-menu-item">
              <span class="menu-item-label">Mentor Group</span>
            </div><!-- menu-item -->
          </a>
          <a href="{{url('/yoddha-team')}}" class="sl-menu-link {{ $module == 'yoddha-team' ? 'active' : ''}}">
            <div class="sl-menu-item">
              <span class="menu-item-label">Yoddha Team Members</span>
            </div><!-- menu-item -->
          </a>
          <a href="{{url('/spoc')}}" class="sl-menu-link {{ $module == 'spoc' ? 'active' : ''}}">
          <div class="sl-menu-item">
            <span class="menu-item-label">SPoC</span>
          </div><!-- menu-item -->
        </a>
        @endif

        @if(Session::get('admin')['sess_role_name'] == 'yoddha-member' || Session::get('admin')['sess_role_name'] == 'spoc')          
          <a href="{{url('/cyber-yoddha/yoddha-team')}}" class="sl-menu-link {{ $module == 'yoddha-team' ? 'active' : ''}}">
            <div class="sl-menu-item">
              <span class="menu-item-label">Yoddha Team Members</span>
            </div><!-- menu-item -->
          </a>
          <a href="{{url('/cyber-yoddha/my-tasks')}}" class="sl-menu-link {{ $module == 'my-tasks' ? 'active' : ''}}">
            <div class="sl-menu-item">
              <span class="menu-item-label">My Tasks</span>
            </div><!-- menu-item -->
          </a>
        @endif
        <a href="{{url('/my-profile')}}" class="sl-menu-link">
          <div class="sl-menu-item" class="sl-menu-link {{ $module == 'my-profile' ? 'active' : ''}}">
            <span class="menu-item-label">My Profile</span>
          </div>
        </a>
        
      </div><!-- sl-sideleft-menu -->

      <br>
    </div>