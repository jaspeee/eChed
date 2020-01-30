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
          <a href="/officer/dashboard">
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

        <li class="@if ($activePage == 'finalization') active @endif">
          <a href="/officer/finalization">
            <i class="now-ui-icons ui-2_like"></i>
            <p>Finalization</p>
          </a>
        </li>

        <li>
          <a data-toggle="collapse" href="#reports">
            <i class="now-ui-icons business_chart-bar-32"></i>
            <p>
              Reports
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse show" id="reports">
            <ul class="nav">
              <li class="@if ($activePage == 'reports') active @endif">
                <a href="/officer/reports">
                  <p style="padding-left:45px;">Approved Forms</p>
                </a>
              </li>
              <li class="@if ($activePage == 'collation') active @endif">
                <a href="/officer/collation">
                  <p style="padding-left:45px;">Collation</p>
                </a>
              </li>
              <li class="@if ($activePage == 'analytics') active @endif">
                <a href="/officer/analytics">
                  <p style="padding-left:45px;">Analytics</p>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <li class = " @if ($activePage == 'deadline') active @endif">
          <a href="/officer/deadline">
            <i class="now-ui-icons ui-1_bell-53"></i>
            <p>Set Deadline</p>
          </a>
        </li>

     
        <li>
          <a data-toggle="collapse" href="#laravelExamples">
            <i class="now-ui-icons users_single-02"></i>
            <p>
              Manage Accounts
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse show" id="laravelExamples">
            <ul class="nav">
              <li class="@if ($activePage == 'verifier') active @endif">
                <a href="/officer/accounts/verifier">
                 
                  <p style="padding-left:45px;">Verifier</p>
                </a>
              </li>
              <li class="@if ($activePage == 'validator') active @endif">
                <a href="/officer/accounts/validator">
                  <p style="padding-left:45px;">validator</p>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <li class = " @if ($activePage == 'references') active @endif">
          <a href="/officer/references">
            <i class="now-ui-icons design_bullet-list-67"></i>
            <p>References</p> 
          </a>
        </li>
 
        
      </ul>
    </div>
  </div>