@extends('layouts.layout_encoder', [
    'namePage' => 'Track Submissions',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/encoder/password',
    'class' => 'sidebar-mini',
    'activePage' => 'track',
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

                <p style="font-size:18px;"><b>Tracking of the Submitted Forms </b></p>
                {{-- <div class="input-group no-border">
                  <input type="text" id="searchsearch" class="form-control" placeholder="Search...">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <i class="now-ui-icons ui-1_zoom-bold"></i>
                    </div>
                  </div>
                </div> --}}
      
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

                <table class="table" id="subtbl">
                    <thead style="background-color: #003471; font-size: 10px;color:white;">
                      <tr>
                        <th><b>Reference ID</b></th>
                        <th><b>Form</b></th>
                        <th><b>Encoded by</b></th>
                        <th><b>Date Submitted</b></th>
                        <th style="text-align: center;"><b>Status</b></th>
                        <th style="text-align: center;"><b>Comment</b></th>
                      </tr>
                    </thead>
                    <tbody>
                          @foreach($submissions as $sub)
                          <tr> 
                              <td>{{$sub->validates_id}}</td>
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
                                {{-- <i class="fa fa-comments" aria-hidden="true" aria-hidden="true" style="color:#696969;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="comment"> --}}
                                </i>
                                </button>
                              </td>
                            @endif
                              
                              
                          </tr>
                          @endforeach
                     
                    </tbody>
                  </table>

                  {{-- <div style="padding-top:5%;">{{$submissions->links()}}</div> --}}
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
                    <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
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
    oTable = $('#subtbl').DataTable({
  sDom: 'lrtip',lengthChange: false
  

}); 
} );

$('#tracksearchbar').keyup(function(){
      oTable.search($(this).val()).draw() ;
})

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
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