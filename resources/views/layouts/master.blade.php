<head>
	
	<title>Payment Gateway</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Payment Form Widget Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
			function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //for-mobile-apps -->
	<link href="{{ URL::asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
	<!-- <link href="css/style.css" rel="stylesheet" type="text/css" media="all" /> -->
	<link href='//fonts.googleapis.com/css?family=Fugaz+One' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Alegreya+Sans:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js')}}"></script>
</head>
<body>
	<div class="main">
		@include('partials.header')
		 @yield('content') 
		@include('partials.footer')
	</div>
</body>