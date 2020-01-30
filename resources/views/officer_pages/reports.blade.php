@extends('layouts.layout_officer', [
    'namePage' => 'Reports',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/officer/password',
    'class' => 'sidebar-mini',
    'activePage' => 'reports',
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

              <p style="font-size:18px;"><b> Approved Forms for Collation</b></p>

              <a href="/officer/collate"><button>Collate</button></a>
              <a href="/officer/exports"><button>Export</button></a>
              
              <table class="table" id="collationtbl">
                  <thead style="background-color: #003471; font-size: 10px;color:white;">
                    <tr>
                      <th><b>Institution</b></th>
                      <th><b>Form</b></th>
                      <th><b>Data Approved</b></th>
                    
                    </tr>
                  </thead>
                  <tbody> 
                        @foreach($files as $file)
                        
                        <tr>
                            
                            <td>{{$file->institution_name}}</td>
                            <td>{{$file->verifier_submission}}</td>
                            <td>{{$file->created_at}}</td>
                            
                        </tr>
                        
                        @endforeach
                   

                  </tbody>

          </div>
          </div>
        </div>
      </div>
             
  </div>
  </div>
@endsection

@section('scripts')
<script  type="text/javascript">
  $(document).ready(function() {
      $('#collationtbl').DataTable({
        lengthChange: false
       
      });
      
  } );
  </script>
    
@endsection