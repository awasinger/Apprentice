<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    
    @include('partials.navbar')
    <main>
        @yield('content')
    </main>
</body>
<script src="/js/app.js"></script>
</html>