<!DOCTYPE html>

<html lang="en">

<head>
	<title>
		@yield('title', 'Places to Go, Things to Do!')
	</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css"  integrity="sha384-+ENW/yibaokMnme+vBLnHMphUYxHs34h9lpdbSLuAwGkOKFRl4C34WkjazBtb7eT" crossorigin="anonymous">
	<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="/css/a4.css" type="text/css">

    @stack('head')

</head>

<body>
	<div id='content'>
		@if(Session::get('message') != null)
			<div class='message'>{{ Session::get('message') }}</div>
		@endif

    	<header>

			<nav class="topnav">
				<div class='row'>
					<div class='col-sm-12 col-md-12 col-lg-12'>
						<ul>
							<li><a href='/locations/showall'>Locations</a></li>
							<li><a href='/places/showall'>Places</a></li>
							<li><a href='/places'>Home</a></li>
						</ul>
					</div>
				</div><!--close bootstrap row-->
			</nav><!--close navigation-->

	    </header>

	    <div class='container'>
	        @yield('content')
	    </div>

        <footer>
        </footer>

    </div><!--close div content-->

    @stack('body')

</body>
</html>
