@extends('layouts.layout_validator', [
    'namePage' => 'Records',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/validator/password',
    'class' => 'sidebar-mini',
    'activePage' => 'record',
  ])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content"> 
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            {{-- <h4 class="card-title"> Simple Table</h4> --}}
          </div>
          <div class="card-body">
             record here
          </div>
        </div>
      </div>
         
  </div>
@endsection