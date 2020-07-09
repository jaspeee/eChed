@extends('layouts.layout_officer', [
    'namePage' => 'Administer Validators',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/officer/password',
    'class' => 'sidebar-mini',
    'activePage' => 'validator',
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

              <p style="font-size:18px;"><b>List of Validator Accounts</b></p>
              <p style="font-size:13px;">Add Accounts : Please click this button to prompt the adding of accounts 
                  
                <button type="button" data-toggle="modal" data-target="#verifierModal" style="width:20px;height:20px;" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                  <i class="now-ui-icons ui-2_settings-90" data-toggle="tooltip" data-placement="top" title="Add Officer"></i>
                </button>
              </p>
              <hr>


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

              <table class="table" id="acctbl">
                  <thead style="background-color: #003471; font-size: 10px;color:white;">
                    <tr>
                      <th><b>Institution</b></th>
                      <th><b>Username</b></th>
                      <th><b>Fullname</b></th>
                      <th><b>Position</b></th>
                      <th><b>Division</b></th>
                      <th><b>Status</b></th>
                      <th><b></b></th>
                      <th><b></b></th>
                      <th><b></b></th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($account as $acc)
                        <tr> 
                              <td>{{$acc->institution_name}}</td>
                              <td>{{$acc->username}}</td>
                              <td>{{$acc->first_name}}&nbsp{{$acc->last_Name}}</td>
                              <td>{{$acc->position}}</td>
                              <td>{{$acc->division}}</td>
                            
                            @if($acc->status == 'Active')
                              <td><span class="badge badge-pill badge-success mr-1" >{{$acc->status}}</span></td>
                            @elseif($acc->status == 'Inactive')
                              <td><span class="badge badge-pill badge-danger mr-1" >{{$acc->status}}</span></td>
                            @endif
                            
                            <form method="POST" action="/officer/status/{{$acc->status}}/{{$acc->id}}">
                              {{method_field('patch')}} 
                              @csrf
                                  @if($acc->status == 'Active')
                                  <td><button type="submit" class="btn btn-danger" >Inactive</button></a></td>
                                  @else
                                  <td><button type="submit"  class="btn btn-success">Active</button></a></td>
                                  @endif 
                          </form>  

                          <td style="padding:0;">
                            <button type="button"   class="btn btn-warning" data-toggle="modal" data-target="#changePass" data-id="{{$acc->id}}">
                              Reset Password
                            </button>

                          </td>

                          <td>

                           <button type="button" data-toggle="modal" data-target="#EditAccModal" data-id="{{$acc->id}}"  data-username="{{$acc->username}}" data-position="{{$acc->position}}" 
                             data-division="{{$acc->division}}" data-fname=" {{$acc->first_name}}"
                             data-lname="{{$acc->last_Name}}" 
                             style="background-color: transparent;border: none;cursor:pointer;">
                             <i class="now-ui-icons  ui-1_settings-gear-63" style="font-size: 20px;color: gray" data-toggle="tooltip" data-placement="top" title="Disapprove"></i>
                           </button>
                            
                         </td>



                        </tr>
                        @endforeach
                   
                  </tbody>
                </table>
          </div>


          <div class="modal fade" id="EditAccModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="update" action="" method="POST">
                    {{method_field('patch')}}
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
                        <label class="col-form-label">Username:</label>
                        <input type="text" class="form-control" id="users" name="users">
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
                      <button type="submit" class="btn btn-primary">Edit account</button>
                    </div>
                
                  </form>
                </div>
                
              </div>
            </div>
          </div>

          <div class="modal fade" id="verifierModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Validator Accounts</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="/officer/accounts/validator/add" method="POST">
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
                      <label class="col-form-label">Institution:</label>
                      <select class="form-control" id="institution" name="institution">
                        @foreach($institution as $ins)
                          <option value="{{$ins->institutions_id}}">{{$ins->institution_name}}</option>
                        @endforeach
                      </select>
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

          <div class="modal fade" id="changePass" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Reset Password</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                    <form id="update" action="" method="POST">

                    {{method_field('patch')}}
                    @csrf

                    
                    <div class="form-group">
                      <label class="col-form-label">New Password:</label>
                      <input type="password" class="form-control" id="npass" name="npass">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Confirm Password:</label>
                      <input type="password" class="form-control" id="cpass" name="cpass">
                    </div>
          
                    <div class="form-group">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Confirm</button>
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
    oTable = $('#acctbl').DataTable({
  sDom: 'lrtip',lengthChange: false
}); 
});

$('#tracksearchbar').keyup(function(){
      oTable.search($(this).val()).draw() ;
})

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});


$('#verifierModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var modal = $(this)
})



$('#changePass').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var id = button.data('id'); 

   modal.find('#update').attr('action','/account/changePass/'+id);

});

$('#EditAccModal').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var position = button.data('position');
  var division = button.data('division');
  var username = button.data('username');
  var id = button.data('id');
  var fname = button.data('fname');
  var lname = button.data('lname');

  
   modal.find('#fname').val(fname);
   modal.find('#lname').val(lname);
   modal.find('#users').val(username);
   modal.find('#position').val(position);
   modal.find('#division').val(division);
   modal.find('#update').attr('action','/officer/account/edit/'+id);


});



</script>
@endsection
