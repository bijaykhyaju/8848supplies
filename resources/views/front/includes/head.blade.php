
<title>8848 Supplies</title>
<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<!--theme-style-->
<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="csrf-token" content="{!! csrf_token() !!}">
	
<link rel="stylesheet" type="text/css" href="{{asset('css/slider.min.css')}}">
	<script type="text/javascript" src="{{asset('js/jquery-3.4.1.js')}}"></script>
	<script src="{{asset('js/bootstrap-4.3.1.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/slider.js')}}"></script>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--theme-style-->
<link href="{{asset('css/style4.css')}}" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<!--<script src="js/jquery.min.js"></script>
--><!--- start-rate---->
<script src="{{asset('js/jstarbox.js')}}"></script>
	<link rel="stylesheet" href="{{asset('css/jstarbox.css')}}" type="text/css" media="screen" charset="utf-8" />
		<script type="text/javascript">
			jQuery(function() {
			jQuery('.starbox').each(function() {
				var starbox = jQuery(this);
					starbox.starbox({
					average: starbox.attr('data-start-value'),
					changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
					ghosting: starbox.hasClass('ghosting'),
					autoUpdateAverage: starbox.hasClass('autoupdate'),
					buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
					stars: starbox.attr('data-star-count') || 5
					}).bind('starbox-value-changed', function(event, value) {
					if(starbox.hasClass('random')) {
					var val = Math.random();
					starbox.next().text(' '+val);
					return val;
					} 
				})
			});
		});
		</script>
<!---//End-rate---->

