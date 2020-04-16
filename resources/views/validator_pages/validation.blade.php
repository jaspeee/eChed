@extends('layouts.layout_validator', [
    'namePage' => 'Validation',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/validator/password',
    'class' => 'sidebar-mini',
    'activePage' => 'validation',
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

                  <p style="font-size:18px;"><b>Submitted Forms by the Encoders</b></p>
                  <p style="font-size:13px;color:red;">
                    Notice : Once an action has been confirmed, action cannot be undone. Kindly review carefully before confirming.
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

                <table class="table" id="example">
                  <thead style="background-color: #003471; font-size: 10px;color:white;">
                    <tr>
                      <th><b>Form</b></th> 
                      <th><b>Encoded by</b></th>
                      <th><b>Date Submitted</b></th>
                      <th style="text-align: center;"><b>Status</b></th>
                      <th style="text-align: center;"><b>Comment</b></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($submissions as $sub)
                        <tr>
                            <td>{{$sub->encoder_submission}}</td>
                            <td>{{$sub->first_name}} &nbsp {{$sub->last_Name}}</td>
                            <td>{{$sub->created_at}}</td>
                            
                            @if($sub->status == 'Pending')
                              <td style="text-align: center;"><span class="badge badge-pill badge-warning mr-1" >{{$sub->status}}</span></td>
                            @elseif($sub->status == 'Approve')
                              <td style="text-align: center;"><span class="badge badge-pill badge-success mr-1" >{{$sub->status}}</span></td>
                            @elseif($sub->status == 'Disapprove')
                            <td style="text-align: center;"><span class="badge badge-pill badge-danger mr-1" >{{$sub->status}}</span></td>
                            @endif

                            @if($sub->comment == null)
                            <td></td>
                            @else
                            <td style="text-align: center;">
                              <button type="button" data-toggle="modal" data-target="#commentModal" data-comment="{{$sub->comment}}" 
                              style="background-color: transparent;border: none;cursor:pointer;">
                              <i class="now-ui-icons ui-2_chat-round" style="font-size: 15px;color: blue" ></i>
                              {{-- <i class="fa fa-comments" aria-hidden="true" aria-hidden="true" style="color:#696969;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="comment">
                              </i> --}}
                              </button>
                            </td>
                           @endif
                            
        
                            @if($sub->status == 'Disapprove')
                              <td style="padding:0;">
                                <button type="submit" style="background-color: transparent;border: none;cursor:pointer;" disabled>
                                  <i class="now-ui-icons arrows-1_cloud-download-93" style="font-size: 15px;color: gray" ></i>
                                  {{-- <i class="fa fa-download" aria-hidden="true" style="color:#696969;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="download"></i> --}}
                                </button></a>
                              </td>
                              <td style="padding:0;">
                                
                                <button disabled type="submit" style="background-color: transparent;border: none;cursor:pointer;">
                                  <i class="now-ui-icons ui-1_check" style="font-size: 15px;color: green"  ></i>
                                  {{-- <i class="fa fa-check-circle" aria-hidden="true" style="color:green;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="Approve"></i> --}}
                                </button>
                               
                              </td >
                              <td style="padding:0;">
                                <button type="button" disabled data-toggle="modal" data-target="#disapproveModal" data-form="{{$sub->encoder_submission}}" data-id="{{$sub->validates_id}}" data-fname=" {{$sub->first_name}}" data-lname="{{$sub->last_Name}}" style="background-color: transparent;border: none;cursor:pointer;">
                                  <i class="now-ui-icons ui-1_simple-remove" style="font-size: 15px;color: red" ></i>
                                  {{-- <i class="fa fa-times-circle" aria-hidden="true" style="color:red;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="Disapprove"></i> --}}
                                </button>
                              </td>


                            @elseif($sub->status == 'Approve')

                                <td style="padding:0;"> 
                                  
                                  <a href="/validator/audit/{{$sub->validates_id}}" style="text-decoration-line: none;" ><button type="submit" style="background-color: transparent;border: none;cursor:pointer;">
                                    <i class="now-ui-icons arrows-1_cloud-download-93" style="font-size: 15px;color: gray" data-toggle="tooltip" data-placement="top" title="download"></i>
                                    {{-- <i class="fa fa-download" aria-hidden="true" style="color:#696969;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="download"></i> --}}
                                  </button></a>
                                </td>
                                <td style="padding:0;">
                                
                                <button  disabled type="submit" style="background-color: transparent;border: none;cursor:pointer;">
                                  <i class="now-ui-icons ui-1_check" style="font-size: 15px;color: green" ></i>
                                  {{-- <i class="fa fa-check-circle" aria-hidden="true" style="color:green;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="Approve"></i> --}}
                                </button>
                                
                                </td >
                                <td style="padding:0;">
                                  <button type="button" disabled data-toggle="modal" data-target="#disapproveModal" data-form="{{$sub->encoder_submission}}" data-id="{{$sub->validates_id}}" data-fname=" {{$sub->first_name}}" data-lname="{{$sub->last_Name}}" style="background-color: transparent;border: none;cursor:pointer;">
                                    <i class="now-ui-icons ui-1_simple-remove" style="font-size: 15px;color: red" ></i>
                                    {{-- <i class="fa fa-times-circle" aria-hidden="true" style="color:red;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="Disapprove"></i> --}}
                                  </button>
                                </td>

                            @else
                              <td style="padding:0;">
                                <a href="/validator/audit/{{$sub->validates_id}}" style="text-decoration-line: none;" ><button type="submit" style="background-color: transparent;border: none;cursor:pointer;">
                                  <i class="now-ui-icons arrows-1_cloud-download-93" style="font-size: 15px;color: gray" data-toggle="tooltip" data-placement="top" title="download"></i>
                                  {{-- <i class="fa fa-download" aria-hidden="true" style="color:#696969;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="download"></i> --}}
                                </button></a>
                              </td> 
                              <td style="padding:0;">
                                <form method="POST"  action="/validator/validation/approve/{{$sub->validates_id}}">
                                  {{method_field('patch')}} 
                                  @csrf
                                <button  onclick="return confirmation();" type="submit" style="background-color: transparent;border: none;cursor:pointer;">
                                  <i class="now-ui-icons ui-1_check" style="font-size: 15px;color: green" data-toggle="tooltip" data-placement="top" title="Approve" ></i>
                                  {{-- <i class="fa fa-check-circle" aria-hidden="true" style="color:green;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="Approve"></i> --}}
                                </button>
                                </form>
                              </td >
                              <td style="padding:0;">
                                <button type="button" data-toggle="modal" data-target="#disapproveModal" data-form="{{$sub->encoder_submission}}" data-id="{{$sub->validates_id}}" data-fname=" {{$sub->first_name}}" data-lname="{{$sub->last_Name}}" style="background-color: transparent;border: none;cursor:pointer;">
                                  <i class="now-ui-icons ui-1_simple-remove" style="font-size: 15px;color: red" data-toggle="tooltip" data-placement="top" title="Disapprove"></i>
                                  {{-- <i class="fa fa-times-circle" aria-hidden="true" style="color:red;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="Disapprove"></i> --}}
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
   modal.find('#fullname').text('Encoder: '+fname+'  '+lname);
   modal.find('#update').attr('action','/validator/validation/disapprove/'+id);
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

function confirmation(){
    if(confirm('Are you sure that you want to approve this form?')){
        submit();
    }else{
        return false;
    }   
}
</script>
@endsection