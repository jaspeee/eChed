<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel = "icon" href =  "{{url('/images/ched_logo.png')}}"  type = "image/x-icon"> 
  {{-- <link rel="icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png"> --}}
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://www.creative-tim.com/product/now-ui-dashboard-pro" />


  <!-- Open Graph data -->
  <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Now Ui Dashboard PRO by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="http://demos.creative-tim.com/now-ui-dashboard-pro/examples/dashboard.html" />
  <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/72/opt_nudp_thumbnail.jpg"/>
  <meta property="og:description" content="Now UI Dashboard PRO is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you." />
  <meta property="og:site_name" content="Creative Tim" />
  <title>
    E-CHED XI
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('assets') }}/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('assets') }}/demo/demo.css" rel="stylesheet" />
  <!-- Google Tag Manager -->

</head>

<body>


  <div class="wrapper">
   
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content"> 
      <div class="row">
        <div class="col-md-12" style="padding:10%;">
      
            <h1 style="color:red;opacity:0.8;">Your Account is Inactive</h1>
            <h5>Please fill up the following fields to reactivate your account. This request will be send
            to an appropriate personnel which depends on your account type.
            </h5>
 

            <form action="/inactive/req" method="POST" style="width:30%;">
                @csrf

                
                <div class="form-group">
                  <label class="col-form-label">Username:</label>
                  <input type="text" class="form-control" id="username" name="username">
                </div>

                <div class="form-group">
                  <label class="col-form-label">Firstname:</label>
                  <input type="text" class="form-control" id="fname" name="fname">
                </div>

                <div class="form-group">
                  <label class="col-form-label">Lastname:</label>
                  <input type="text" class="form-control" id="lname" name="lname">
                </div>
        
                <div class="form-group">
                 
                  <button type="submit" class="btn btn-success">Reactive Account</button>
                </div>
            
            </form> 
   

        </div>
       </div>
           
    </div>


  </div> 
 

  <!--   Core JS Files   -->
  <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
  <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
  <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
  <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('assets') }}/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets') }}/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('assets') }}/demo/demo.js"></script>
  @stack('js')
</body>

</html>