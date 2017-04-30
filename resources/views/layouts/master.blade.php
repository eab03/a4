<!DOCTYPE html>

<html lang="en">

<head>
	<title>
		@yield('title', 'Happenings')
	</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css"  integrity="sha384-+ENW/yibaokMnme+vBLnHMphUYxHs34h9lpdbSLuAwGkOKFRl4C34WkjazBtb7eT" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/a4.css" type="text/css">

    @stack('head')

</head>
<body>

	<div id='content'>
		@if(Session::get('message') != null)
			<div class='message'>{{ Session::get('message') }}</div>
		@endif

    <header>

		<h1>So Many Things To Do!</h1>

    </header>

            <section>
                @yield('content')
            </section>

            <footer>
                &copy; {{ date('Y') }} &nbsp;&nbsp;
            </footer>

        </div>

        @stack('body')

    </body>
    </html>
