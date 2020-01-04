@extends('layouts.layout_encoder', [
    'namePage' => 'Upload Documents',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/encoder/password',
    'class' => 'sidebar-mini',
    'activePage' => 'upload',
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
            
                @if (count($errors) > 0)
              <div class="alert alert-danger" style="line-height: 2px; padding-top:3%; padding-bottom:1%;">
                <p>There were some problems with your File input.</p>
              </div>
              @endif
        
                @if(session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div> 
                @endif

                <p style="font-size:18px;"><b>Upload Forms to Validate</b></p>
                <p style="font-size:13px;">Upload Form : Click on " Choose Files " to choose file to upload and click the button Upload</p>
            <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
              @csrf 
                <input type="file" name="file[]" multiple>
                <input type="submit" class="btn btn-info" value="Upload">
            </form> 



          </div>
        </div>
      </div>
      
                 
  </div>
@endsection

@section('scripts')
<script  type="text/javascript">
// // Add the following code if you want the name of the file appear on select
// $(".custom-file-input").on("change", function() {
//   var fileName = $(this).val().split("\\").pop();
//   $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
// });


$(document).ready(function() {

$(".btn-success").click(function(){ 
    var html = $(".clone").html();
    $(".increment").after(html);
});

$("body").on("click",".btn-danger",function(){ 
    $(this).parents(".control-group").remove();
});

});


</script>
@endsection