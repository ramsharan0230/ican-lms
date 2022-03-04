<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<!-- /Added by HTTrack -->
<head>

    @include('master-layouts.partial-master-layouts.partial-meta')

    <!-- Global stylesheets -->
    @include('master-layouts.partial-master-layouts.partial-global-css')
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    @include('master-layouts.partial-master-layouts.partial-core-js')
    <!-- /core JS files -->

    <!-- Theme JS files -->
    @include('master-layouts.partial-master-layouts.partial-theme-js')
    <script type="text/javascript" src="{{ URL::asset('assets/js/pages/login.js') }}"></script>
    <!-- /theme JS files -->

</head>

<body class="bg-slate-800">

<!-- Page container -->
<div class="page-container login-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">
                @include('flash-messages.partial_flash_alert_message')
                <!-- Advanced login -->
                {!! Form::open(['route' => 'password.reset']) !!}
              
                <div class="panel panel-body login-form">
                <img src="http://nepaapps.com/ican/ican-logo.jpg"> 
                <i class="icon-user text-muted"></i>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" class="form-control" placeholder="Email Address" name="email">

                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn bg-blue btn-block">Submit 
                        <i class="icon-circle-right2 position-right"></i></button>
                    </div>

                    {!! Form::close() !!}


                </div>
                <!-- /advanced login -->

                <!-- Footer -->
                <div class="footer text-white">
                    &copy; 2016 <a href="#" class="text-white">The Institiute of Chartered Accountants of Nepal
                        (ICAN)</a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>


</html>
