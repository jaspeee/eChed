@extends('layouts.layout_officer', [
    'namePage' => 'Backup Resources',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/officer/password',
    'class' => 'sidebar-mini',
    'activePage' => 'backup',
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
            <div class="container" style="padding:40px;">

              <p style="font-size:18px;"><b>Backup</b></p>

           <center>
           <a href="/officer/startbackup">
           <button type="button" class="btn btn-success" >Start Backup</button>
           </a>
           </center>

           </div>

          </div>
        </div>
      </div>
      
                 
  </div>
@endsection