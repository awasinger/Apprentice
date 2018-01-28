<!DOCTYPE html>
<html>
<head>
    <title>Apprentice | Coming Soon</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <main>
        <section id="coming-soon">
            <div id="coming-soon-bg"></div>
            <img src="/logo-black.png">
            
            <div>
                <p>Helping high school students get internships.</p>

                <form id="coming-soon-form" method="post" action="/notify" class="{{ $errors->has('email') ? 'coming-error' : '' }}">
                    {{ csrf_field() }}
                    <input type="email" name="email" placeholder="Be the first to know. Enter your email." required>
                    <input type="submit" class="" value="Notify Me">
                    
                    @if ($errors->has('email'))
                        <div class="coming-help">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    @elseif(session('success'))
                        <div class="coming-success">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif
                </form>
            </div>
            
            <div id="countdown">
                <div class="countdown-container">
                    <p class="countdown-number" id="days-number"></p>
                    <p id="days-label">Days</p>
                </div>
                <div class="countdown-container">
                    <p class="countdown-number" id="hours-number"></p>
                    <p id="hours-label">Hours</p>
                </div>
                <div class="countdown-container">
                    <p class="countdown-number" id="minutes-number"></p>
                    <p id="minutes-label">Minutes</p>
                </div>
                <div class="countdown-container">
                    <p class="countdown-number" id="seconds-number"></p>
                    <p id="seconds-label">Seconds</p>
                </div>
            </div>
        </section>
    </main>
</body>
<script src="/js/app.js"></script>
</html>