@extends('layouts.layout_validator', [
    'namePage' => 'Manage Accounts',
    'fname' => $fname,
    'lname' => $lname,
    'class' => 'sidebar-mini',
    'pass' => '/validator/password',
    'activePage' => 'account',  
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

                <p style="font-size:18px;"><b>List of Encoder Accounts</b></p>
                  <p style="font-size:13px;">Add Accounts : Please click this button to prompt the adding of accounts 
                  
                    <button type="button" data-toggle="modal" data-target="#encoderModal" style="width:20px;height:20px;" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                      <i class="now-ui-icons ui-2_settings-90" data-toggle="tooltip" data-placement="top" title="Add Encoder"></i>
                    </button>
                  </p>
                  
                   
                  <hr>

                  {{-- <button type="button" style="background-color: transparent;border: none;cursor:pointer;"
                  data-toggle="modal" data-target="#encoderModal" >               
                    <i class="fa fa-plus-circle" aria-hidden="true" style="color:green;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="Add Encoder"></i></button> --}}
               
                
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

                <table class="table" id="example">
                    <thead style="background-color: #003471; font-size: 10px;color:white;">
                      <tr>
                        <th><b>Username</b></th>
                        <th><b>Fullname</b></th>
                        <th><b>Position</b></th>
                        <th><b>Division</b></th>
                        <th><b>Status</b></th>
                        <th><b>Action</b></th>
                      </tr>
                    </thead>
                    <tbody>
                          @foreach($account as $acc)
                          <tr>
                                <td>{{$acc->username}}</td>
                                <td>{{$acc->first_name}}&nbsp{{$acc->last_Name}}</td>
                                <td>{{$acc->position}}</td>
                                <td>{{$acc->division}}</td>
                              
                              @if($acc->status == 'Active')
                                <td><span class="badge badge-pill badge-success mr-1" >{{$acc->status}}</span></td>
                              @elseif($acc->status == 'Inactive')
                                <td><span class="badge badge-pill badge-danger mr-1" >{{$acc->status}}</span></td>
                              @endif
                              
                              <form method="POST" action="/validator/accounts/{{$acc->status}}/{{$acc->id}}">
                                {{method_field('patch')}}
                                @csrf
                                    @if($acc->status == 'Active')
                                    <td><button onclick="return confirmation();" type="submit" class="btn btn-danger" >Inactive</button></a></td>
                                    @else
                                    <td><button onclick="return confirmation();" type="submit"  class="btn btn-success">Active</button></a></td>
                                    @endif
                            </form>
                          </tr>
                          @endforeach 
                     
                    </tbody>
                  </table>
            </div>

            <div class="modal fade" id="encoderModal" tabindex="-1" role="dialog"  aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Encoder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="/validator/accounts/add" method="POST">
                      @csrf

                      
                      <div class="form-group">
                        <label class="col-form-label">Firstname:</label>
                        <input type="text" class="form-control" id="fname" name="fname">
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Lastname:</label>
                        <input type="text" class="form-control" id="lname" name="lname">
                      </div>
                      <div class="form-group">
                          <label class="col-form-label">Email:</label>
                          <input type="email" class="form-control" id="email" name="email">
                        </div>
                      <div class="form-group">
                        <label class="col-form-label">Position:</label>
                        <input type="text" class="form-control" id="position" name="position">
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Division:</label>
                        <input type="text" class="form-control" id="division" name="division">
                      </div>
                      <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add account</button>
                      </div>
                  
                    </form>
                  </div>
                  
                </div>
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
    oTable = $('#example').DataTable({
  sDom: 'lrtip',lengthChange: false
  

}); 
} );

$('#tracksearchbar').keyup(function(){
      oTable.search($(this).val()).draw() ;
})


$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});


$('#encoderModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var modal = $(this)
})

function confirmation(){
    if(confirm('Are you sure you want to take this action?')){
        submit();
    }else{
        return false;
    }   
}

</script>
@endsection