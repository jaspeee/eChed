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

    @if (count($errors) > 0)
    <div class="alert alert-danger" style="line-height: 2px; padding-top:3%; padding-bottom:1%;">
      <p>There were some problems with your File input.</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>  
    @endif

      @if(session('success'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{ session('success') }}
      </div> 

      @elseif(session('danger'))
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{ session('danger') }}
      </div> 
      @endif

      
    <div class="row">
      <div class="col-md-12">
        <div class="card">  
          <div class="card-header">
            {{-- <h4 class="card-title"> Simple Table</h4> --}}
          </div> 
          <div class="card-body">
            <div class="container" style="padding:40px;">

              <p style="font-size:18px;"><b> Approved Forms for Collation</b></p>
              <p style="font-size:13px;">Collate : Please click this button to collate files
                  
                <a href="/officer/collate">
                <button  onclick="return confirmation();" type="button" style="width:20px;height:20px;" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                  <i class="now-ui-icons files_box" data-toggle="tooltip" data-placement="top" title="Collate"></i>
                </button>
                </a>
              </p> 

              <hr>

              {{-- <a href="/officer/collate"><button>Collate</button></a> --}}
              {{-- <button href="/officer/exports"><button>Export</button></button> --}}
              
              <br>
              <form class="form-inline " >
                <div class="form-group">
                  <label >
                    <i class="now-ui-icons ui-1_zoom-bold" style="font-size: 18px;"></i> &nbsp;
                  </label>
                    <input type="text" class="form-control" id="tracksearchbar" placeholder= "Search" > 
                </div>
              </form>

              <br> 


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
    // $('#subtbl').DataTable({
    //   lengthChange: false
     
    // });
    oTable = $('#collationtbl').DataTable({
  sDom: 'lrtip',lengthChange: false
  

}); 
} );

$('#tracksearchbar').keyup(function(){
      oTable.search($(this).val()).draw() ;
})

function confirmation(){
    if(confirm('Are you sure that you want to collate data?')){
        submit();
    }else{
        return false;
    }   
}

  </script>
    
@endsection