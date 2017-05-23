<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LHT Capital</title>
    <link href="{{ asset('frontend/bootstrap/') }}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('frontend/bootstrap/') }}/css/bootstrap.css" rel="stylesheet">
	<link rel="{{ asset('frontend/bootstrap/') }}/stylesheet" href="css/animate.css">
    <link href="{{ asset('frontend/bootstrap/') }}/css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/bootstrap/') }}/css/modern-business.css" rel="stylesheet">
    <link href="{{ asset('frontend/bootstrap/') }}/css/font-awesome.min.css" rel="stylesheet">

    @yield('after_styles')
</head>

<body style="background: rgba(204, 204, 204, 0.51);">

    {{-- include menu --}}
    @include('FrontEnd.inc.menu')

    @yield('header')
    
    @yield('content')
   
    <!-- Footer -->
    @include('FrontEnd.inc.footer')
    <!-- jQuery -->
    <script src="{{ asset('frontend/bootstrap/') }}/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('frontend/bootstrap/') }}/js/bootstrap.min.js"></script>

    <script src="{{ asset('frontend/bootstrap/') }}/js/jqBootstrapValidation.js"></script>
    <script src="{{ asset('frontend/bootstrap/') }}/js/contact_me.js"></script>
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    });
    </script>

    @yield('after_scripts')

</body>
</html>