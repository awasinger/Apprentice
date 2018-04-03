<!DOCTYPE html>
<html lang="en">
<head>
    <title>Apprentice</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <title>Apprentice</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="body-shade"></div> 
    @include('partials.navbar')
    <main>
        @yield('content')
    </main>
</body>
<script src="https://js.stripe.com/v3/"></script>
<script src="/js/app.js"></script>
</html>