@extends('layouts.master')

@section('content')

<section id="welcome-showcase" class="grid">
    <div id="welcome-showcase-bg"></div>
    <div class="content-wrap" id="welcome-showcase-content">
        <img id="welcome-logo" src="/logo-white.png">
        <p>Start your internship today</p>
        <a id="welcome-showcase-button">Learn More</a>
    </div>
</section>

<section id="welcome-mission" class="grid">
    <div class="content-wrap">
        <h1 id="test">Our Mission</h1>
        <p>Apprentice strives to help you find an enjoyable high school
        internship that prepares you for your future.</p>
    </div>
</section>

<section id="welcome-how"> 
    <h1>How We Do It</h1>
    <ul class="flex" id="welcome-how-flex">
        <li>
            <div class="welcome-card">
                <img src="/storage/images/finding.jpg">
                <div class="welcome-card-content">
                    <h3>Finding Internships</h3>
                    <p>With Apprentice, we work to find you an internship in a field that you actually enjoy, which in turn
                    allows for you to gain knowledge in a field that might even turn out to be your future career, giving you an advantage
                    over the competition.</p>
                </div>
            </div>
        </li>
        <li>
            <div class="welcome-card">
                <img src="https://static.pexels.com/photos/163064/play-stone-network-networked-interactive-163064.jpeg">
                <div class="welcome-card-content">
                    <h3>Expanding Your Network</h3>
                    <p>We will increase the size of your network substantially by allowing you to work with industry professionals
                    and to make new connections in the business world even faster than ever.</p>
                </div>
            </div>
        </li>
        <li>
            <div class="welcome-card">
                <img src="/storage/images/working.jpg">
                <div class="welcome-card-content">
                    <h3>Working With Companies</h3>
                    <p>We work with companies to provide you with the best experience possible and to provide customized
                    courses to help you gain an edge on your competition.</p>
                </div>
            </div>
        </li>
    </ul>
</section>

<section id="welcome-about" class="grid">
    <div class="welcome-box">
        <h1>The Team</h1>
        <p>Alex Wasinger - CTO</p>
        <p>Ian Crossey - CEO</p>
        <p>Guiseppe Schifano - CFO</p>
        <p>Anupam Turkanda - CDO</p>
    </div>
    <div class="welcome-box test">
        <h1>Contact Us</h1>
        <p>apprenticestl@gmail.com</p>
    </div>
</section>
          
@endsection