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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    @stack('head')

</head>

<body>
	<div id='content'>
		@if(Session::get('message') != null)
			<div class='message'>{{ Session::get('message') }}</div>
		@endif

    	<header></header>

		<!--https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_navbar_dropdown&stacked=h-->

		<nav class="navbar navbar-light">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="/">MyFaves!</a>
				</div>
				<ul class="nav navbar-nav">
				    <li class="active"><a href="/places">Home</a></li>
				    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Places<span class="caret"></span></a>
				        <ul class="dropdown-menu">
				          	<li><a href="/places/showall">Show All Places</a></li>
				          	<li><a href="/places/search">Search Places</a></li>
				          	<li><a href="/places/new">Add New Place</a></li>
				        </ul>
				      	</li>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Locations<span class="caret"></span></a>
						<ul class="dropdown-menu">
						  	<li><a href="/locations/showall">Show All Locations</a></li>
						  	<li><a href="/locations/new">Add New Location</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>

	    <div class='container'>
	        @yield('content')
	    </div>

        <footer>
        </footer>

    </div><!--close div content-->

    @stack('body')

</body>
</html>
