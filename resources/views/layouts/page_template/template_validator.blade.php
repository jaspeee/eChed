
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@include('layouts.navbars.sidebar_validator')
<div class="main-panel">
    @include('layouts.navbars.navs.auth')
    @yield('content')
  
</div>