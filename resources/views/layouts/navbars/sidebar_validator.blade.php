<div class="sidebar">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
  
    <div class="logo">
      <img class="img-fluid d-block" src="{{url('/images/ched_logo.png')}}" height="60%" width="60%">
    </div>
    {{-- <div class="logo">
      <a href="http://www.creative-tim.com" class="simple-text logo-mini">
        {{ __('CT') }}
      </a>
      <a href="http://www.creative-tim.com" class="simple-text logo-normal">
        {{ __('Creative Tim') }}
      </a>
    </div> --}}
    
    <div class="sidebar-wrapper" id="sidebar-wrapper">
      <ul class="nav">
        <li class="@if ($activePage == 'dashboard') active @endif">
          <a href="/validator/dashboard">
            <i class="now-ui-icons design_app"></i>
            <p>{{ __('Dashboard') }}</p>
          </a>
        </li>

        {{-- <li>
          <a data-toggle="collapse" href="#laravelExamples">
              <i class="fab fa-laravel"></i>
            <p>
              {{ __("Laravel Examples") }}
              <b class="caret"></b>
            </p>
          </a>
          
          <div class="collapse show" id="laravelExamples">
            <ul class="nav">
              <li class="@if ($activePage == 'profile') active @endif">
                <a href="{{ route('profile.edit') }}">
                  <i class="now-ui-icons users_single-02"></i>
                  <p> {{ __("User Profile") }} </p>
                </a>
              </li>
              <li class="@if ($activePage == 'users') active @endif">
                <a href="{{ route('user.index') }}">
                  <i class="now-ui-icons design_bullet-list-67"></i>
                  <p> {{ __("User Management") }} </p>
                </a>
              </li>
            </ul>
          </div>
        </li> --}}

        <li class="@if ($activePage == 'validation') active @endif">
          <a href="/validator/validation">
            <i class="now-ui-icons education_paper"></i>
            <p>Validation</p>
          </a>
        </li>

        <li class = " @if ($activePage == 'track') active @endif">
          <a href="/validator/track">
            <i class="now-ui-icons files_box"></i>
            <p>Track Submissions</p>
          </a>
        </li>

        <li class = "@if ($activePage == 'record') active @endif">
            <a href="/validator/records">
              <i class="now-ui-icons education_agenda-bookmark"></i>
              <p>Records</p>
            </a>
        </li>

        <li class = "@if ($activePage == 'account') active @endif">
            <a href="/validator/accounts">
              <i class="now-ui-icons users_single-02"></i>
              <p>Manage Accounts</p>
            </a>
        </li>

        <li class = " @if ($activePage == 'references') active @endif">
          <a href="/validator/references">
            <i class="now-ui-icons design_bullet-list-67"></i>
            <p>References</p>
          </a>
        </li>
 
        
      </ul>
    </div>
  </div>