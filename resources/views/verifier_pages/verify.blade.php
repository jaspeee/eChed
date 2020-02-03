@extends('layouts.layout_verifier', [
    'namePage' => 'Verification',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/verifier/password',
    'class' => 'sidebar-mini',
    'activePage' => 'verification',
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

                  <p style="font-size:18px;"><b>Track Submissions from Validators</b></p>

                  <p style="font-size:13px;">
                    Notice : Once an action has been confirmed, action cannot be undone. Kindly review carefully before confirming
                
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

                  <table class="table" id="verifytbl">
                      <thead style="background-color: #003471; font-size: 10px;color:white;">
                        <tr>
                          <th><b>Form</b></th>
                          <th><b>Date Submitted</b></th>
                          <th><b>Validated by</b></th>
                          <th><b>Status</b></th>
                          <th style="text-align: center;"><b>Comment</b></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                            @foreach($files as $file)
                            <tr>
                                <td>{{$file->validator_submission}}</td>
                                <td>{{$file->created_at}}</td>
                                <td>{{$file->first_name}} &nbsp {{$file->last_Name}}</td>
                                
                                @if($file->status == 'Pending')
                                  <td><span class="badge badge-pill badge-warning mr-1" >{{$file->status}}</span></td>
                                @elseif($file->status == 'Approve')
                                  <td><span class="badge badge-pill badge-success mr-1" >{{$file->status}}</span></td>
                                @elseif($file->status == 'Disapprove')
                                <td><span class="badge badge-pill badge-danger mr-1" >{{$file->status}}</span></td>
                                @endif
                                

                                @if($file->comment == null)
                                  <td></td>
                                @else 
                                  <td style="text-align: center; padding:0;">
                                    <button type="button" data-toggle="modal" data-target="#commentModal" data-comment="{{$file->comment}}" data-form="{{$file->validator_submission}}"
                                    style="background-color: transparent;border: none;cursor:pointer;">
                                    <i class="now-ui-icons ui-2_chat-round" style="font-size: 15px;color: blue" ></i>
                                    </button>
                                  </td>
                                @endif

                                @if($file->status == 'Disapprove')
                                <td style="padding:0;">
                                  <button type="submit" disabled style="background-color: transparent;border: none;cursor:pointer;">
                                    <i class="now-ui-icons arrows-1_cloud-download-93" style="font-size: 15px;color: gray" ></i>
                                  </button></a>
                                </td>
                                <td style="padding:0;">
                                  <button type="submit" disabled style="background-color: transparent;border: none;cursor:pointer;">
                                    <i class="now-ui-icons ui-1_check" style="font-size: 15px;color: green" ></i>
                                  </button>
                                  </td >
  
                                <td style="padding:0;">
                                <button type="button" disabled data-toggle="modal" data-target="#disapproveModal" data-form="{{$file->validator_submission}}" data-id="{{$file->verifies_id}}" data-fname=" {{$file->first_name}}" data-lname="{{$file->last_Name}}" style="background-color: transparent;border: none;cursor:pointer;">
                                  <i class="now-ui-icons ui-1_simple-remove" style="font-size: 15px;color: red" ></i>
                                </button>
                                </td>

                                @elseif($file->status == 'Approve')
                                  <td style="padding:0;">
                                    <a href="/storage/complete/{{$file->validator_submission}}" download>
                                    <button type="submit" style="background-color: transparent;border: none;cursor:pointer;">
                                      <i class="now-ui-icons arrows-1_cloud-download-93" style="font-size: 15px;color: gray" data-toggle="tooltip" data-placement="top" title="download"></i>
                                    </button></a>
                                  </td>
                                  <td style="padding:0;">
                                    <form method="POST" action="/verifier/verify/approve/{{$file->verifies_id}}">
                                      {{method_field('patch')}}
                                      @csrf
                                    <button type="submit"  disabled style="background-color: transparent;border: none;cursor:pointer;">
                                      <i class="now-ui-icons ui-1_check" style="font-size: 15px;color: green" data-toggle="tooltip" data-placement="top" title="Approve" ></i>
                                    </button>
                                    </form>
                                  </td >
    
                                  <td style="padding:0;">
                                    <button type="button" disabled data-toggle="modal" data-target="#disapproveModal" data-form="{{$file->validator_submission}}" data-id="{{$file->verifies_id}}" data-fname=" {{$file->first_name}}" data-lname="{{$file->last_Name}}" style="background-color: transparent;border: none;cursor:pointer;">
                                      <i class="now-ui-icons ui-1_simple-remove" style="font-size: 15px;color: red" data-toggle="tooltip" data-placement="top" title="Disapprove"></i>
                                    </button>
                                  </td>

                                @else 
                                  <td style="padding:0;">
                                  <a href="/storage/verify/{{$file->validator_submission}}" download>
                                    <button type="submit" style="background-color: transparent;border: none;cursor:pointer;">
                                      <i class="now-ui-icons arrows-1_cloud-download-93" style="font-size: 15px;color: gray" data-toggle="tooltip" data-placement="top" title="download"></i>
                                    </button></a>
                                  </td>
                                  <td style="padding:0;">
                                    <form method="POST" action="/verifier/verify/approve/{{$file->verifies_id}}">
                                      {{method_field('patch')}}
                                      @csrf
                                    <button type="submit" style="background-color: transparent;border: none;cursor:pointer;">
                                      <i class="now-ui-icons ui-1_check" style="font-size: 15px;color: green" data-toggle="tooltip" data-placement="top" title="Approve" ></i>
                                    </button>
                                    </form>
                                    </td >
    
                                    <td style="padding:0;">
                                    <button type="button" data-toggle="modal" data-target="#disapproveModal" data-form="{{$file->validator_submission}}" data-id="{{$file->verifies_id}}" data-fname=" {{$file->first_name}}" data-lname="{{$file->last_Name}}" style="background-color: transparent;border: none;cursor:pointer;">
                                      <i class="now-ui-icons ui-1_simple-remove" style="font-size: 15px;color: red" data-toggle="tooltip" data-placement="top" title="Disapprove"></i>
                                    </button>
                                    </td>

                                @endif

                                
                                
                               

                            </tr>
                            @endforeach
                       

                      </tbody>
                    </table>
              </div>

              <div class="modal fade" id="disapproveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Disapprove the submitted form</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p id="form"></p>
                      <p id="fullname"></p>
                    
                      <form id="update" action="" method="POST">
                          {{method_field('patch')}}
                       @csrf

                        
                        <div class="form-group">
                          <label class="col-form-label">Comment:</label>
                          <textarea id="textarea" name="textarea" class="form-control" ></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        
                      </form>
                      {{-- <h5 id="sample"></h5> --}}
                      
                    </div>
                  
                  </div>
                </div>
              </div>

              <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                  
                      <p id="comments" style="font-style: italic;"></p>
                      {{-- <h5 id="sample"></h5> --}}
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

  $(document).ready(function() {
    // $('#subtbl').DataTable({
    //   lengthChange: false
     
    // });
    oTable = $('#verifytbl').DataTable({
  sDom: 'lrtip',lengthChange: false
  

}); 
} );

$('#tracksearchbar').keyup(function(){
      oTable.search($(this).val()).draw() ;
})





$('#disapproveModal').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var form = button.data('form');
  var id = button.data('id');
  var fname = button.data('fname');
  var lname = button.data('lname');

  
    // var link     = e.relatedTarget(),
    //     modal    = $(this),
    //     username = link.data("username"),
    //     email    = link.data("email");

    //modal.find('.modal-body input').val(form)
   // modal.find('#sample').text( id)
   modal.find('#form').text('Form: '+form);
   modal.find('#fullname').text('Submitted by: '+fname+'  '+lname);
   modal.find('#update').attr('action','/verifier/verify/disapprove/'+id);
   //var textarea_value = $('#textarea').val();

});

$('#commentModal').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);
  var form = button.data('form');
  var comment = button.data('comment');

  
    // var link     = e.relatedTarget(),
    //     modal    = $(this),
    //     username = link.data("username"),
    //     email    = link.data("email");

    //modal.find('.modal-body input').val(form)
   modal.find('#comments').text(' " '+comment+' " ')
  
   //var textarea_value = $('#textarea').val();

});

</script>
@endsection 