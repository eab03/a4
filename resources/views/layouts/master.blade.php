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

			<nav id="topnav">
				<ul>
					<li><a href='/places/new'>Add a Place</a></li>
					<li><a href='/places/search'>Search</a></li>
					<li><a href='/places'>Home</a></li>
				</ul>
			</nav>

	    </header>

	    <section>
	        @yield('content')
	    </section>

        <footer>

        </footer>

    </div><!--close div content-->

    @stack('body')

</body>
</html>
