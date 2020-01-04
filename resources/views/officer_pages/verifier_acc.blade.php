@extends('layouts.layout_officer', [
    'namePage' => 'Administer Verifiers',
    'fname' => $fname,
    'lname' => $lname,
    'class' => 'sidebar-mini',
    'pass' => '/officer/password',
    'activePage' => 'verifier',
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

              <p style="font-size:18px;"><b>List of Verifier Accounts</b>
                <button type="button" style="background-color: transparent;border: none;cursor:pointer;"
                data-toggle="modal" data-target="#verifierModal" >
                
                  <i class="fa fa-plus-circle" aria-hidden="true" style="color:green;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="Add Encoder"></i></button>
              </p>

              <table class="table">
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
                            
                            <form method="POST" action="/officer/accounts/{{$acc->status}}/{{$acc->id}}">
                              {{method_field('patch')}}
                              @csrf
                                  @if($acc->status == 'Active')
                                  <td><button type="submit" class="btn btn-danger" >Inactive</button></a></td>
                                  @else
                                  <td><button type="submit"  class="btn btn-success">Active</button></a></td>
                                  @endif
                          </form>
                        </tr>
                        @endforeach
                   
                  </tbody>
                </table>
          </div>

          <div class="modal fade" id="verifierModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Verifier</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="/officer/accounts/add" method="POST">
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
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});


$('#verifierModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var modal = $(this)
})

</script>
@endsection

