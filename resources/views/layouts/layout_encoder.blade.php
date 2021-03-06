@extends('layouts.skeleton')
    
@section('template')
    
    @auth
      @include('layouts.page_template.template_encoder')
    @endauth
    @guest
      @include('layouts.page_template.guest')
    @endguest

@endsection

@section('script')
    @yield('scripts')
@endsection